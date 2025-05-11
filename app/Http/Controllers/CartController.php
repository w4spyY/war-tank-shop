<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Tank;
use App\Models\TankPart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function sync(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Debes iniciar sesión primero'
                ], 401);
            }

            $cartData = $request->input('cart_data');
            
            if (is_array($cartData)) {
                $localCart = $cartData;
            } else if (is_string($cartData)) {
                $localCart = json_decode($cartData, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Formato JSON inválido en cart_data');
                }
            } else {
                throw new \Exception('Tipo de dato inválido para cart_data');
            }

            if (!isset($localCart['items']) || !is_array($localCart['items'])) {
                throw new \Exception('Estructura del carrito inválida');
            }

            $cart = $this->syncCartWithDatabase(Auth::user(), $localCart);

            return response()->json([
                'success' => true,
                'cart_id' => $cart->id,
                'item_count' => $cart->items->count()
            ]);

        } catch (\Exception $e) {
            Log::error('Error en sync cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al sincronizar carrito: ' . $e->getMessage()
            ], 500);
        }
    }

    private function syncCartWithDatabase($user, $localCart)
    {
        return DB::transaction(function () use ($user, $localCart) {
            $cart = Cart::firstOrCreate(
                ['user_id' => $user->id, 'status' => 'activo'],
                ['created_at' => now(), 'updated_at' => now()]
            );

            $productIdsInRequest = [];

            foreach ($localCart['items'] as $item) {
                if (!isset($item['id'], $item['type'], $item['quantity'], $item['price'])) {
                    Log::warning('Item del carrito inválido', ['item' => $item]);
                    continue;
                }

                // Validar que el tipo sea 'tank' o 'part'
                if (!in_array($item['type'], ['tank', 'part'])) {
                    continue;
                }

                $productIdsInRequest[] = $item['id'];

                CartItem::updateOrCreate(
                    [
                        'cart_id' => $cart->id,
                        'product_id' => $item['id'],
                        'product_type' => $item['type'] // Usar directamente 'tank' o 'part'
                    ],
                    [
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'updated_at' => now()
                    ]
                );
            }

            CartItem::where('cart_id', $cart->id)
                ->whereNotIn('product_id', $productIdsInRequest)
                ->delete();

            $total = $cart->items()->sum(DB::raw('price * quantity'));
            $cart->update(['total' => $total]);

            return $cart;
        });
    }

    public function checkout()
    {
        $user = Auth::user();

        $cart = Cart::with(['items' => function($query) {
            $query->with(['product' => function($q) {
                $q->select('id', 'name');
            }]);
        }])
        ->where('user_id', $user->id)
        ->where('status', 'activo')
        ->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'status' => 'activo',
            ]);
        }

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->withErrors('No tienes productos en el carrito.');
        }

        return view('cart.checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();

        return DB::transaction(function () use ($user, $request) {
            $cart = Cart::with('items')
                ->where('user_id', $user->id)
                ->where('status', 'activo')
                ->lockForUpdate()
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index')->withErrors('No tienes productos en el carrito.');
            }

            $validated = $request->validate([
                'billing_name' => 'required|string|max:255',
                'billing_address' => 'required|string|max:255',
                'billing_phone' => 'required|string|max:20',
                'credit_card' => 'required|string|min:13|max:19',
            ]);

            $subtotal = 0;
            $taxRate = 0.21;

            foreach ($cart->items as $item) {
                $subtotal += $item->price * $item->quantity;
            }

            $tax = $subtotal * $taxRate;
            $total = $subtotal + $tax;

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'billing_name' => $validated['billing_name'],
                'billing_address' => $validated['billing_address'],
                'billing_phone' => $validated['billing_phone'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => 'credit_card',
            ]);

            foreach ($cart->items as $item) {
                // Mapeo para invoice_items (puede ser diferente al de cart_items)
                $productType = $item->product_type === 'tank' 
                    ? 'App\Models\Tank' 
                    : 'App\Models\TankPart';

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $item->product_id,
                    'product_type' => $productType,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->price,
                    'total_price' => $item->price * $item->quantity,
                    'name' => $this->getProductName($item),
                    'tax_rate' => $taxRate,
                ]);

                $this->updateProductStock($item);
            }

            Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $total,
                'payment_method' => 'credit_card',
                'transaction_id' => 'txn_' . uniqid(),
                'status' => 'completed',
                'paid_at' => now(),
            ]);

            $cart->status = 'completed';
            $cart->save();

            return redirect()->route('cart.confirmation', ['invoice' => $invoice->id]);
        });
    }

    public function confirmation(Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::id()) {
            abort(403);
        }

        $invoice->load('items');
        return view('cart.confirmation', compact('invoice'));
    }

    private function getProductName($cartItem)
    {
        // Obtener el modelo basado en el tipo (tank/part)
        $product = $cartItem->product_type === 'tank' 
            ? Tank::find($cartItem->product_id)
            : TankPart::find($cartItem->product_id);
        
        return $product ? $product->name : 'Producto eliminado';
    }

    private function updateProductStock($cartItem)
    {
        $product = $cartItem->product_type === 'tank'
            ? Tank::find($cartItem->product_id)
            : TankPart::find($cartItem->product_id);

        if ($product) {
            $product->stock -= $cartItem->quantity;
            $product->sells += $cartItem->quantity;
            $product->save();
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Tank;
use App\Models\TankPart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function checkout(Request $request)
    {
        try {
            $request->validate([
                'cart' => 'required|array',
                'cart.*.id' => 'required',
                'cart.*.type' => 'required|in:tank,part',
                'cart.*.quantity' => 'required|integer|min:1',
                'cart.*.price' => 'required|numeric|min:0'
            ]);

            $user = Auth::user();
            $cart = $request->cart;

            $subtotal = collect($cart)->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });

            $tax = $subtotal * 0.21;
            $total = $subtotal + $tax;

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'invoice_number' => 'INV-' . Str::upper(Str::random(8)),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => 'paid',
                'payment_method' => 'simulated',
                'billing_name' => $user->name . ' ' . $user->lastname,
                'billing_address' => $user->direccion,
                'billing_tax_id' => '',
            ]);

            foreach ($cart as $item) {
                $product = $item['type'] === 'tank' 
                    ? Tank::find($item['id'])
                    : TankPart::find($item['id']);

                if (!$product) {
                    continue;
                }

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_type' => $item['type'],
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                    'name' => $product->name,
                    'tax_rate' => 21,
                ]);

                $product->decrement('stock', $item['quantity']);
                $product->increment('sells', $item['quantity']);
            }

            return response()->json([
                'success' => true,
                'invoice_id' => $invoice->id,
                'message' => 'Compra realizada con éxito'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function confirmation(Request $request)
    {
        $invoiceId = $request->query('invoice');
        $invoice = Invoice::with('items')->findOrFail($invoiceId);

        if ($invoice->user_id !== Auth::id()) {
            abort(403);
        }

        return view('cart.confirmation', compact('invoice'));
    }
}
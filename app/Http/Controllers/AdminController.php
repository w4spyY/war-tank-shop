<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Tank;
use App\Models\Category;
use App\Models\TankPart;
use App\Models\CartItem;
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\User;

class AdminController extends Controller
{
    public function productList()
    {
        $tanks = Tank::select(['id', 'name', 'price', 'country', 'stock', 'image_url'])
                    ->orderBy('stock', 'desc')
                    ->paginate(10);

        return view('admin.products.list', compact('tanks'));
    }
    public function lowStockProducts()
    {
        $tanks = Tank::select(['id', 'name', 'price', 'country', 'stock', 'image_url'])
                    ->where('stock', '>', 0)
                    ->where('stock', '<', 10)
                    ->orderBy('stock', 'asc')
                    ->paginate(10);

        return view('admin.products.low-stock', compact('tanks'));
    }
    public function exhaustedProducts()
    {
        $tanks = Tank::select(['id', 'name', 'price', 'country', 'stock', 'image_url'])
                    ->where('stock', '=', 0)
                    ->orderBy('name', 'asc')
                    ->paginate(10);

        return view('admin.products.exhausted', compact('tanks'));
    }
    public function categories()
    {
        $categories = Category::orderBy('type')->orderBy('name')->paginate(10);
        return view('admin.catalog.categories', compact('categories'));
    }

    public function products()
    {
        $tanks = Tank::with('category')->orderBy('name')->paginate(10, ['*'], 'tanks_page');
        $parts = TankPart::with('category')->orderBy('name')->paginate(10, ['*'], 'parts_page');
        $categories = Category::orderBy('type')->orderBy('name')->get();
        
        return view('admin.catalog.products', compact('tanks', 'parts', 'categories'));
    }

    public function createProduct()
    {
        $categories = Category::orderBy('type')->orderBy('name')->get();
        return view('admin.catalog.create-product', compact('categories'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:tank,part',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Categoría actualizada correctamente',
            'category' => $category
        ]);
    }

    public function destroyCategory(Category $category)
    {
        if ($category->type === 'tank') {
            $tanksCount = Tank::where('category_id', $category->id)->count();
            if ($tanksCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la categoría porque está asignada a '.$tanksCount.' tanque(s)'
                ], 422);
            }
        } else {
            $partsCount = TankPart::where('category_id', $category->id)->count();
            if ($partsCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la categoría porque está asignada a '.$partsCount.' pieza(s)'
                ], 422);
            }
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Categoría eliminada correctamente'
        ]);
    }
    public function updateTank(Request $request, Tank $tank)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($tank->image_url && File::exists(public_path($tank->image_url))) {
                File::delete(public_path($tank->image_url));
            }
            
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $directory = public_path('images/tanks');
            $image->move($directory, $imageName);
            $validated['image_url'] = 'images/tanks/'.$imageName;
        }

        $tank->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tanque actualizado correctamente',
            'tank' => $tank
        ]);
    }

    public function destroyTank(Tank $tank)
    {
        $inCarts = CartItem::where('product_type', 'tank')->where('product_id', $tank->id)->exists();
        $inInvoices = InvoiceItem::where('product_type', 'tank')->where('product_id', $tank->id)->exists();

        if ($inCarts || $inInvoices) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar el tanque porque está asociado a pedidos o facturas'
            ], 422);
        }

        if ($tank->image_url && File::exists(public_path($tank->image_url))) {
            File::delete(public_path($tank->image_url));
        }

        $tank->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tanque eliminado correctamente'
        ]);
    }

    public function updatePart(Request $request, TankPart $part)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'weight_kg' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($part->image_url && File::exists(public_path($part->image_url))) {
                File::delete(public_path($part->image_url));
            }
            
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $directory = public_path('images/parts');
            $image->move($directory, $imageName);
            $validated['image_url'] = 'images/parts/'.$imageName;
        }

        $part->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pieza actualizada correctamente',
            'part' => $part
        ]);
    }

    public function destroyPart(TankPart $part)
    {
        $inCarts = CartItem::where('product_type', 'part')->where('product_id', $part->id)->exists();
        $inInvoices = InvoiceItem::where('product_type', 'part')->where('product_id', $part->id)->exists();

        if ($inCarts || $inInvoices) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar la pieza porque está asociada a pedidos o facturas'
            ], 422);
        }

        $part->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pieza eliminada correctamente'
        ]);
    }

    public function storeTank(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'code' => 'required|string|unique:tanks,code',
            'weight_kg' => 'required|numeric',
            'crew_capacity' => 'required|integer',
            'fuel_capacity_liters' => 'required|numeric',
            'fuel_type' => 'required|string',
            'horsepower' => 'required|integer',
            'ammunition_type' => 'required|string',
            'max_speed_kmh' => 'required|numeric',
            'armor_type' => 'required|string',
            'range_km' => 'required|numeric',
            'manufacture_year' => 'required|integer',
            'country' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            
            $directory = public_path('images/tanks');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            
            $image->move($directory, $imageName);
            
            $validated['image_url'] = 'images/tanks/'.$imageName;
        }

        $tank = Tank::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tanque creado correctamente',
            'redirect' => route('admin.catalog.products')
        ]);
    }

    public function storePart(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'code' => 'required|string|unique:tanks_parts,code',
            'material' => 'required|string',
            'compatibility_notes' => 'required|string',
            'country' => 'required|string',
            'weight_kg' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            
            $directory = public_path('images/parts');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            
            $image->move($directory, $imageName);
            
            $validated['image_url'] = 'images/parts/'.$imageName;
        }

        $part = TankPart::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pieza creada correctamente',
            'redirect' => route('admin.catalog.products')
        ]);
    }

    public function salesHistory()
    {
        $invoices = Invoice::with(['user', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.sales.history', compact('invoices'));
    }

    public function stockGraph()
    {
        return view('admin.stock.graph');
    }

    public function getStockData()
    {
        $data = [
            'tanks' => Tank::select('name', 'stock')
                        ->orderBy('stock', 'desc')
                        ->get(),
            'parts' => TankPart::select('name', 'stock')
                        ->orderBy('stock', 'desc')
                        ->get()
        ];

        return response()->json($data);
    }

    public function salesGraph()
    {
        return view('admin.sales.graph');
    }

    public function getSalesData()
    {
        $data = [
            'tanks' => Tank::select('name', 'sells')
                        ->where('sells', '>', 0)
                        ->orderBy('sells', 'desc')
                        ->get(),
            'parts' => TankPart::select('name', 'sells')
                        ->where('sells', '>', 0)
                        ->orderBy('sells', 'desc')
                        ->get()
        ];

        return response()->json($data);
    }

    public function userList()
    {
        $currentUserId = auth()->id();
        $users = User::where('id', '!=', $currentUserId)->get();
        
        return view('admin.users.list', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:user,admin'
        ]);
        
        $user->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente'
        ]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado correctamente'
        ]);
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:tank,part',
            'description' => 'nullable|string'
        ]);
        
        $category = Category::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Categoría creada correctamente',
            'category' => $category
        ]);
    }

    public function updateInvoiceStatus(Request $request, Invoice $invoice)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled,refunded'
        ]);

        $invoice->update(['status' => $request->status]);

        return redirect()->route('admin.sales.history')->with('success', 'Estado de la factura actualizado correctamente');
    }

    public function deleteInvoice(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()->route('admin.sales.history')->with('error', 'No se puede eliminar una factura pagada');
        }

        $invoice->items()->delete();
        $invoice->delete();

        return redirect()->route('admin.sales.history')->with('success', 'Factura eliminada correctamente');
    }
}

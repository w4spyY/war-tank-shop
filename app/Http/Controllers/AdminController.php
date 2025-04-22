<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tank;

class AdminController extends Controller
{
    public function productList()
    {
        $tanks = Tank::select(['id', 'name', 'price', 'country', 'stock', 'image_url'])
                    ->orderBy('stock', 'desc')
                    ->paginate(10); // 10 items por página

        return view('admin.products.list', compact('tanks'));
    }
}

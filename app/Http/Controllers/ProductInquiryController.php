<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductInquiry;
use App\Models\Tank;
use App\Models\TankPart;
use Illuminate\Support\Facades\Auth;

class ProductInquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_type' => 'required|in:tank,part',
            'product_code' => 'required|string',
            'message' => 'required|string|max:1000',
            'first_name' => Auth::check() ? 'nullable' : 'required|string|max:255',
            'last_name' => Auth::check() ? 'nullable' : 'required|string|max:255',
            'email' => Auth::check() ? 'nullable|email' : 'required|email|max:255',
        ]);

        // Verificar que el producto existe
        $product = $request->product_type === 'tank' 
            ? Tank::where('code', $request->product_code)->first()
            : TankPart::where('code', $request->product_code)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'El código de producto no existe'
            ], 404);
        }

        // Crear la pregunta
        $inquiry = new ProductInquiry();
        $inquiry->product_type = $request->product_type;
        $inquiry->product_code = $request->product_code;
        $inquiry->message = $request->message;

        if (Auth::check()) {
            $inquiry->user_id = Auth::id();
            $inquiry->first_name = Auth::user()->name;
            $inquiry->last_name = Auth::user()->lastname;
            $inquiry->email = Auth::user()->email;
        } else {
            $inquiry->first_name = $request->first_name;
            $inquiry->last_name = $request->last_name;
            $inquiry->email = $request->email;
        }

        $inquiry->save();

        return response()->json([
            'success' => true,
            'message' => 'Tu pregunta ha sido enviada con éxito'
        ]);
    }
}
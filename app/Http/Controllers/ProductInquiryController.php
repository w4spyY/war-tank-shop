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
        $validationRules = [
            'product_type' => 'required|in:tank,part',
            'product_code' => 'required|string',
            'message' => 'required|string|max:1000',
        ];

        if (Auth::check()) {
            $validationRules['first_name'] = 'nullable';
            $validationRules['last_name'] = 'nullable';
            $validationRules['email'] = 'nullable|email';
        } else {
            $validationRules['first_name'] = 'required|string|max:255';
            $validationRules['last_name'] = 'required|string|max:255';
            $validationRules['email'] = 'required|email|max:255';
        }

        $request->validate($validationRules);

        $product = null;
        if ($request->product_type === 'tank') {
            $product = Tank::where('code', $request->product_code)->first();
        } else {
            $product = TankPart::where('code', $request->product_code)->first();
        }

        if (!$product) {
            return response()->json([
                'success' => false,
            ], 404);
        }

        $inquiry = new ProductInquiry();
        $inquiry->product_type = $request->product_type;
        $inquiry->product_code = $request->product_code;
        $inquiry->message = $request->message;

        if (Auth::check()) {
            $user = Auth::user();
            $inquiry->user_id = $user->id;
            $inquiry->first_name = $user->name;
            $inquiry->last_name = $user->lastname;
            $inquiry->email = $user->email;
        } else {
            $inquiry->first_name = $request->first_name;
            $inquiry->last_name = $request->last_name;
            $inquiry->email = $request->email;
        }

        $inquiry->save();

        return response()->json([
            'success' => true,
        ]);
    }
}
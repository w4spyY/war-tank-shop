<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tank;
use App\Models\Rating;

class TankController extends Controller
{
    public function index()
    {
        $tanks = Tank::all();
        return view('main.index', compact('tanks'));
    }
    public function show($id)
    {
        $tank = Tank::findOrFail($id);
        $ratings = Rating::with('user')
            ->where('product_type', 'tank')
            ->where('product_id', $id)
            ->latest()
            ->get();

        if (request()->wantsJson()) {
            return response()->json([
                'html' => view('partials.reviews', compact('ratings'))->render(),
                'ratings' => $ratings
            ]);
        }

        return view('main.tank-details', compact('tank', 'ratings'));
    }

    public function storeRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review_text' => 'required|string|max:1000'
        ]);

        Rating::create([
            'user_id' => auth()->id(),
            'product_type' => 'tank',
            'product_id' => $id,
            'rating' => $request->rating,
            'review_text' => $request->review_text
        ]);

        if ($request->wantsJson()) {
            $ratings = Rating::with('user')
                ->where('product_type', 'tank')
                ->where('product_id', $id)
                ->latest()
                ->get();
                
            return response()->json([
                'success' => true,
                'html' => view('partials.reviews', compact('ratings'))->render()
            ]);
        }

        return back()->with('success', '¡Gracias por tu opinión!');
    }
}

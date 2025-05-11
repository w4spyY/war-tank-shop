<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareCart
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $cartCount = Auth::user()->carts()
                ->where('status', 'active')
                ->withCount('items')
                ->first()
                ?->items_count ?? 0;
        } else {
            $cart = json_decode($request->cookie('tankShopCart'), true) ?? ['items' => []];
            $cartCount = array_reduce($cart['items'], fn($carry, $item) => $carry + $item['quantity'], 0);
        }

        view()->share('cartCount', $cartCount);

        return $next($request);
    }
}
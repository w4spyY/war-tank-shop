<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Invoice;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('my-profile.show', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request)
    {
        return view('my-profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'facturacion' => 'nullable|string|max:255',
            'nacimiento' => 'nullable|date',
        ]);

        $user = $request->user();
        $user->update($request->only([
            'name',
            'lastname',
            'email',
            'telefono',
            'direccion',
            'facturacion',
            'nacimiento',
        ]));

        return Redirect::route('profile.show')->with('status', 'Perfil actualizado correctamente');
    }

    public function orders(Request $request)
    {
        $user = $request->user();
        
        $invoices = Invoice::with(['items', 'payment'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('my-profile.orders', [
            'user' => $user,
            'invoices' => $invoices
        ]);
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('forms.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'nacimiento' => ['required', 'date'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'direccion' => ['required', 'string', 'max:255'],
                'facturacion' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:20'],
                'terms' => ['required', 'accepted'],
                'cookies' => ['required', 'accepted'],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'nacimiento' => $validated['nacimiento'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'direccion' => $validated['direccion'],
                'facturacion' => $validated['facturacion'],
                'telefono' => $validated['telefono'],
                'terms_accepted' => true,
                'cookies_accepted' => true,
            ]);

            event(new Registered($user));
            Auth::login($user);

            return redirect("/");

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Captura errores de validación
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Captura otros errores (base de datos, etc.)
            return back()->with('error', 'Ocurrió un error al registrar: '.$e->getMessage())->withInput();
        }
    }
}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8 text-tercero">Proceso de Compra</h1>

    <h2 class="text-2xl font-bold mb-4">Resumen del Pedido</h2>
    <div class="mb-8">
        @foreach ($cartItems as $item)
            <div class="flex justify-between mb-4">
                <div>
                    <h3 class="font-semibold">{{ $item->product->name }}</h3>
                    <p>Cantidad: {{ $item->quantity }}</p>
                    <p>Precio: €{{ number_format($item->price, 2) }}</p>
                    <p>Total: €{{ number_format($item->total_price, 2) }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-right">
        <h3 class="font-bold text-xl">Total: €{{ number_format($cart->total, 2) }}</h3>
    </div>

    <form action="{{ route('cart.processCheckout') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="billing_name" class="block">Nombre Completo</label>
            <input type="text" id="billing_name" name="billing_name" required class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="billing_address" class="block">Dirección de Envío</label>
            <input type="text" id="billing_address" name="billing_address" required class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="billing_phone" class="block">Teléfono de Contacto</label>
            <input type="text" id="billing_phone" name="billing_phone" required class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="credit_card" class="block">Número de Tarjeta</label>
            <input type="text" id="credit_card" name="credit_card" required class="w-full p-2 border rounded">
        </div>

        <!-- Aquí también puedes agregar campos como fecha de caducidad y CVV -->

        <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Finalizar Compra</button>
    </form>
</div>
@endsection

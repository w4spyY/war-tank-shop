@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8 text-tercero">Carrito de Compras</h1>

    <div class="cart-container">
        <div class="cart-summary mt-8"></div>
    </div>

    <div class="text-right mt-6">
        <button id="checkout-button" class="bg-primary text-white px-4 py-2 rounded">
            Finalizar compra
        </button>
    </div>      
</div>

@vite(['resources/js/carrito.js'])

@endsection

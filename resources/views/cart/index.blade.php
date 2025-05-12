@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tu Carrito de Compras</h1>
    
    <div id="cart-container">
        <!-- Los items del carrito se cargarán aquí dinámicamente -->
        <div class="text-center py-8" id="empty-cart-message">
            <p class="text-lg">Tu carrito está vacío</p>
            <a href="{{ route('main.index') }}" class="mt-4 inline-block btn-primary">
                Ver productos
            </a>
        </div>
        
        <div id="cart-items-container" class="hidden">
            <div class="grid gap-6 mb-8" id="cart-items-list">
                <!-- Items del carrito se añadirán aquí -->
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Resumen del Pedido</h2>
                </div>
                
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span id="cart-subtotal">€0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>IVA (21%):</span>
                        <span id="cart-tax">€0.00</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total:</span>
                        <span id="cart-total">€0.00</span>
                    </div>
                </div>
                
                <button id="checkout-btn" 
                        class="w-full btn-primary py-3"
                        data-checkout-url="{{ route('cart.checkout') }}"
                        data-confirmation-url="{{ route('cart.confirmation') }}"
                        data-csrf-token="{{ csrf_token() }}"
                        data-login-url="{{ route('login') }}">
                    Proceder al Pago
                </button>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/cartDisplay.js'])
@endsection
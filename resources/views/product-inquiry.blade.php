@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Pregunta sobre un Producto</h1>
        
        <form id="inquiry-form" data-store-url="{{ route('product.inquiries.store') }}">
            @csrf
            
            <div class="mb-4">
                <label for="product_type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Producto</label>
                <select id="product_type" name="product_type" class="w-full px-3 py-2 border rounded-md" required>
                    <option value="">Selecciona un tipo</option>
                    <option value="tank">Tanque</option>
                    <option value="part">Pieza de Tanque</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="product_code" class="block text-sm font-medium text-gray-700 mb-2">Código del Producto</label>
                <input type="text" id="product_code" name="product_code" class="w-full px-3 py-2 border rounded-md" required>
                <p class="text-sm text-gray-500 mt-1">El código lo encontrarás en la página del producto</p>
            </div>
            
            <div id="guest-fields" class="{{ Auth::check() ? 'hidden' : '' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-3 py-2 border rounded-md" {{ Auth::check() ? '' : 'required' }}>
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-3 py-2 border rounded-md" {{ Auth::check() ? '' : 'required' }}>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md" {{ Auth::check() ? '' : 'required' }}>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Tu Pregunta</label>
                <textarea id="message" name="message" rows="5" class="w-full px-3 py-2 border rounded-md" required></textarea>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                Enviar Pregunta
            </button>
        </form>
        
        <div id="success-message" class="hidden mt-4 p-4 bg-green-100 text-green-700 rounded-md"></div>
        <div id="error-message" class="hidden mt-4 p-4 bg-red-100 text-red-700 rounded-md"></div>
    </div>
</div>

@vite(['resources/js/product-inquiry.js'])
@endsection
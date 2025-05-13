@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-[var(--primero)] p-6 rounded-lg shadow-3xl border-2 border-[var(--tercero)]">
        <h1 class="text-2xl font-bold mb-6 text-[var(--tercero)]">Pregunta sobre un Producto</h1>
        
        <form id="inquiry-form" data-store-url="{{ route('product.inquiries.store') }}">
            @csrf
            
            <div class="mb-4">
                <label for="product_type" class="block text-sm font-medium text-[var(--tercero)] mb-2">Tipo de Producto</label>
                <select id="product_type" name="product_type" class="w-full px-3 py-2 border rounded-md bg-[var(--tercero)]" required>
                    <option value="">Selecciona un tipo</option>
                    <option value="tank">Tanque</option>
                    <option value="part">Pieza de Tanque</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="product_code" class="block text-sm font-medium text-[var(--tercero)] mb-2">Código del Producto</label>
                <input type="text" id="product_code" name="product_code" class="w-full px-3 py-2 border rounded-md bg-[var(--tercero)]" required>
                <p class="text-sm text-[var(--tercero-oscuro)] mt-1">El código lo encontrarás en la página del producto</p>
            </div>
            
            <div id="guest-fields" class="{{ Auth::check() ? 'hidden' : '' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-[var(--tercero)] mb-2">Nombre</label>
                        <input type="text" id="first_name" name="first_name" class="w-full px-3 py-2 border rounded-md bg-[var(--tercero)]" {{ Auth::check() ? '' : 'required' }}>
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-[var(--tercero)] mb-2">Apellido</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-3 py-2 border rounded-md bg-[var(--tercero)]" {{ Auth::check() ? '' : 'required' }}>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-[var(--tercero)] mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md bg-[var(--tercero)]" {{ Auth::check() ? '' : 'required' }}>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-[var(--tercero)] mb-2">Tu Pregunta</label>
                <textarea id="message" name="message" rows="5" class="w-full px-3 py-2 border rounded-md bg-[var(--tercero)]" required></textarea>
            </div>
            
            <button type="submit" class="w-full bg-[var(--cuarto)] text-[var(--sexto)] py-2 px-4 rounded-md hover:bg-[var(--quinto)] transition flex justify-center items-center min-h-[42px] font-bold">
                <span id="submit-text">Enviar Pregunta</span>
                <div id="spinner" class="hidden ml-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </button>
        </form>
        
    </div>
</div>

@vite(['resources/js/product-inquiry.js'])
@endsection
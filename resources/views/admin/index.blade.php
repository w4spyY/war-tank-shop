@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Panel de Administración</h1>
    
    <!-- Sección de Gestión de Productos -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Gestión de Productos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Botón Listado de Productos -->
            <a href="{{ route('admin.products.list') }}" class="flex items-center p-4 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span>Listado de Productos</span>
            </a>
            
            <!-- Botón Productos con Bajo Stock -->
            <a href="#" class="flex items-center p-4 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path>
                </svg>
                <span>Productos con Bajo Stock</span>
            </a>
            
            <!-- Botón Productos Agotados -->
            <a href="#" class="flex items-center p-4 bg-red-100 hover:bg-red-200 text-red-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728"></path>
                </svg>
                <span>Productos Agotados</span>
            </a>
        </div>
    </div>
    
    <!-- Sección de Ventas -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Gestión de Ventas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Botón Historial de Ventas -->
            <a href="#" class="flex items-center p-4 bg-green-100 hover:bg-green-200 text-green-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span>Historial de Ventas</span>
            </a>
            
            <!-- Botón Estadísticas de Ventas -->
            <a href="#" class="flex items-center p-4 bg-purple-100 hover:bg-purple-200 text-purple-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span>Estadísticas de Ventas</span>
            </a>
            
            <!-- Botón Gráfico de Ventas -->
            <a href="#" class="flex items-center p-4 bg-indigo-100 hover:bg-indigo-200 text-indigo-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span>Gráfico de Ventas</span>
            </a>
        </div>
    </div>
    
    <!-- Sección de Promociones -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Promociones</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Botón Aplicar Descuentos -->
            <a href="#" class="flex items-center p-4 bg-pink-100 hover:bg-pink-200 text-pink-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path>
                </svg>
                <span>Aplicar Descuentos</span>
            </a>
            
            <!-- Botón Ofertas Especiales -->
            <a href="#" class="flex items-center p-4 bg-orange-100 hover:bg-orange-200 text-orange-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
                <span>Ofertas Especiales</span>
            </a>
            
            <!-- Botón Configurar Black Friday -->
            <a href="#" class="flex items-center p-4 bg-teal-100 hover:bg-teal-200 text-teal-800 rounded-lg transition-colors duration-300">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span>Configurar Black Friday</span>
            </a>
        </div>
    </div>
</div>
@endsection
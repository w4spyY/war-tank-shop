@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg">
    @if(session('status'))
        <div class="mb-4 text-green-500 text-center">
            {{ session('status') }}
        </div>
    @endif

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">{{ $user->name }} {{ $user->lastname }}</h2>
    </div>

    <!-- Información Básica -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800">Información Personal</h3>
            <p class="mt-2 text-gray-600"><strong>Nombre:</strong> {{ $user->name }} {{ $user->lastname }}</p>
            <p class="mt-2 text-gray-600"><strong>Fecha de Nacimiento:</strong> {{ $user->nacimiento ? $user->nacimiento->format('d/m/Y') : 'No disponible' }}</p>
            <p class="mt-2 text-gray-600"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="mt-2 text-gray-600"><strong>Teléfono:</strong> {{ $user->telefono ?? 'No disponible' }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800">Dirección</h3>
            <p class="mt-2 text-gray-600"><strong>Dirección de Envío:</strong> {{ $user->direccion ?? 'No disponible' }}</p>
            <p class="mt-2 text-gray-600"><strong>Dirección de Facturación:</strong> {{ $user->facturacion ?? 'No disponible' }}</p>
        </div>
    </div>

    <!-- Sección de Acciones Rápidas -->
    <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Acciones Rápidas</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Botón 1 -->
            <a href="#" class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:bg-gray-100 transition duration-300">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Mis Pedidos</span>
            </a>

            <!-- Botón 2 -->
            <a href="#" class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:bg-gray-100 transition duration-300">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Métodos de Pago</span>
            </a>

            <!-- Botón 3 -->
            <a href="#" class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:bg-gray-100 transition duration-300">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Facturas</span>
            </a>

            <!-- Botón 4 -->
            <a href="#" class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:bg-gray-100 transition duration-300">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-700">Seguridad</span>
            </a>

            @if($user->role === 'admin')
                <!-- Botón de Admin -->
                <a href="{{ route('admin.panel') }}" class="flex flex-col items-center p-4 bg-white rounded-lg shadow hover:bg-gray-100 transition duration-300">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Panel Admin</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Botón para ir a editar el perfil -->
    <div class="mt-8 text-center">
        <a href="{{ route('profile.edit') }}" class="inline-block px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 transition duration-300">Editar Perfil</a>
    </div>
</div>
@endsection
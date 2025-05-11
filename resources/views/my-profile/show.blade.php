@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    @if(session('status'))
        <div class="mb-4 text-green-500 text-center">
            {{ session('status') }}
        </div>
    @endif

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-[var(--tercero)]">{{ $user->name }} {{ $user->lastname }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
            <div class="text-center">
                <h3 class="text-xl font-bold text-[var(--tercero)]">Información Personal</h3>
            </div>
            <hr class="border-[var(--tercero)] border-t-4 rounded">
            <p class="mt-2 text-[var(--tercero)]"><strong>Nombre:</strong> {{ $user->name }} {{ $user->lastname }}</p>
            <p class="mt-2 text-[var(--tercero)]"><strong>Fecha de Nacimiento:</strong> {{ $user->nacimiento ? $user->nacimiento->format('d/m/Y') : 'No disponible' }}</p>
            <p class="mt-2 text-[var(--tercero)]"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="mt-2 text-[var(--tercero)]"><strong>Teléfono:</strong> {{ $user->telefono ?? 'No disponible' }}</p>
            <p class="mt-2 text-[var(--tercero)]">
                <strong>Email verificado:</strong> 
                @if($user->hasVerifiedEmail())
                    <span class="text-green-500">Sí</span>
                @else
                    <span class="text-red-500">No</span>
                    <form method="POST" action="{{ route('verification.send') }}" class="inline">
                        @csrf
                        <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700 text-sm">
                            Reenviar email de verificación
                        </button>
                    </form>
                @endif
            </p>
        </div>

        <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
            <div class="text-center">
                <h3 class="text-xl font-bold text-[var(--tercero)]">Dirección</h3>
            </div>
            <hr class="border-[var(--tercero)] border-t-4 rounded">
            <p class="mt-2 text-[var(--tercero)]"><strong>Dirección de Envío:</strong> {{ $user->direccion ?? 'No disponible' }}</p>
            <p class="mt-2 text-[var(--tercero)]"><strong>Dirección de Facturación:</strong> {{ $user->facturacion ?? 'No disponible' }}</p>
        </div>
    </div>

    <div class="mt-8 bg-[var(--sexto)] p-6 rounded-lg shadow-sm">
        <div class="text-center">
            <h3 class="text-xl font-bold text-[var(--tercero)]">Acciones Rápidas</h3>
        </div>
        <hr class="border-[var(--tercero)] mb-2 mt-1 border-t-4 rounded">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <a href="#" class="hover:scale-105 flex flex-col items-center p-4 bg-[var(--tercero)] rounded-lg shadow hover:bg-[var(--tercero-oscuro)] transition duration-300">
                <div class="w-10 h-10 bg-[var(--segundo)] rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--tercero)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-[var(--sexto)]">Mis Pedidos</span>
            </a>

            <a href="#" class="hover:scale-105 flex flex-col items-center p-4 bg-[var(--tercero)] rounded-lg shadow hover:bg-[var(--tercero-oscuro)] transition duration-300">
                <div class="w-10 h-10 bg-[var(--segundo)] rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--tercero)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-[var(--sexto)]">Métodos de Pago</span>
            </a>

            <a href="#" class="hover:scale-105 flex flex-col items-center p-4 bg-[var(--tercero)] rounded-lg shadow hover:bg-[var(--tercero-oscuro)] transition duration-300">
                <div class="w-10 h-10 bg-[var(--segundo)] rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--tercero)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-[var(--sexto)]">Facturas</span>
            </a>

            <a href="#" class="hover:scale-105 flex flex-col items-center p-4 bg-[var(--tercero)] rounded-lg shadow hover:bg-[var(--tercero-oscuro)] transition duration-300">
                <div class="w-10 h-10 bg-[var(--segundo)] rounded-full flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--tercero)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-[var(--sexto)]">Seguridad</span>
            </a>

            @if($user->role === 'admin')
                <a href="{{ route('admin.panel') }}" class="hover:scale-105 flex flex-col items-center p-4 bg-[var(--cuarto)] rounded-lg shadow hover:bg-[var(--quinto)] transition duration-300">
                    <div class="w-10 h-10 bg-[var(--segundo)] rounded-full flex items-center justify-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--tercero)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-[var(--sexto)]">Panel Admin</span>
                </a>
            @endif
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('profile.edit') }}" class="inline-block font-bold hover:scale-110 px-6 py-2 text-[var(--sexto)] bg-[var(--cuarto)] rounded hover:bg-[var(--quinto)] transition duration-300">Editar Perfil</a>
    </div>
</div>
@endsection
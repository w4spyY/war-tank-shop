@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <h2 class="text-3xl font-bold text-[var(--tercero)] text-center mb-8">Editar Perfil</h2>
    
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
                <label for="name" class="block text-sm font-semibold text-[var(--tercero)]">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                       class="mt-1 block w-full px-4 py-2 rounded-md bg-[var(--tercero)] text-[var(--sexto)]">
            </div>

            <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
                <label for="lastname" class="block text-sm font-semibold text-[var(--tercero)]">Apellido</label>
                <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $user->lastname) }}" 
                       class="mt-1 block w-full px-4 py-2 rounded-md bg-[var(--tercero)] text-[var(--sexto)]">
            </div>
        </div>

        <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm mt-6">
            <label for="email" class="block text-sm font-semibold text-[var(--tercero)]">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                   class="mt-1 block w-full px-4 py-2 rounded-md bg-[var(--tercero)] text-[var(--sexto)]">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
                <label for="telefono" class="block text-sm font-semibold text-[var(--tercero)]">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $user->telefono) }}" 
                       class="mt-1 block w-full px-4 py-2 rounded-md bg-[var(--tercero)] text-[var(--sexto)]">
            </div>

            <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
                <label for="direccion" class="block text-sm font-semibold text-[var(--tercero)]">Dirección de Envío</label>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $user->direccion) }}" 
                       class="mt-1 block w-full px-4 py-2 rounded-md bg-[var(--tercero)] text-[var(--sexto)]">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
                <label for="facturacion" class="block text-sm font-semibold text-[var(--tercero)]">Dirección de Facturación</label>
                <input type="text" name="facturacion" id="facturacion" value="{{ old('facturacion', $user->facturacion) }}" 
                       class="mt-1 block w-full px-4 py-2 rounded-md bg-[var(--tercero)] text-[var(--sexto)]">
            </div>

            <div class="bg-[var(--sexto)] p-4 rounded-lg shadow-sm">
                <label for="nacimiento" class="block text-sm font-semibold text-[var(--tercero)]">Fecha de Nacimiento</label>
                <input type="date" name="nacimiento" id="nacimiento" value="{{ old('nacimiento', $user->nacimiento ? $user->nacimiento->format('Y-m-d') : '') }}" 
                       class="mt-1 block w-full px-4 py-2 rounded-md bg-[var(--tercero)] text-[var(--sexto)]">
            </div>
        </div>

        <div>
            <div class="mt-6 gap-4 flex justify-center">
                <button type="submit" 
                        class="inline-block px-6 py-2 text-[var(--sexto)] bg-[var(--cuarto)] rounded hover:bg-[var(--quinto)] transition duration-300">
                    Actualizar Perfil
                </button>
            </div>
            <div class="mt-2 flex justify-center">
                <a href="{{ route('profile.show') }}" 
                   class="inline-block px-6 py-2 text-[var(--sexto)] bg-[var(--tercero)] rounded hover:bg-[var(--tercero-oscuro)] transition duration-300">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
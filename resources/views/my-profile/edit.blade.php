@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Editar Perfil</h2>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <label for="name" class="block text-sm font-semibold text-gray-800">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <label for="lastname" class="block text-sm font-semibold text-gray-800">Apellido</label>
                <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $user->lastname) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg shadow-sm mt-6">
            <label for="email" class="block text-sm font-semibold text-gray-800">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <label for="telefono" class="block text-sm font-semibold text-gray-800">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $user->telefono) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <label for="direccion" class="block text-sm font-semibold text-gray-800">Dirección de Envío</label>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $user->direccion) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <label for="facturacion" class="block text-sm font-semibold text-gray-800">Dirección de Facturación</label>
                <input type="text" name="facturacion" id="facturacion" value="{{ old('facturacion', $user->facturacion) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <label for="nacimiento" class="block text-sm font-semibold text-gray-800">Fecha de Nacimiento</label>
                <input type="date" name="nacimiento" id="nacimiento" value="{{ old('nacimiento', $user->nacimiento ? $user->nacimiento->format('Y-m-d') : '') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
        </div>

        <div class="mt-8 flex justify-between">
            <a href="{{ route('profile.show') }}" class="inline-block px-6 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 transition duration-300">Cancelar</a>
            <button type="submit" class="inline-block px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 transition duration-300">Actualizar Perfil</button>
        </div>
    </form>
</div>
@endsection
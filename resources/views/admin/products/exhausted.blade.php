@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--tercero)]">Productos con Bajo Stock</h1>
        <div class="flex space-x-4">
            <div class="bg-[var(--sexto)] rounded-lg shadow-md px-4 py-2 border border-[var(--tercero)]">
                <span class="text-sm font-semibold text-[var(--tercero)]">Productos con bajo stock: {{ $tanks->total() }}</span>
            </div>
        </div>
    </div>

    <div class="bg-[var(--sexto)] rounded-lg shadow-md overflow-hidden border border-[var(--tercero)]">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--tercero)]">
                <thead class="bg-[var(--tercero)]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            País
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Stock
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-[var(--sexto)] divide-y divide-[var(--tercero)]">
                    @foreach ($tanks as $tank)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-[var(--tercero)]">{{ $tank->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-[var(--tercero)]">{{ $tank->country }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-[var(--tercero)]">€{{ number_format($tank->price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[var(--agotado)] text-[var(--sexto)]">
                                {{ $tank->stock }} unidades
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-[var(--sexto)] px-4 py-3 border-t border-[var(--tercero)] sm:px-6">
            {{ $tanks->links() }}
        </div>
    </div>
</div>
@endsection
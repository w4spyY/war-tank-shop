@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--tercero)]">Mis Pedidos</h1>
    </div>

    @if($invoices->isEmpty())
        <div class="bg-[var(--sexto)] rounded-lg shadow-md p-6 text-center border border-[var(--tercero)]">
            <p class="text-[var(--tercero)]">No tienes pedidos realizados.</p>
        </div>
    @else
        <div class="bg-[var(--sexto)] rounded-lg shadow-md overflow-hidden border border-[var(--tercero)]">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--tercero)]">
                    <thead class="bg-[var(--tercero)]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                N° Factura
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-[var(--sexto)] divide-y divide-[var(--tercero)]">
                        @foreach ($invoices as $invoice)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-[var(--tercero)]">#{{ $invoice->invoice_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[var(--tercero)]">{{ $invoice->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[var(--tercero)]">€{{ number_format($invoice->total, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-[var(--pendiente)] text-[var(--sexto)]',
                                        'paid' => 'bg-[var(--pagado)] text-[var(--sexto)]',
                                        'cancelled' => 'bg-[var(--cancelado)] text-[var(--sexto)]',
                                        'refunded' => 'bg-[var(--refunded)] text-[var(--sexto)]',
                                    ];
                                    $class = $statusClasses[$invoice->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $class }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('invoice.show', $invoice->id) }}" class="text-[var(--cuarto)] hover:text-[var(--quinto)]">Ver Detalles</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-[var(--sexto)] px-4 py-3 border-t border-[var(--tercero)] sm:px-6">
                {{ $invoices->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
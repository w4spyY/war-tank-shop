@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--tercero)]">Historial de Ventas</h1>
        
        <div class="flex space-x-4">
            <div class="bg-[var(--sexto)] rounded-lg shadow-md px-4 py-2 border border-[var(--tercero)]">
                <span class="text-sm font-semibold text-[var(--tercero)]">Total facturas: {{ $invoices->total() }}</span>
            </div>
        </div>
    </div>

    <div class="bg-[var(--sexto)] rounded-lg shadow-md overflow-hidden border border-[var(--tercero)]">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--tercero)]">
                <thead class="bg-[var(--tercero)]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Factura
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Cliente
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Productos
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
                            <div class="text-sm text-[var(--tercero)]">
                                {{ $invoice->user->name }} {{ $invoice->user->lastname }}
                            </div>
                            <div class="text-xs text-[var(--tercero)]">{{ $invoice->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-[var(--tercero)]">{{ $invoice->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-[var(--tercero)]">
                                @foreach ($invoice->items as $item)
                                    <div class="mb-1 last:mb-0">
                                        {{ $item->quantity }}x {{ $item->name }}
                                        <span class="text-xs">({{ $item->product_type }})</span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-[var(--tercero)]">€{{ number_format($invoice->total, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'paid' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'refunded' => 'bg-blue-100 text-blue-800',
                                ];
                                $class = $statusClasses[$invoice->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $class }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('invoice.show', $invoice->id) }}" class="text-[var(--cuarto)] hover:text-[var(--quinto)] mr-3">Ver</a>
                            @if($invoice->status === 'paid')
                            <a href="#" class="text-[var(--cuarto)] hover:text-[var(--quinto)]">
                                Reembolsar
                            </a>
                            <form id="refund-form-{{ $invoice->id }}" action="#" method="POST" class="hidden">
                                @csrf
                                @method('PATCH')
                            </form>
                            @endif
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
</div>
@endsection
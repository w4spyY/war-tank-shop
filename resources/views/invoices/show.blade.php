@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-[var(--segundo)] rounded-lg shadow-md overflow-hidden border-2 border-[var(--tercero)]">

        <div class="bg-[var(--primero)] text-[var(--tercero)] px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Factura #{{ $invoice->invoice_number }}</h1>
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold text-[var(--primero)]
                              {{ $invoice->status === 'paid' ? 'bg-[var(--pagado)]' : 
                                 ($invoice->status === 'pending' ? 'bg-[var(--pendiente)]' : 
                                 ($invoice->status === 'cancelled' ? 'bg-[var(--cancelado)]' : 'bg-[var(--refunded)]')) }}">
                        {{ strtoupper($invoice->status) }}
                    </span>
                </div>
            </div>
            <p class="text-sm opacity-90 mt-1">
                Fecha: {{ $invoice->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 border-b">
            <div>
                <h2 class="text-lg font-semibold text-[var(--tercero)] mb-2">Cliente</h2>
                <p class="text-[var(--tercero)]">{{ $invoice->user->name }} {{ $invoice->user->lastname }}</p>
                <p class="text-[var(--tercero)]">{{ $invoice->user->email }}</p>
                <p class="text-[var(--tercero)]">{{ $invoice->user->direccion ?? 'Dirección no especificada' }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-[var(--tercero)] mb-2">Facturación</h2>
                <p class="text-[var(--tercero)]">{{ $invoice->billing_name }}</p>
                <p class="text-[var(--tercero)]">{{ $invoice->billing_address }}</p>
                <p class="text-[var(--tercero)]">NIF/CIF: {{ $invoice->billing_tax_id }}</p>
            </div>
        </div>

        <div class="p-6">
            <h2 class="text-lg font-semibold text-[var(--tercero)] mb-4">Detalles del pedido</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--tercero)]">
                    <thead class="bg-[var(--primero)]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Precio unitario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[var(--primero)] divide-y divide-[var(--tercero)]">
                        @foreach($invoice->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-[var(--tercero)]">{{ $item->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $item->product_type === 'tank' ? 'bg-[var(--pagado)] text-[var(--sexto)]' : 'bg-[var(--pendiente)] text-[var(--sexto)]' }}">
                                    {{ $item->product_type === 'tank' ? 'Tanque' : 'Pieza' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--tercero)]">
                                {{ number_format($item->unit_price, 2) }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--tercero)]">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--tercero)]">
                                {{ number_format($item->total_price, 2) }} €
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!--resumen-->
        <div class="bg-[var(--segundo)] px-6 py-4 border-t">
            <div class="flex justify-end">
                <div class="w-full max-w-md">
                    <div class="flex justify-between py-2">
                        <span class="text-[var(--tercero)]">Subtotal:</span>
                        <span class="font-medium text-[var(--tercero)]">{{ number_format($invoice->subtotal, 2) }} €</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-[var(--tercero)]">Impuestos ({{ $invoice->items->first()->tax_rate * 100 }}%):</span>
                        <span class="font-medium text-[var(--tercero)]">{{ number_format($invoice->tax, 2) }} €</span>
                    </div>
                    <div class="flex justify-between py-2 border-t border-[var(--tercero)] mt-2">
                        <span class="text-lg font-semibold text-[var(--tercero)]">Total:</span>
                        <span class="text-lg font-bold text-[var(--tercero)]">{{ number_format($invoice->total, 2) }} €</span>
                    </div>
                    
                    @if($invoice->status === 'paid')
                        <div class="mt-6 pt-4 border-t border-[var(--tercero)]">
                            <h3 class="text-md font-semibold text-[var(--tercero)] mb-2">Información de pago</h3>
                            @if($invoice->payment)
                                <p class="text-sm text-[var(--tercero)]">
                                    Método: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}
                                </p>
                                <p class="text-sm text-[var(--tercero)]">
                                    ID de transacción: {{ $invoice->payment->transaction_id }}
                                </p>
                                <p class="text-sm text-[var(--tercero)]">
                                    Fecha de pago: {{ $invoice->payment->paid_at->format('d/m/Y H:i') }}
                                </p>
                            @else
                                <p class="text-sm text-[var(--tercero)]">
                                    Método: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}
                                </p>
                                <p class="text-sm text-[var(--tercero)]">
                                    (Detalles de pago no registrados)
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!--acciones-->
        <div class="bg-[var(--segundo)] px-6 py-4 flex justify-end space-x-4">
            <form action="{{ route('invoice.send', $invoice) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-[var(--cuarto)] text-[var(--sexto)] rounded hover:bg-[var(--quinto)] font-bold transition-all duration-100 hover:scale-105">
                    Enviar por email
                </button>
            </form>
            <a href="{{ route('invoice.download', $invoice) }}" class="px-4 py-2 bg-[var(--cuarto)] text-[var(--sexto)] rounded hover:bg-[var(--quinto)] font-bold transition-all duration-100 hover:scale-105">
                Descargar PDF
            </a>
        </div>
    </div>
</div>
@endsection
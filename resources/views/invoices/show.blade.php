@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">

        <div class="bg-[var(--tercero)] text-white px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Factura #{{ $invoice->invoice_number }}</h1>
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                              {{ $invoice->status === 'paid' ? 'bg-green-500' : 
                                 ($invoice->status === 'pending' ? 'bg-yellow-500' : 
                                 ($invoice->status === 'cancelled' ? 'bg-red-500' : 'bg-blue-500')) }}">
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
                <p class="text-gray-700">{{ $invoice->user->name }} {{ $invoice->user->lastname }}</p>
                <p class="text-gray-700">{{ $invoice->user->email }}</p>
                <p class="text-gray-700">{{ $invoice->user->direccion ?? 'Dirección no especificada' }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-[var(--tercero)] mb-2">Facturación</h2>
                <p class="text-gray-700">{{ $invoice->billing_name }}</p>
                <p class="text-gray-700">{{ $invoice->billing_address }}</p>
                <p class="text-gray-700">NIF/CIF: {{ $invoice->billing_tax_id }}</p>
            </div>
        </div>

        <div class="p-6">
            <h2 class="text-lg font-semibold text-[var(--tercero)] mb-4">Detalles del pedido</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio unitario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($invoice->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $item->product_type === 'tank' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $item->product_type === 'tank' ? 'Tanque' : 'Pieza' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($item->unit_price, 2) }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ number_format($item->total_price, 2) }} €
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!--resumen-->
        <div class="bg-gray-50 px-6 py-4 border-t">
            <div class="flex justify-end">
                <div class="w-full max-w-md">
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-medium">{{ number_format($invoice->subtotal, 2) }} €</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Impuestos ({{ $invoice->items->first()->tax_rate * 100 }}%):</span>
                        <span class="font-medium">{{ number_format($invoice->tax, 2) }} €</span>
                    </div>
                    <div class="flex justify-between py-2 border-t border-gray-200 mt-2">
                        <span class="text-lg font-semibold text-[var(--tercero)]">Total:</span>
                        <span class="text-lg font-bold">{{ number_format($invoice->total, 2) }} €</span>
                    </div>
                    
                    @if($invoice->status === 'paid')
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <h3 class="text-md font-semibold text-[var(--tercero)] mb-2">Información de pago</h3>
                            @if($invoice->payment)
                                <p class="text-sm text-gray-600">
                                    Método: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    ID de transacción: {{ $invoice->payment->transaction_id }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Fecha de pago: {{ $invoice->payment->paid_at->format('d/m/Y H:i') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Estado: <span class="font-medium text-green-600">Completado</span>
                                </p>
                            @else
                                <p class="text-sm text-gray-600">
                                    Método: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Estado: <span class="font-medium text-green-600">Completado</span>
                                </p>
                                <p class="text-sm text-gray-400">
                                    (Detalles de pago no registrados)
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!--acciones-->
        <div class="bg-gray-100 px-6 py-4 flex justify-end space-x-4">
            <form action="{{ route('invoice.send', $invoice) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Enviar por email
                </button>
            </form>
            <a href="{{ route('invoice.download', $invoice) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Descargar PDF
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Imprimir factura
            </button>
        </div>
    </div>
</div>
@endsection
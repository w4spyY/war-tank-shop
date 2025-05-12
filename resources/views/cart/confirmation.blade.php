@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h1 class="text-3xl font-bold mb-2">¡Pago Completado con Éxito!</h1>
            <p class="text-gray-600">Gracias por tu compra. Aquí está el resumen de tu pedido.</p>
        </div>

        <div class="border-b pb-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Detalles de la Factura</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Número de Factura:</p>
                    <p class="font-semibold">{{ $invoice->invoice_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Fecha:</p>
                    <p class="font-semibold">{{ $invoice->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Método de Pago:</p>
                    <p class="font-semibold">Pago Simulado</p>
                </div>
                <div>
                    <p class="text-gray-600">Estado:</p>
                    <p class="font-semibold text-green-500">Pagado</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Productos</h2>
            <div class="space-y-4">
                @foreach($invoice->items as $item)
                <div class="flex justify-between border-b pb-4">
                    <div>
                        <h3 class="font-medium">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $item->product_type === 'tank' ? 'Tanque' : 'Repuesto' }}</p>
                    </div>
                    <div class="text-right">
                        <p>{{ $item->quantity }} x €{{ number_format($item->unit_price, 2) }}</p>
                        <p class="font-semibold">€{{ number_format($item->total_price, 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="flex justify-between mb-2">
                <span>Subtotal:</span>
                <span>€{{ number_format($invoice->subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>IVA (21%):</span>
                <span>€{{ number_format($invoice->tax, 2) }}</span>
            </div>
            <div class="flex justify-between font-bold text-lg pt-2 border-t">
                <span>Total:</span>
                <span>€{{ number_format($invoice->total, 2) }}</span>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('main.index') }}" class="inline-block btn-primary px-6 py-3">
                Volver a la Tienda
            </a>
        </div>
    </div>
</div>
@endsection
@component('mail::message')
# Hola {{ $invoice->user->name }},

Adjunto encontrarás tu factura #{{ $invoice->invoice_number }} de {{ config('app.name') }}.

**Resumen del pedido:**  
- Número de factura: #{{ $invoice->invoice_number }}  
- Fecha: {{ $invoice->created_at->format('d/m/Y') }}  
- Total: {{ number_format($invoice->total, 2) }} €  

@component('mail::button', ['url' => route('invoice.show', $invoice)])
Ver factura en línea
@endcomponent

Gracias por tu compra,  
El equipo de {{ config('app.name') }}
@endcomponent
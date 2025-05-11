<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura #{{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .invoice-info { margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f8f9fa; text-align: left; padding: 8px; }
        .table td { padding: 8px; border-bottom: 1px solid #ddd; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; }
        .footer { margin-top: 50px; font-size: 0.8em; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Factura #{{ $invoice->invoice_number }}</h1>
        <p>Fecha: {{ $invoice->created_at->format('d/m/Y H:i') }}</p>
        <p>Estado: {{ strtoupper($invoice->status) }}</p>
    </div>

    <div class="invoice-info">
        <table width="100%">
            <tr>
                <td width="50%">
                    <strong>Cliente:</strong><br>
                    {{ $invoice->user->name }} {{ $invoice->user->lastname }}<br>
                    {{ $invoice->user->email }}<br>
                    {{ $invoice->user->direccion ?? 'Dirección no especificada' }}
                </td>
                <td width="50%">
                    <strong>Facturación:</strong><br>
                    {{ $invoice->billing_name }}<br>
                    {{ $invoice->billing_address }}<br>
                    NIF/CIF: {{ $invoice->billing_tax_id }}
                </td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Tipo</th>
                <th class="text-right">Precio unitario</th>
                <th class="text-right">Cantidad</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->product_type === 'tank' ? 'Tanque' : 'Pieza' }}</td>
                <td class="text-right">{{ number_format($item->unit_price, 2) }} €</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->total_price, 2) }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px; float: right; width: 300px;">
        <table width="100%">
            <tr>
                <td>Subtotal:</td>
                <td class="text-right">{{ number_format($invoice->subtotal, 2) }} €</td>
            </tr>
            <tr>
                <td>Impuestos ({{ $invoice->items->first()->tax_rate * 100 }}%):</td>
                <td class="text-right">{{ number_format($invoice->tax, 2) }} €</td>
            </tr>
            <tr class="total-row">
                <td>Total:</td>
                <td class="text-right">{{ number_format($invoice->total, 2) }} €</td>
            </tr>
        </table>
    </div>

    @if($invoice->status === 'paid')
    <div style="margin-top: 100px;">
        <h3>Información de pago</h3>
        @if($invoice->payment)
            <p>Método: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</p>
            <p>ID de transacción: {{ $invoice->payment->transaction_id }}</p>
            <p>Fecha de pago: {{ $invoice->payment->paid_at->format('d/m/Y H:i') }}</p>
            <p>Estado: Completado</p>
        @else
            <p>Método: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</p>
            <p>Estado: Completado</p>
        @endif
    </div>
    @endif

    <div class="footer">
        <p>Gracias por su compra</p>
    </div>
</body>
</html>
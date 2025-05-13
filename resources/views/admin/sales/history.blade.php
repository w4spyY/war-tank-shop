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

    <!-- Modal para cambiar estado -->
    <div id="statusModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-[var(--sexto)]">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-[var(--tercero)]">Cambiar estado de la factura</h3>
                <form id="statusForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <select name="status" class="w-full p-2 border rounded text-[var(--tercero)] bg-[var(--sexto)]">
                        <option value="pending">Pendiente</option>
                        <option value="paid">Pagado</option>
                        <option value="cancelled">Cancelado</option>
                        <option value="refunded">Reembolsado</option>
                    </select>
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-[var(--cuarto)] text-white rounded hover:bg-[var(--quinto)]">
                            Cambiar Estado
                        </button>
                    </div>
                </form>
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
                                    'pending' => 'bg-[var(--pendiente)] text-[var(--sexto)]',
                                    'paid' => 'bg-[var(--pagado)] text-[var(--sexto)]',
                                    'cancelled' => 'bg-[var(--cancelado)] text-[var(--sexto)]',
                                    'refunded' => 'bg-[var(--refunded)] text-[var(--sexto)]',
                                ];
                                $class = $statusClasses[$invoice->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $class }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('invoice.show', $invoice->id) }}" 
                                   class="text-[var(--cuarto)] hover:text-[var(--quinto)] mr-3">
                                    Ver
                                </a>
                                
                                <button onclick="openModal('{{ route('admin.invoices.update-status', $invoice->id) }}', '{{ $invoice->status }}')"
                                        class="text-[var(--cuarto)] hover:text-[var(--quinto)]">
                                    Cambiar Estado
                                </button>
                                
                                @if($invoice->status !== 'paid')
                                <form action="{{ route('admin.invoices.delete', $invoice->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700 ml-2"
                                            onclick="return confirm('¿Estás seguro?')">
                                        Eliminar
                                    </button>
                                </form>
                                @endif
                            </div>
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

<script>
    function openModal(url, currentStatus) {
        const modal = document.getElementById('statusModal');
        const form = document.getElementById('statusForm');
        
        // Configurar el formulario
        form.action = url;
        form.querySelector('select[name="status"]').value = currentStatus;
        
        // Mostrar modal
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera
    window.onclick = function(event) {
        const modal = document.getElementById('statusModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection
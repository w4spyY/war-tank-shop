@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--tercero)]">Gestión de Productos</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.catalog.products.create') }}" class="bg-[var(--cuarto)] text-[var(--sexto)] rounded-lg shadow-md px-4 py-2 hover:bg-[var(--quinto)] transition-colors">
                <span class="text-sm font-semibold">Añadir Producto</span>
            </a>
        </div>
    </div>

    <!--pestañas-->
    <div class="mb-6 border-b border-[var(--tercero)]">
        <nav class="-mb-px flex space-x-8">
            <a href="#" class="border-b-2 border-[var(--cuarto)] text-[var(--cuarto)] whitespace-nowrap py-4 px-1 text-sm font-medium">
                Tanques
            </a>
            <a href="#" class="border-b-2 border-transparent text-[var(--tercero)] hover:text-[var(--cuarto)] hover:border-[var(--cuarto)] whitespace-nowrap py-4 px-1 text-sm font-medium">
                Piezas
            </a>
        </nav>
    </div>

    <!--tanques-->
    <div class="mb-10">
        <h2 class="text-lg font-semibold text-[var(--tercero)] mb-4">Tanques</h2>
        <div class="bg-[var(--sexto)] rounded-lg shadow-md overflow-hidden border border-[var(--tercero)]">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--tercero)]">
                    <thead class="bg-[var(--tercero)]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Categoría
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Stock
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Acciones
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
                                <div class="text-sm text-[var(--tercero)]">{{ $tank->category->name ?? 'Sin categoría' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[var(--tercero)]">€{{ number_format($tank->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $tank->stock > 10 ? 'bg-[var(--mucho)] text-[var(--sexto)]' : 
                                       ($tank->stock > 0 ? 'bg-[var(--poco)] text-[var(--sexto)]' : 'bg-[var(--agotado)] text-[var(--sexto)]') }}">
                                    {{ $tank->stock }} unidades
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="openEditTankModal({{ $tank->id }}, '{{ $tank->name }}', {{ $tank->category_id }}, {{ $tank->price }}, {{ $tank->stock }}, `{{ $tank->description }}`)" 
                                    class="text-[var(--cuarto)] hover:text-[var(--quinto)] mr-3">Editar</button>
                                <button onclick="deleteProduct('tank', {{ $tank->id }})" 
                                        class="text-[var(--quinto)] hover:text-red-700">Eliminar</button>
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

    <!--piezsa-->
    <div>
        <h2 class="text-lg font-semibold text-[var(--tercero)] mb-4">Piezas</h2>
        <div class="bg-[var(--sexto)] rounded-lg shadow-md overflow-hidden border border-[var(--tercero)]">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--tercero)]">
                    <thead class="bg-[var(--tercero)]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Categoría
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Stock
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-[var(--sexto)] divide-y divide-[var(--tercero)]">
                        @foreach ($parts as $part)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-[var(--tercero)]">{{ $part->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[var(--tercero)]">{{ $part->category->name ?? 'Sin categoría' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-[var(--tercero)]">€{{ number_format($part->price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $part->stock > 10 ? 'bg-[var(--mucho)] text-[var(--sexto)]' : 
                                       ($part->stock > 0 ? 'bg-[var(--poco)] text-[var(--sexto)]' : 'bg-[var(--agotado)] text-[var(--sexto)]') }}">
                                    {{ $part->stock }} unidades
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="openEditPartModal({{ $part->id }}, '{{ $part->name }}', {{ $part->category_id }}, {{ $part->price }}, {{ $part->stock }}, {{ $part->weight_kg }}, `{{ $part->description }}`)" 
                                    class="text-[var(--cuarto)] hover:text-[var(--quinto)] mr-3">Editar</button>
                                <button onclick="deleteProduct('part', {{ $part->id }})" 
                                        class="text-[var(--quinto)] hover:text-red-700">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-[var(--sexto)] px-4 py-3 border-t border-[var(--tercero)] sm:px-6">
                {{ $parts->links() }}
            </div>
        </div>
    </div>
</div>

<!--modal tanque-->
<div id="editTankModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-[var(--sexto)]">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-[var(--tercero)]">Editar Tanque</h3>
            <div class="mt-2 px-7 py-3">
                <form id="editTankForm">
                    @csrf
                    <input type="hidden" id="editTankId" name="id">
                    <div class="mb-4">
                        <label for="editTankName" class="block text-sm font-medium text-[var(--tercero)] mb-2">Nombre</label>
                        <input type="text" id="editTankName" name="name" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editTankCategory" class="block text-sm font-medium text-[var(--tercero)] mb-2">Categoría</label>
                        <select id="editTankCategory" name="category_id" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                            @foreach($categories->where('type', 'tank') as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editTankPrice" class="block text-sm font-medium text-[var(--tercero)] mb-2">Precio (€)</label>
                        <input type="number" step="0.01" id="editTankPrice" name="price" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editTankStock" class="block text-sm font-medium text-[var(--tercero)] mb-2">Stock</label>
                        <input type="number" id="editTankStock" name="stock" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editTankDescription" class="block text-sm font-medium text-[var(--tercero)] mb-2">Descripción</label>
                        <textarea id="editTankDescription" name="description" rows="3" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md"></textarea>
                    </div>
                </form>
            </div>
            <div class="flex justify-between px-4 py-3">
                <button onclick="closeEditTankModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                    Cancelar
                </button>
                <button onclick="updateTank()" class="px-4 py-2 bg-[var(--cuarto)] text-white rounded-md hover:bg-[var(--quinto)]">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!--modal pieza-->
<div id="editPartModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-[var(--sexto)]">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-[var(--tercero)]">Editar Pieza</h3>
            <div class="mt-2 px-7 py-3">
                <form id="editPartForm">
                    @csrf
                    <input type="hidden" id="editPartId" name="id">
                    <div class="mb-4">
                        <label for="editPartName" class="block text-sm font-medium text-[var(--tercero)] mb-2">Nombre</label>
                        <input type="text" id="editPartName" name="name" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editPartCategory" class="block text-sm font-medium text-[var(--tercero)] mb-2">Categoría</label>
                        <select id="editPartCategory" name="category_id" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                            @foreach($categories->where('type', 'part') as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editPartPrice" class="block text-sm font-medium text-[var(--tercero)] mb-2">Precio (€)</label>
                        <input type="number" step="0.01" id="editPartPrice" name="price" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editPartStock" class="block text-sm font-medium text-[var(--tercero)] mb-2">Stock</label>
                        <input type="number" id="editPartStock" name="stock" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editPartWeight" class="block text-sm font-medium text-[var(--tercero)] mb-2">Peso</label>
                        <input type="number" id="editPartWeight" name="weight" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editPartDescription" class="block text-sm font-medium text-[var(--tercero)] mb-2">Descripción</label>
                        <textarea id="editPartDescription" name="description" rows="3" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md"></textarea>
                    </div>
                </form>
            </div>
            <div class="flex justify-between px-4 py-3">
                <button onclick="closeEditPartModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                    Cancelar
                </button>
                <button onclick="updatePart()" class="px-4 py-2 bg-[var(--cuarto)] text-white rounded-md hover:bg-[var(--quinto)]">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditTankModal(id, name, categoryId, price, stock, description) {
        document.getElementById('editTankId').value = id;
        document.getElementById('editTankName').value = name;
        document.getElementById('editTankCategory').value = categoryId;
        document.getElementById('editTankPrice').value = price;
        document.getElementById('editTankStock').value = stock;
        document.getElementById('editTankDescription').value = description;

        document.getElementById('editTankModal').classList.remove('hidden');
    }

    function closeEditTankModal() {
        document.getElementById('editTankModal').classList.add('hidden');
    }

    function openEditPartModal(id, name, categoryId, price, stock, weight, description) {
        document.getElementById('editPartId').value = id;
        document.getElementById('editPartName').value = name;
        document.getElementById('editPartCategory').value = categoryId;
        document.getElementById('editPartPrice').value = price;
        document.getElementById('editPartStock').value = stock;
        document.getElementById('editPartWeight').value = weight;
        document.getElementById('editPartDescription').value = description;

        document.getElementById('editPartModal').classList.remove('hidden');
    }

    function closeEditPartModal() {
        document.getElementById('editPartModal').classList.add('hidden');
    }

    function updateTank() {
        const formData = {
            id: document.getElementById('editTankId').value,
            name: document.getElementById('editTankName').value,
            category_id: document.getElementById('editTankCategory').value,
            price: document.getElementById('editTankPrice').value,
            stock: document.getElementById('editTankStock').value,
            description: document.getElementById('editTankDescription').value,
            _token: document.querySelector('input[name="_token"]').value,
            _method: 'PUT'
        };

        fetch(`/admin/catalog/tanks/${formData.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditTankModal();
                window.location.reload();
            } else {
                console.log("error");
                //console.log(data.message);
            }
        })
        .catch(error => {
            console.log('Error:', error);
        });
    }

    function updatePart() {
        const formData = {
            id: document.getElementById('editPartId').value,
            name: document.getElementById('editPartName').value,
            category_id: document.getElementById('editPartCategory').value,
            price: document.getElementById('editPartPrice').value,
            stock: document.getElementById('editPartStock').value,
            weight_kg: document.getElementById('editPartWeight').value,
            description: document.getElementById('editPartDescription').value,
            _token: document.querySelector('input[name="_token"]').value,
            _method: 'PUT'
        };

        fetch(`/admin/catalog/parts/${formData.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeEditPartModal();
                window.location.reload();
            } else {
                console.log(data.message);
            }
        })
        .catch(error => {
            console.log('Error:', error);
        });
    }

    function deleteProduct(type, id) {
        if (!confirm(`¿Estás seguro de eliminar este ${type === 'tank' ? 'tanque' : 'pieza'}?`)) {
            return;
        }

        const formData = {
            _token: document.querySelector('input[name="_token"]').value,
            _method: 'DELETE'
        };

        const endpoint = type === 'tank' 
            ? `/admin/catalog/tanks/${id}` 
            : `/admin/catalog/parts/${id}`;

        fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Mensaje más descriptivo según el tipo de producto
                const productType = type === 'tank' ? 'Tanque' : 'Pieza';
                alert(`${productType} eliminado correctamente`);
                window.location.reload();
            } else {
                throw new Error(data.message || 'No se pudo eliminar el producto');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(`Error al eliminar: ${error.message}`);
        });
    }
</script>
@endsection
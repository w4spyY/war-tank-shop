@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--tercero)]">Gestión de Categorías</h1>
        <div class="bg-[var(--sexto)] rounded-lg shadow-md px-4 py-2 border border-[var(--tercero)]">
            <span class="text-sm font-semibold text-[var(--tercero)]">Total: {{ $categories->total() }}</span>
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
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Descripción
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--sexto)] uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-[var(--sexto)] divide-y divide-[var(--tercero)]">
                    @foreach ($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-[var(--tercero)]">{{ $category->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $category->type === 'tank' ? 'bg-[var(--pagado)] text-[var(--sexto)]' : 'bg-[var(--pendiente)] text-[var(--sexto)]' }}">
                                {{ $category->type === 'tank' ? 'Tanque' : 'Pieza' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-[var(--tercero)]">{{ Str::limit($category->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->type }}', `{{ $category->description }}`)" 
                                    class="text-[var(--cuarto)] hover:text-[var(--quinto)] mr-3">Editar</button>
                            <button onclick="deleteCategory({{ $category->id }})" 
                                    class="text-[var(--quinto)] hover:text-red-700">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-[var(--sexto)] px-4 py-3 border-t border-[var(--tercero)] sm:px-6">
            {{ $categories->links() }}
        </div>
    </div>
</div>

<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-[var(--sexto)]">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-[var(--tercero)]">Editar Categoría</h3>
            <div class="mt-2 px-7 py-3">
                <form id="editForm">
                    @csrf
                    <input type="hidden" id="editCategoryId" name="id">
                    <div class="mb-4">
                        <label for="editName" class="block text-sm font-medium text-[var(--tercero)] mb-2">Nombre</label>
                        <input type="text" id="editName" name="name" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editType" class="block text-sm font-medium text-[var(--tercero)] mb-2">Tipo</label>
                        <select id="editType" name="type" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                            <option value="tank">Tanque</option>
                            <option value="part">Pieza</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editDescription" class="block text-sm font-medium text-[var(--tercero)] mb-2">Descripción</label>
                        <textarea id="editDescription" name="description" rows="3" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md"></textarea>
                    </div>
                </form>
            </div>
            <div class="flex justify-between px-4 py-3">
                <button onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                    Cancelar
                </button>
                <button onclick="updateCategory()" class="px-4 py-2 bg-[var(--cuarto)] text-white rounded-md hover:bg-[var(--quinto)]">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, name, type, description) {
        document.getElementById('editCategoryId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editType').value = type;
        document.getElementById('editDescription').value = description;

        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function updateUser() {
        const formData = {
            id: document.getElementById('editUserId').value,
            name: document.getElementById('editUserName').value,
            lastname: document.getElementById('editUserLastname').value,
            email: document.getElementById('editUserEmail').value,
            role: document.getElementById('editUserRole').value,
            _token: document.querySelector('input[name="_token"]').value,
            _method: 'PUT'
        };

        fetch(`/admin/users/${formData.id}`, {
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
                closeEditUserModal();
                window.location.reload();
            } else {
                console.log("error");
            }
        })
        .catch(error => {
            console.log(error);
        });
    }

    function deleteCategory(id) {
        if (!confirm('¿Estás seguro?')) {
            return;
        }

        const formData = {
            _token: document.querySelector('input[name="_token"]').value,
            _method: 'DELETE'
        };

        fetch(`/admin/catalog/categories/${id}`, {
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
                window.location.reload();
            } else {
                console.log("error");
            }
        })
        .catch(error => {
            console.log(error);
        });
    }
</script>

@endsection
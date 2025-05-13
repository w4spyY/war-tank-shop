@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <h1 class="text-3xl font-bold text-[var(--tercero)] mb-8">Listado de Usuarios</h1>
    
    <div class="overflow-x-auto bg-[var(--sexto)] rounded-lg shadow-md p-6 border border-[var(--tercero)]">
        <table class="min-w-full divide-y divide-[var(--tercero)]" id="usersTable">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-[var(--tercero)] uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-[var(--sexto)] divide-y divide-[var(--tercero)]">
                @foreach($users as $user)
                <tr data-id="{{ $user->id }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--tercero)]">{{ $user->name }} {{ $user->lastname }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--tercero)]">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--tercero)]">
                        <span class="role-badge px-2 py-1 rounded-full text-xs 
                            {{ $user->role === 'admin' ? 'bg-[var(--cuarto)] text-[var(--sexto)]' : 'bg-[var(--tercero)] text-[var(--sexto)]' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="openEditUserModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->lastname }}', '{{ $user->email }}', '{{ $user->role }}')" 
                            class="text-[var(--cuarto)] hover:text-[var(--quinto)] mr-3">Editar</button>
                        <button onclick="deleteUser({{ $user->id }})" 
                            class="text-[var(--quinto)] hover:text-red-700">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="editUserModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-[var(--sexto)]">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-[var(--tercero)]">Editar Usuario</h3>
            <div class="mt-2 px-7 py-3">
                <form id="editUserForm">
                    @csrf
                    <input type="hidden" id="editUserId" name="id">
                    <div class="mb-4">
                        <label for="editUserName" class="block text-sm font-medium text-[var(--tercero)] mb-2">Nombre</label>
                        <input type="text" id="editUserName" name="name" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editUserLastname" class="block text-sm font-medium text-[var(--tercero)] mb-2">Apellido</label>
                        <input type="text" id="editUserLastname" name="lastname" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editUserEmail" class="block text-sm font-medium text-[var(--tercero)] mb-2">Email</label>
                        <input type="email" id="editUserEmail" name="email" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="editUserRole" class="block text-sm font-medium text-[var(--tercero)] mb-2">Rol</label>
                        <select id="editUserRole" name="role" class="w-full px-3 py-2 border border-[var(--tercero)] rounded-md">
                            <option value="user">Usuario</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="flex justify-between px-4 py-3">
                <button onclick="closeEditUserModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                    Cancelar
                </button>
                <button onclick="updateUser()" class="px-4 py-2 bg-[var(--cuarto)] text-white rounded-md hover:bg-[var(--quinto)]">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditUserModal(id, name, lastname, email, role) {
        document.getElementById('editUserId').value = id;
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserLastname').value = lastname;
        document.getElementById('editUserEmail').value = email;
        document.getElementById('editUserRole').value = role;
        
        document.getElementById('editUserModal').classList.remove('hidden');
    }
    
    function closeEditUserModal() {
        document.getElementById('editUserModal').classList.add('hidden');
    }
    
    function updateUser() {
        const userId = document.getElementById('editUserId').value;
        const formData = {
            name: document.getElementById('editUserName').value,
            lastname: document.getElementById('editUserLastname').value,
            email: document.getElementById('editUserEmail').value,
            role: document.getElementById('editUserRole').value,
            _token: document.querySelector('input[name="_token"]').value
        };
        
        if (!formData.name || !formData.lastname || !formData.email) {
            alert('Por favor, complete todos los campos obligatorios.');
            return;
        }
        
        fetch(`/admin/users/${userId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': formData._token
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                closeEditUserModal();
                window.location.reload();
            } else {
                throw new Error('Error');
            }
        })
        .catch(error => {
            console.log(error);
        });
    }
    
    function deleteUser(userId) {
        if (!confirm('¿Estás seguro?')) {
            return;
        }

        const token = document.querySelector('input[name="_token"]').value;

        fetch(`/admin/users/${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                _token: token,
                _method: 'DELETE'
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const row = document.querySelector(`tr[data-id="${userId}"]`);
                if (row) {
                    row.remove();
                }
            } else {
                throw new Error('Error');
            }
        })
        .catch(error => {
            console.log(error);
        });
    }

    document.getElementById('editUserModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditUserModal();
        }
    });
</script>
@endsection
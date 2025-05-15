@extends('layouts.app')

@section('content')
<div class="ms-10 me-10 mx-auto mt-10 mb-10 p-6 bg-[var(--primero)] rounded-xl shadow-lg border border-[var(--tercero)]">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[var(--tercero)]">Crear Nuevo Producto</h1>
    </div>

    <div class="bg-[var(--sexto)] rounded-lg shadow-md p-6 border border-[var(--tercero)]">
        <div class="mb-6">
            <label class="block text-sm font-medium text-[var(--tercero)] mb-2">Tipo de Producto</label>
            <div class="flex space-x-4">
                <button type="button" id="tankBtn" class="px-4 py-2 bg-[var(--cuarto)] text-[var(--sexto)] rounded-lg font-medium hover:bg-[var(--quinto)] transition-all duration-100 hover:scale-105">Tanque</button>
                <button type="button" id="partBtn" class="px-4 py-2 bg-[var(--cuarto)] text-[var(--sexto)] rounded-lg font-medium hover:bg-[var(--quinto)] transition-all duration-100 hover:scale-105">Pieza</button>
            </div>
        </div>

        <!--tanques-->
        <div id="tankForm">
            <form id="createTankForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tank_name" class="block text-sm font-medium text-[var(--tercero)] mb-2">Nombre del Tanque*</label>
                        <input type="text" id="tank_name" name="name" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_code" class="block text-sm font-medium text-[var(--tercero)] mb-2">Código*</label>
                        <input type="text" id="tank_code" name="code" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_category" class="block text-sm font-medium text-[var(--tercero)] mb-2">Categoría*</label>
                        <select id="tank_category" name="category_id" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                            @foreach($categories->where('type', 'tank') as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="tank_price" class="block text-sm font-medium text-[var(--tercero)] mb-2">Precio (€)*</label>
                        <input type="number" step="0.01" id="tank_price" name="price" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_stock" class="block text-sm font-medium text-[var(--tercero)] mb-2">Stock*</label>
                        <input type="number" id="tank_stock" name="stock" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_country" class="block text-sm font-medium text-[var(--tercero)] mb-2">País de origen*</label>
                        <input type="text" id="tank_country" name="country" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_weight" class="block text-sm font-medium text-[var(--tercero)] mb-2">Peso (kg)*</label>
                        <input type="number" step="0.01" id="tank_weight" name="weight_kg" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_crew" class="block text-sm font-medium text-[var(--tercero)] mb-2">Capacidad de tripulación*</label>
                        <input type="number" id="tank_crew" name="crew_capacity" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_fuel_capacity" class="block text-sm font-medium text-[var(--tercero)] mb-2">Capacidad de combustible (litros)*</label>
                        <input type="number" step="0.01" id="tank_fuel_capacity" name="fuel_capacity_liters" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_fuel_type" class="block text-sm font-medium text-[var(--tercero)] mb-2">Tipo de combustible*</label>
                        <input type="text" id="tank_fuel_type" name="fuel_type" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_horsepower" class="block text-sm font-medium text-[var(--tercero)] mb-2">Caballos de fuerza*</label>
                        <input type="number" id="tank_horsepower" name="horsepower" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_ammunition" class="block text-sm font-medium text-[var(--tercero)] mb-2">Tipo de munición*</label>
                        <input type="text" id="tank_ammunition" name="ammunition_type" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_speed" class="block text-sm font-medium text-[var(--tercero)] mb-2">Velocidad máxima (km/h)*</label>
                        <input type="number" id="tank_speed" name="max_speed_kmh" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_armor" class="block text-sm font-medium text-[var(--tercero)] mb-2">Tipo de blindaje*</label>
                        <input type="text" id="tank_armor" name="armor_type" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_range" class="block text-sm font-medium text-[var(--tercero)] mb-2">Alcance (km)*</label>
                        <input type="number" id="tank_range" name="range_km" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_year" class="block text-sm font-medium text-[var(--tercero)] mb-2">Año de fabricación*</label>
                        <input type="number" id="tank_year" name="manufacture_year" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="tank_image" class="block text-sm font-medium text-[var(--tercero)] mb-2">Imagen del tanque*</label>
                        <input type="file" id="tank_image" name="image" accept="image/*" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="tank_description" class="block text-sm font-medium text-[var(--tercero)] mb-2">Descripción*</label>
                    <textarea id="tank_description" name="description" rows="3" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]"></textarea>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-[var(--cuarto)] text-[var(--sexto)] rounded-lg font-medium hover:bg-[var(--quinto)] transition-colors">Crear Tanque</button>
                </div>
            </form>
        </div>

        <!--piezas-->
        <div id="partForm" class="hidden">
            <form id="createPartForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="part_name" class="block text-sm font-medium text-[var(--tercero)] mb-2">Nombre de la Pieza*</label>
                        <input type="text" id="part_name" name="name" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="part_code" class="block text-sm font-medium text-[var(--tercero)] mb-2">Código*</label>
                        <input type="text" id="part_code" name="code" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="part_category" class="block text-sm font-medium text-[var(--tercero)] mb-2">Categoría*</label>
                        <select id="part_category" name="category_id" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                            @foreach($categories->where('type', 'part') as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="part_price" class="block text-sm font-medium text-[var(--tercero)] mb-2">Precio (€)*</label>
                        <input type="number" step="0.01" id="part_price" name="price" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="part_stock" class="block text-sm font-medium text-[var(--tercero)] mb-2">Stock*</label>
                        <input type="number" id="part_stock" name="stock" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="part_country" class="block text-sm font-medium text-[var(--tercero)] mb-2">País de origen*</label>
                        <input type="text" id="part_country" name="country" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="part_material" class="block text-sm font-medium text-[var(--tercero)] mb-2">Material*</label>
                        <input type="text" id="part_material" name="material" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                    
                    <div>
                        <label for="part_image" class="block text-sm font-medium text-[var(--tercero)] mb-2">Imagen de la pieza*</label>
                        <input type="file" id="part_image" name="image" accept="image/*" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>

                    <div>
                        <label for="part_weight" class="block text-sm font-medium text-[var(--tercero)] mb-2">Peso (kg)*</label>
                        <input type="number" step="0.01" id="part_weight" name="weight_kg" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]">
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="part_description" class="block text-sm font-medium text-[var(--tercero)] mb-2">Descripción*</label>
                    <textarea id="part_description" name="description" rows="3" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]"></textarea>
                </div>
                
                <div class="mt-6">
                    <label for="part_compatibility" class="block text-sm font-medium text-[var(--tercero)] mb-2">Notas de Compatibilidad*</label>
                    <textarea id="part_compatibility" name="compatibility_notes" rows="2" required class="w-full px-3 py-2 border border-[var(--tercero)] rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--cuarto)] bg-[var(--tercero)]"></textarea>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-[var(--cuarto)] text-[var(--sexto)] rounded-lg font-medium hover:bg-[var(--quinto)] transition-colors">Crear Pieza</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('tankBtn').addEventListener('click', function() {
        document.getElementById('tankForm').classList.remove('hidden');
        document.getElementById('partForm').classList.add('hidden');
    });

    document.getElementById('partBtn').addEventListener('click', function() {
        document.getElementById('partForm').classList.remove('hidden');
        document.getElementById('tankForm').classList.add('hidden');
    });

    function createTank() {
        const form = document.getElementById('createTankForm');
        const formData = new FormData(form);
        formData.append('_token', document.querySelector('input[name="_token"]').value);

        fetch('/admin/catalog/tanks', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
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

    function createPart() {
        const form = document.getElementById('createPartForm');
        const formData = new FormData(form);
        formData.append('_token', document.querySelector('input[name="_token"]').value);

        fetch('/admin/catalog/parts', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
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
            console.error('Error:', error);
            alert('Error al crear la pieza');
        });
    }

    document.getElementById('createTankForm').addEventListener('submit', function(e) {
        e.preventDefault();
        createTank();
    });

    document.getElementById('createPartForm').addEventListener('submit', function(e) {
        e.preventDefault();
        createPart();
    });
</script>
@endsection
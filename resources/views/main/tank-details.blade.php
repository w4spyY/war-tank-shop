@extends('layouts.app')

@section('content')

<div class="m-5">
    <div class="flex flex-col lg:flex-row gap-4">

        <div class="w-full lg:w-[70%] flex">
            <div class="w-full overflow-hidden flex">
                <img 
                    src="{{ asset($tank->image_url) }}" 
                    alt="{{ $tank->name }}" 
                    class="w-full h-auto lg:h-full object-cover rounded-xl border-2 border-[var(--sexto)]"
                >
            </div>
        </div>

        <div class="w-full lg:w-[30%] flex-grow p-6 card-bg rounded-lg shadow-lg flex flex-col justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold card-h1 mb-4">{{ $tank->name }}</h1>
                <p class="text-[var(--tercero-oscuro)] text-xs mb-3">Codigo: {{ $tank->code }}</p>
                <p class="text-base md:text-lg card-h1 rounded mb-4">{{ $tank->description }}</p>
                
                <div class="space-y-3">
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Peso:</span> {{ $tank->weight_kg }} kg</p>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Capacidad:</span> {{ $tank->crew_capacity }} miembros</p>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Tipo de combustible:</span> {{ $tank->fuel_type }}</p>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Caballos de fuerza:</span> {{ $tank->horsepower }} HP</p>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Tipo de munición:</span> {{ $tank->ammunition_type }}</p>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Velocidad máxima:</span> {{ $tank->max_speed_kmh }} km/h</p>
                </div>
            </div>
        
            <div>
                <p class="text-xl md:text-2xl font-bold card-h1 mt-6"><span class="font-semibold">Precio:</span> € <span class="underline"> {{ number_format($tank->price, 2) }}</span></p>
                <button class="btn-add-to-cart bg-[var(--cuarto)] p-3 mt-2 text-[var(--sexto)] font-bold rounded-lg hover:bg-[var(--quinto)] hover:scale-110 transition-all duration-100" 
                        data-product-id="{{ $tank->id }}" 
                        data-product-type="tank" 
                        data-product-name="{{ $tank->name }}" 
                        data-product-price="{{ $tank->price }}" 
                        data-product-image="{{ asset($tank->image_url) }}">
                    Añadir al carrito
                </button>
            </div>
        </div>
        
    </div>

    <div class="flex flex-col md:flex-row gap-4 mt-8">
        <div class="w-full md:w-[50%] p-6 card-bg rounded-lg shadow-lg">
            <h2 class="text-xl md:text-2xl font-bold card-h1 mb-4">Servicios Incluidos</h2>
            <ul class="space-y-2">
                <li class="text-base md:text-lg card-h1">Todo incluido excepto gastos de desmilitarización y transporte especial</li>
                <li class="text-base md:text-lg card-h1">Inspección técnica de 150 componentes blindados</li>
                <li class="text-base md:text-lg card-h1">Prueba de campo de 3 días o 50 km operativos</li>
                <li class="text-base md:text-lg card-h1">Garantía de 1 año en sistemas de armamento y 2 años en motor</li>
                <li class="text-base md:text-lg card-h1">Transporte blindado a tu base o ubicación designada</li>
                <li class="text-base md:text-lg card-h1">Horas de motor y kilómetros certificados por registro militar</li>
                <li class="text-base md:text-lg card-h1">Estructura blindada libre de impactos de combate</li>
                <li class="text-base md:text-lg card-h1">Certificado de desactivación de armamento (opcional)</li>
                <li class="text-base md:text-lg card-h1">Manual de operación y mantenimiento traducido</li>
            </ul>
        </div>
    
        <div class="w-full md:w-[50%] p-6 card-bg rounded-lg shadow-lg">
            <h2 class="text-xl md:text-2xl font-bold card-h1 mb-4">Información adicional</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Blindaje:</span> {{ $tank->armor_type }}</p>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Autonomía:</span> {{ $tank->range_km }} km</p>
                </div>
                <div>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">Año de fabricación:</span> {{ $tank->manufacture_year }}</p>
                    <p class="text-base md:text-lg card-h1"><span class="font-semibold">País:</span> {{ $tank->country }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 p-6 card-bg rounded-lg shadow-lg">
        <h2 class="text-xl md:text-2xl font-bold card-h1 mb-4">Opiniones de Clientes</h2>

        <div id="reviews-container" class="space-y-4">
            @forelse($ratings as $rating)
            <div class="border-b pb-4">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-base md:text-lg card-h1 font-semibold">{{ $rating->user->name }}</p>
                    <span class="text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $rating->rating) ★ @else ☆ @endif
                        @endfor
                    </span>
                </div>
                <p class="text-base md:text-lg card-h1 mb-1">{{ $rating->review_text }}</p>
                <p class="text-xs text-[var(--tercero-oscuro)]">{{ $rating->created_at->format('d/m/Y H:i') }}</p>
            </div>
            @empty
            <div class="text-center py-4">
                <p class="text-[var(--tercero-oscuro)]">No hay opiniones todavía.</p>
            </div>
            @endforelse
        </div>

        @auth
        <div class="mt-6 pt-4 border-t">
            <h3 class="text-lg font-semibold card-h1 mb-3">Añadir tu opinión</h3>
            <form id="review-form" action="{{ route('tanks.ratings.store', $tank->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium card-h1 mb-1">Valoración</label>
                    <select id="rating" name="rating" class="w-full p-2 rounded border border-[var(--tercero-oscuro)] bg-[var(--primero)] text-[var(--tercero)]" required>
                        <option value="">Selecciona una valoración</option>
                        <option value="5">★★★★★ Excelente</option>
                        <option value="4">★★★★☆ Muy Bueno</option>
                        <option value="3">★★★☆☆ Bueno</option>
                        <option value="2">★★☆☆☆ Regular</option>
                        <option value="1">★☆☆☆☆ Malo</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="review_text" class="block text-sm font-medium card-h1 mb-1">Comentario</label>
                    <textarea id="review_text" name="review_text" rows="3" class="w-full p-2 rounded border border-[var(--tercero-oscuro)] bg-[var(--primero)] text-[var(--tercero)]" required></textarea>
                </div>
                <button type="submit" class="btn-add-to-cart bg-[var(--cuarto)] p-2 px-4 text-[var(--sexto)] font-bold rounded-lg hover:bg-[var(--quinto)] transition-all duration-100">
                    Enviar Opinión
                </button>
            </form>
        </div>
        @else
        <div class="mt-4 pt-4 border-t text-center">
            <p class="text-[var(--tercero-oscuro)]">
                <a href="{{ route('login') }}" class="text-[var(--cuarto)] hover:underline">Inicia sesión</a> para dejar tu opinión.
            </p>
        </div>
        @endauth
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const reviewForm = document.getElementById('review-form');

    reviewForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = reviewForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;

        try {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Enviando...';
                
            const formData = new FormData(reviewForm);
            const response = await fetch(reviewForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
                
            const data = await response.json();
                
            //console.log(response.ok);
                
            document.getElementById('reviews-container').innerHTML = data.html;
            reviewForm.reset();
        } catch (error) {
            console.log(error);
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });
});
</script>

@vite(['resources/js/cart.js'])

@endsection
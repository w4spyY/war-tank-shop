<div class="m-3">
    <div class="p-5 bg-[var(--primero)] mb-3 rounded-xl text-center border border-[var(--tercero)]">
        <h2 class="text-3xl font-bold card-h1">Tanques en Oferta</h2>
    </div>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($tanks as $tank)
            <div class="box p-5 card-bg rounded-lg">
                <div class="relative overflow-hidden rounded-lg">
                    <img class="w-full h-48 object-cover" src="{{ asset($tank->image_url) }}" alt="{{ $tank->name }}">
                    <img 
                        src="{{ asset('oferta/oferta.png') }}" 
                        alt="Oferta" 
                        class="absolute -top-2 -left-6 w-28" 
                    />
                </div>
                <div class="text-center card-h1 text-2xl font-bold mt-1">
                    <p>{{ $tank->name }}</p>
                </div>
                <div class="flex justify-between mt-2 p-2 card-desc rounded-lg">
                    <p class="text-lg ms-5 content-center">Solo por <span class="font-bold">{{ number_format($tank->price, 2, ',', '.') }}</span> <span class="font-bold">€</span></p>
                    <a class="text-lg font-bold me-5 card-btn p-2 rounded-lg transition-all duration-100 hover:scale-110 border border-[var(--primero)]" href="{{ route('tank.details', $tank->id) }}">VER DETALLES</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="m-3 mt-24">
    <div class="p-5 bg-[var(--primero)] mb-3 rounded-xl text-center border border-[var(--tercero)]">
        <h2 class="text-3xl font-bold card-h1">Tanques Más Vendidos</h2>
    </div>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($tanks as $tank)
            <div class="box p-5 card-bg rounded-lg">
                <div class="overflow-hidden rounded-lg">
                    <img class="w-full h-48 object-cover" src="{{ asset($tank->image_url) }}" alt="{{ $tank->name }}">
                </div>
                <div class="text-center card-h1 text-2xl font-bold mt-1">
                    <p>{{ $tank->name }}</p>
                </div>
                <div class="flex justify-between mt-2 p-2 card-desc rounded-lg">
                    <p class="text-lg ms-5 content-center">Solo por <span class="font-bold">{{ number_format($tank->price, 2, ',', '.') }}</span> <span class="font-bold">€</span></p>
                    <a class="text-lg font-bold me-5 card-btn p-2 rounded-lg transition-all duration-100 hover:scale-110 border border-[var(--primero)]" href="{{ route('tank.details', $tank->id) }}">VER DETALLES</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="m-3 mt-24">
    <div class="p-5 bg-[var(--primero)] mb-3 rounded-xl text-center border border-[var(--tercero)]">
        <h2 class="text-3xl font-bold card-h1">Tanques Nuevos</h2>
    </div>
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($tanks as $tank)
            <div class="box p-5 card-bg rounded-lg">
                <div class="overflow-hidden rounded-lg">
                    <img class="w-full h-48 object-cover" src="{{ asset($tank->image_url) }}" alt="{{ $tank->name }}">
                </div>
                <div class="text-center card-h1 text-2xl font-bold mt-1">
                    <p>{{ $tank->name }}</p>
                </div>
                <div class="flex justify-between mt-2 p-2 card-desc rounded-lg">
                    <p class="text-lg ms-5 content-center">Solo por <span class="font-bold">{{ number_format($tank->price, 2, ',', '.') }}</span> <span class="font-bold">€</span></p>
                    <a class="text-lg font-bold me-5 card-btn p-2 rounded-lg transition-all duration-100 hover:scale-110 border border-[var(--primero)]" href="{{ route('tank.details', $tank->id) }}">VER DETALLES</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
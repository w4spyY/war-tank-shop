<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8 text-tercero">Carrito de Compras</h1>

    <!-- Contenedor del carrito -->
    <div class="cart-container">
        <!-- Producto 1 -->
        <div class="cart-item">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img 
                        src="{{ asset('storage/tank1.jpg') }}" 
                        alt="Producto 1" 
                        class="w-20 h-20 object-cover rounded-lg tank-details-img"
                    >
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-primero">Sherman M4</h2>
                        <p class="text-tercero">Cantidad: 1</p>
                        <p class="text-tercero">Precio: 200.000,00 €</p>
                    </div>
                </div>
                <button class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Producto 2 -->
        <div class="cart-item">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img 
                        src="{{ asset('storage/tank2.jpg') }}" 
                        alt="Producto 2" 
                        class="w-20 h-20 object-cover rounded-lg tank-details-img"
                    >
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-primero">Tiger I</h2>
                        <p class="text-tercero">Cantidad: 2</p>
                        <p class="text-tercero">Precio: 500.000,00 €</p>
                    </div>
                </div>
                <button class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Producto 3 -->
        <div class="cart-item">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img 
                        src="{{ asset('storage/tank3.jpg') }}" 
                        alt="Producto 3" 
                        class="w-20 h-20 object-cover rounded-lg tank-details-img"
                    >
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-primero">Panther</h2>
                        <p class="text-tercero">Cantidad: 1</p>
                        <p class="text-tercero">Precio: 220.000,00 €</p>
                    </div>
                </div>
                <button class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Resumen del carrito -->
        <div class="cart-summary mt-8">
            <h2 class="text-2xl font-bold mb-4">Resumen del Carrito</h2>
            <div class="flex justify-between mb-2">
                <p>Subtotal:</p>
                <p class="font-semibold">920.000,00 €</p>
            </div>
            <div class="flex justify-between mb-2">
                <p>Envío:</p>
                <p class="font-semibold">10.000,00 €</p>
            </div>
            <div class="flex justify-between mb-4">
                <p>IVA:</p>
                <p class="font-semibold">165.600,00 €</p>
            </div>
            <div class="flex justify-between mb-4 font-bold text-xl">
                <p>Total:</p>
                <p class="font-bold">1.085.600,00 €</p>
            </div>
            <button class="btn-primary mt-4 font-bold text-xl">
                Proceder al Pago
            </button>
        </div>
    </div>
</div>
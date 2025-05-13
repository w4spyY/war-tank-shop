document.addEventListener('DOMContentLoaded', function() {
    // Obtener el carrito de localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items-container');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const cartItemsList = document.getElementById('cart-items-list');
    const cartSubtotal = document.getElementById('cart-subtotal');
    const cartTax = document.getElementById('cart-tax');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');

    // Mostrar u ocultar elementos según si hay items
    if (cart.length > 0) {
        emptyCartMessage.classList.add('hidden');
        cartItemsContainer.classList.remove('hidden');
        renderCartItems(cart);
        updateCartSummary(cart);
    } else {
        emptyCartMessage.classList.remove('hidden');
        cartItemsContainer.classList.add('hidden');
    }

    // Función para renderizar los items del carrito
    function renderCartItems(cartItems) {
        cartItemsList.innerHTML = '';
        
        cartItems.forEach((item, index) => {
            const itemElement = document.createElement('div');
            itemElement.className = 'bg-white p-4 rounded-lg shadow-md flex flex-col md:flex-row gap-4';
            itemElement.innerHTML = `
                <div class="w-full md:w-1/4">
                    <img src="${item.image}" alt="${item.name}" class="w-full h-48 object-cover rounded-lg">
                </div>
                <div class="w-full md:w-2/4 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-semibold">${item.name}</h3>
                        <p class="text-gray-600">${item.type === 'tank' ? 'Tanque' : 'Repuesto'}</p>
                    </div>
                    <div class="flex items-center mt-4">
                        <button class="quantity-btn px-3 py-1 border rounded-l" data-index="${index}" data-action="decrease">-</button>
                        <span class="px-4 py-1 border-t border-b">${item.quantity}</span>
                        <button class="quantity-btn px-3 py-1 border rounded-r" data-index="${index}" data-action="increase">+</button>
                        <button class="ml-4 text-red-500 remove-item-btn" data-index="${index}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-full md:w-1/4 flex flex-col items-end justify-between">
                    <div class="text-right">
                        <p class="text-lg font-semibold">€${(item.price * item.quantity).toFixed(2)}</p>
                        <p class="text-gray-600">€${item.price.toFixed(2)} c/u</p>
                    </div>
                </div>
            `;
            cartItemsList.appendChild(itemElement);
        });

        // Añadir eventos a los botones de cantidad y eliminar
        document.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', updateQuantity);
        });

        document.querySelectorAll('.remove-item-btn').forEach(btn => {
            btn.addEventListener('click', removeItem);
        });
    }

    // Función para actualizar la cantidad de un item
    function updateQuantity(e) {
        const index = e.target.getAttribute('data-index');
        const action = e.target.getAttribute('data-action');
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        if (action === 'increase') {
            cart[index].quantity += 1;
        } else if (action === 'decrease' && cart[index].quantity > 1) {
            cart[index].quantity -= 1;
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCartItems(cart);
        updateCartSummary(cart);
        updateCartCounter();
    }

    // Función para eliminar un item del carrito
    function removeItem(e) {
        const index = e.target.closest('.remove-item-btn').getAttribute('data-index');
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        
        if (cart.length === 0) {
            emptyCartMessage.classList.remove('hidden');
            cartItemsContainer.classList.add('hidden');
        } else {
            renderCartItems(cart);
            updateCartSummary(cart);
        }
        
        updateCartCounter();
    }

    // Función para actualizar el resumen del carrito
    function updateCartSummary(cartItems) {
        const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.21; // 21% IVA
        const total = subtotal + tax;
        
        cartSubtotal.textContent = `€${subtotal.toFixed(2)}`;
        cartTax.textContent = `€${tax.toFixed(2)}`;
        cartTotal.textContent = `€${total.toFixed(2)}`;
    }

    // Función para actualizar el contador del carrito (similar a la anterior)
    function updateCartCounter() {
        const cartCounter = document.getElementById('cart-counter');
        if (cartCounter) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            cartCounter.textContent = totalItems;
            cartCounter.style.display = totalItems > 0 ? 'flex' : 'none';
        }
    }

    // Evento para el botón de checkout
    checkoutBtn.addEventListener('click', async function() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        if (cart.length === 0) {
            alert('El carrito está vacío');
            return;
        }
    
        try {
            checkoutBtn.disabled = true;
            checkoutBtn.textContent = 'Procesando...';
            
            const response = await fetch(checkoutBtn.dataset.checkoutUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': checkoutBtn.dataset.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ cart }),
                credentials: 'include'
            });
    
            // Verificar si la respuesta es una redirección (no autenticado)
            if (response.redirected) {
                window.location.href = response.url;
                return;
            }
    
            const data = await response.json();
    
            if (!response.ok) {
                throw new Error(data.message || 'Error en el proceso de pago');
            }
    
            localStorage.removeItem('cart');
            updateCartCounter();
            window.location.href = `${checkoutBtn.dataset.confirmationUrl}?invoice=${data.invoice_id}`;
            
        } catch (error) {
            console.error('Error:', error);
            
            if (error.message.includes('Unauthenticated')) {
                window.location.href = checkoutBtn.dataset.loginUrl;
            } else {
                alert(error.message);
            }
            
            checkoutBtn.disabled = false;
            checkoutBtn.textContent = 'Proceder al Pago';
        }
    });
});
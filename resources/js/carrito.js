function getCart() {
    const cart = localStorage.getItem('cart');
    return cart ? JSON.parse(cart) : { items: [], total: 0 };
}

function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function updateCartTotal(cart) {
    cart.total = cart.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
}

function addToCart(product) {
    const cart = getCart();
    const existingItem = cart.items.find(item => item.id === product.id && item.type === product.type);

    if (existingItem) {
        existingItem.quantity++;
        existingItem.total = existingItem.price * existingItem.quantity;
    } else {
        cart.items.push({
            id: product.id,
            name: product.name,
            price: product.price,
            image: product.image,
            type: product.type, // 'tank' o 'part'
            quantity: 1,
            total: product.price
        });
    }

    updateCartTotal(cart);
    saveCart(cart);
    alert('Producto añadido al carrito!');
}

function removeFromCart(id, type) {
    const cart = getCart();
    cart.items = cart.items.filter(item => !(item.id === id && item.type === type));
    updateCartTotal(cart);
    saveCart(cart);
    renderCart();
}

function changeQuantity(id, type, newQuantity) {
    const cart = getCart();
    const item = cart.items.find(i => i.id === id && i.type === type);
    if (item) {
        item.quantity = Math.max(1, parseInt(newQuantity) || 1);
        item.total = item.quantity * item.price;
    }
    updateCartTotal(cart);
    saveCart(cart);
    renderCart();
}

function renderCart() {
    const cart = getCart();
    const container = document.querySelector('.cart-summary');
    container.innerHTML = '';

    if (cart.items.length === 0) {
        container.innerHTML = '<p class="text-center py-4">Tu carrito está vacío.</p>';
        return;
    }

    cart.items.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'mb-4 p-4 bg-white rounded shadow';

        itemDiv.innerHTML = `
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    ${item.image ? `<img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover mr-4">` : ''}
                    <div>
                        <h3 class="font-semibold text-lg">${item.name}</h3>
                        <p class="text-sm text-gray-600">€${item.price.toFixed(2)} x 
                        <input type="number" min="1" value="${item.quantity}" 
                               onchange="changeQuantity(${item.id}, '${item.type}', this.value)" 
                               class="w-16 p-1 border rounded text-center"> = 
                        <strong>€${(item.price * item.quantity).toFixed(2)}</strong></p>
                        <p class="text-xs text-gray-500">${item.type === 'tank' ? 'Tanque' : 'Pieza'}</p>
                    </div>
                </div>
                <button onclick="removeFromCart(${item.id}, '${item.type}')" 
                        class="text-red-500 hover:text-red-700 font-bold px-2 py-1 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        `;
        container.appendChild(itemDiv);
    });

    const totalDiv = document.createElement('div');
    totalDiv.className = 'text-right mt-6 font-bold text-xl border-t pt-4';
    totalDiv.innerHTML = `Total: €${cart.total.toFixed(2)}`;
    container.appendChild(totalDiv);
}

async function syncCartWithServer() {
    const cart = getCart();
    
    if (cart.items.length === 0) {
        return { success: false, message: 'Tu carrito está vacío.' };
    }

    try {
        const response = await fetch('/cart/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ cart_data: cart })
        });

        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const text = await response.text();
            throw new Error(`Respuesta inesperada: ${text.substring(0, 100)}...`);
        }

        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || `Error ${response.status}: ${response.statusText}`);
        }

        return data;
    } catch (error) {
        console.error('Error al sincronizar el carrito:', error);
        return { 
            success: false, 
            message: 'Error de conexión: ' + (error.message || 'Por favor intenta nuevamente')
        };
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // En la página de productos
    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const product = {
                id: parseInt(button.dataset.productId),
                name: button.dataset.productName,
                price: parseFloat(button.dataset.productPrice),
                image: button.dataset.productImage,
                type: button.dataset.productType === 'part' ? 'part' : 'tank' // Solo 'tank' o 'part'
            };
            addToCart(product);
            renderCart();
        });
    });

    // En la página del carrito
    if (window.location.pathname === '/cart' || window.location.pathname === '/cart/') {
        renderCart();

        const checkoutButton = document.querySelector('#checkout-button');
        if (checkoutButton) {
            checkoutButton.addEventListener('click', async () => {
                const cart = getCart();
                
                if (cart.items.length === 0) {
                    alert('Tu carrito está vacío.');
                    return;
                }
            
                checkoutButton.disabled = true;
                checkoutButton.innerHTML = `Procesando...`;
            
                try {
                    const syncResult = await syncCartWithServer();
                    
                    if (syncResult.success) {
                        window.location.href = '/checkout';
                    } else {
                        alert(syncResult.message || 'No se pudo completar la compra');
                        if (syncResult.message.includes('CSRF') || syncResult.message.includes('autenticación')) {
                            window.location.reload();
                        }
                    }
                } catch (error) {
                    console.error('Error inesperado:', error);
                    alert('Error crítico: ' + error.message);
                } finally {
                    checkoutButton.disabled = false;
                    checkoutButton.textContent = 'Finalizar compra';
                }
            });
        }
    }
});
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones de "Añadir al carrito"
    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
    
    // Añadir evento click a cada botón
    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

    // Función para añadir producto al carrito
    function addToCart(event) {
        const button = event.currentTarget;
        const product = {
            id: button.getAttribute('data-product-id'),
            type: button.getAttribute('data-product-type'),
            name: button.getAttribute('data-product-name'),
            price: parseFloat(button.getAttribute('data-product-price')),
            image: button.getAttribute('data-product-image'),
            quantity: 1
        };

        // Obtener el carrito actual de localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Verificar si el producto ya está en el carrito
        const existingItemIndex = cart.findIndex(item => 
            item.id === product.id && item.type === product.type
        );

        if (existingItemIndex !== -1) {
            // Si el producto ya existe, incrementar la cantidad
            cart[existingItemIndex].quantity += 1;
        } else {
            // Si no existe, añadir el nuevo producto
            cart.push(product);
        }

        // Guardar el carrito actualizado en localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Actualizar el contador del carrito (si existe)
        updateCartCounter();
    }

    // Función para actualizar el contador del carrito
    function updateCartCounter() {
        const cartCounter = document.getElementById('cart-counter');
        if (cartCounter) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            cartCounter.textContent = totalItems;
            cartCounter.style.display = totalItems > 0 ? 'flex' : 'none';
        }
    }

    // Inicializar el contador del carrito al cargar la página
    updateCartCounter();
});
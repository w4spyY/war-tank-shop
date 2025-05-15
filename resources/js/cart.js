document.addEventListener('DOMContentLoaded', function() {
    //botones añadir al carrito
    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
    
    //evento para todos
    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

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

        console.log(product.image);
        //console.log(product);

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        //ya existe?
        const existingItemIndex = cart.findIndex(item => 
            item.id === product.id && item.type === product.type
        );

        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += 1;
        } else {
            cart.push(product);
        }

        //guardar
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCounter();
    }

    function updateCartCounter() {
        const cartCounter = document.getElementById('cart-counter');
        if (cartCounter) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            cartCounter.textContent = totalItems;
            cartCounter.style.display = totalItems > 0 ? 'flex' : 'none';
        }
    }

    updateCartCounter();
});
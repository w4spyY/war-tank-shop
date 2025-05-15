document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('inquiry-form');
    const submitButton = form.querySelector('button[type="submit"]');
    const submitText = document.getElementById('submit-text');
    const spinner = document.getElementById('spinner');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        submitText.textContent = 'Enviando...';
        spinner.classList.remove('hidden');
        submitButton.disabled = true;

        const formData = {
            product_type: document.getElementById('product_type').value,
            product_code: document.getElementById('product_code').value,
            message: document.getElementById('message').value,
            _token: document.querySelector('input[name="_token"]').value
        };

        //no logueado
        const guestFields = document.getElementById('guest-fields');
        if (guestFields && !guestFields.classList.contains('hidden')) {
            formData.first_name = document.getElementById('first_name').value;
            formData.last_name = document.getElementById('last_name').value;
            formData.email = document.getElementById('email').value;
        }

        const startTime = Date.now();

        fetch('/product-inquiries', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': formData._token,
                'Accept': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            const elapsedTime = Date.now() - startTime;
            const remainingTime = Math.max(0, 1500 - elapsedTime);
            
            if (remainingTime > 0) {
                return new Promise(resolve => {
                    setTimeout(() => resolve(response), remainingTime);
                });
            }
            return response;
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log("pepepepepepe");
                form.reset();
            }
        })
        .catch(error => {
            console.log(error);
        })
        .finally(() => {
            submitText.textContent = 'Enviar Pregunta';
            spinner.classList.add('hidden');
            submitButton.disabled = false;
        });
    });
});
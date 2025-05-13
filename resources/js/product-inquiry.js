document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('inquiry-form');
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');
    const storeUrl = form.dataset.storeUrl;
    const submitText = document.getElementById('submit-text');
    const spinner = document.getElementById('spinner');
    const MIN_LOADING_TIME = 1500; // 1.5 segundos mínimo de spinner visible

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Reset messages
        successMessage.classList.add('hidden');
        errorMessage.classList.add('hidden');
        
        // Mostrar spinner y cambiar texto
        submitText.textContent = 'Enviando...';
        spinner.classList.remove('hidden');
        
        // Disable button
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        
        // Guardar el tiempo de inicio
        const startTime = Date.now();
        
        try {
            const formData = new FormData(form);
            
            const response = await fetch(storeUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            });
            
            const elapsedTime = Date.now() - startTime;
            const remainingTime = Math.max(0, MIN_LOADING_TIME - elapsedTime);
            
            if (remainingTime > 0) {
                await new Promise(resolve => setTimeout(resolve, remainingTime));
            }
            
            const data = await response.json();
            
            if (response.ok) {
                successMessage.textContent = data.message;
                successMessage.classList.remove('hidden');
                
                form.reset();
            } else {
                console.log("error");
            }
        } catch (error) {
            console.log("error");
        } finally {
            submitText.textContent = 'Enviar Pregunta';
            spinner.classList.add('hidden');
            submitButton.disabled = false;
        }
    });
});
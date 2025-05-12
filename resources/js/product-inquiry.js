document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('inquiry-form');
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');
    const storeUrl = form.dataset.storeUrl;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Reset messages
        successMessage.classList.add('hidden');
        errorMessage.classList.add('hidden');
        
        // Disable button
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = 'Enviando...';
        
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
            
            const data = await response.json();
            
            if (response.ok) {
                // Show success message
                successMessage.textContent = data.message;
                successMessage.classList.remove('hidden');
                
                // Reset form
                form.reset();
            } else {
                throw new Error(data.message || 'Error al enviar la pregunta');
            }
        } catch (error) {
            console.error('Error:', error);
            errorMessage.textContent = error.message;
            errorMessage.classList.remove('hidden');
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = 'Enviar Pregunta';
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    let nombreInput = document.getElementById("name");

    nombreInput.addEventListener("input", function () {
        let nombre = nombreInput.value;
        let nombreUpper = nombre.charAt(0).toUpperCase() + nombre.slice(1); //nombre se guarda en mayus

        const regexNombre = /^[a-zA-Z\s]*$/; //que no tenga numeros y caracteres especiales

        if (!regexNombre.test(nombreUpper)) {
            nombreInput.classList.add("border-danger");
        } else {
            nombreInput.classList.remove("border-danger");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let apellidoInput = document.getElementById("lastname");

    apellidoInput.addEventListener("input", function () {
        let apellido = apellidoInput.value;
        let apellidoUpper =
            apellido.charAt(0).toUpperCase() + apellido.slice(1); //nombre se guarda en mayus

        const regexNombre = /^[a-zA-Z\s]*$/; //que no tenga numeros y caracteres especiales

        if (!regexNombre.test(apellidoUpper)) {
            apellidoInput.classList.add("border-danger");
        } else {
            apellidoInput.classList.remove("border-danger");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let nacimientoInput = document.getElementById("nacimiento");

    nacimientoInput.addEventListener("input", function () {
        let nacimiento = new Date(nacimientoInput.value);
        let hoy = new Date();
        let ano = hoy.getFullYear() - nacimiento.getFullYear();
        let mesDiferencia = hoy.getMonth() - nacimiento.getMonth();

        if (
            mesDiferencia < 0 ||
            (mesDiferencia === 0 && hoy.getDate() < nacimiento.getDate())
        ) {
            ano--;
        }

        if (ano < 18 || ano > 100) {
            nacimientoInput.classList.add("border-danger");
        } else {
            nacimientoInput.classList.remove("border-danger");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const telefonoInput = document.getElementById("telefono");

    telefonoInput.addEventListener("input", function () {
        const telefonoValue = telefonoInput.value.trim();

        //validos
        // +34 123 456 789
        // +1 800 555 5555
        // +52 55 1234 5678
        // +44 20 7946 0958
        const phonePattern = /^\+\d{1,4} \d{1,4} \d{3,} \d{3,}$/;

        if (!phonePattern.test(telefonoValue)) {
            telefonoInput.classList.add("border-danger");
        } else {
            telefonoInput.classList.remove("border-danger");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const direccionInput = document.getElementById("direccion");
    const facturacionInput = document.getElementById("facturacion");

    const addressPattern = /^[A-Za-z0-9\sºª\-\.\,]+ \d+[A-Za-z]?$/;

    //validos
    // Calle Los Pepes 55
    // Avenida de la Constitución 123A
    // Calle Falsa 123B

    //no validos
    // Calle Los Pepes
    // 123
    // Calle Falsa

    function validateAddress(input) {
        const value = input.value.trim();

        if (!addressPattern.test(value)) {
            input.classList.add("border-danger");
        } else {
            input.classList.remove("border-danger");
        }
    }

    direccionInput.addEventListener("input", function () {
        validateAddress(direccionInput);
    });

    facturacionInput.addEventListener("input", function () {
        validateAddress(facturacionInput);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");

    //valido
    // usuario@example.com
    // usuario.nombre@example.com
    // usuario+alias@example.com

    //no valido
    // usuario@
    // usuario.example.com
    // usuario@.com

    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    function validateEmail(input) {
        const value = input.value.trim();

        if (!emailPattern.test(value)) {
            input.classList.add("border-danger");
        } else {
            input.classList.remove("border-danger");
        }
    }

    emailInput.addEventListener("input", function () {
        validateEmail(emailInput);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("password_confirmation");
    const passwordStrengthBar = document.getElementById("password-strength");
    const passwordStrengthText = document.getElementById(
        "password-strength-text"
    );
    const passwordMatchError = document.getElementById("password-match-error");

    function evaluatePasswordStrength(password) {
        let strength = 0;

        //longitud
        if (password.length >= 8) strength += 1;
        //mayusculas
        if (/[A-Z]/.test(password)) strength += 1;
        //minusculas
        if (/[a-z]/.test(password)) strength += 1;
        //numbers
        if (/[0-9]/.test(password)) strength += 1;
        //caracteres especiales
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;

        return strength;
    }

    function updatePasswordStrengthBar(password) {
        const strength = evaluatePasswordStrength(password);

        passwordStrengthBar.classList.remove(
            "weak",
            "moderate",
            "strong",
            "very-strong"
        );
        passwordStrengthText.textContent = "";

        if (strength <= 2) {
            passwordStrengthBar.classList.add("weak");
            passwordStrengthText.textContent = "Débil";
        } else if (strength === 3) {
            passwordStrengthBar.classList.add("moderate");
            passwordStrengthText.textContent = "Normal";
        } else if (strength === 4) {
            passwordStrengthBar.classList.add("strong");
            passwordStrengthText.textContent = "Fuerte";
        } else if (strength === 5) {
            passwordStrengthBar.classList.add("very-strong");
            passwordStrengthText.textContent = "Muy fuerte";
        }
    }

    function validatePasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password !== confirmPassword) {
            passwordMatchError.classList.remove("hidden");
        } else {
            passwordMatchError.classList.add("hidden");
        }
    }

    passwordInput.addEventListener("input", function () {
        updatePasswordStrengthBar(passwordInput.value);
    });

    confirmPasswordInput.addEventListener("input", validatePasswordMatch);
});

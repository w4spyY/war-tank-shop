<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/forms.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <div class="form-back">
        <div class="flex container bg-form-color mx-auto w-[30%] p-5 rounded-xl">
            <div class="mx-auto">
                <div class="text-center bg-form-main-text mb-7 text-xl font-bold">
                    <h1>Registrarse</h1>
                </div>

                <form action="{{ route('register') }}" class="" method="POST">
                    @csrf

                    <div class="grid grid-cols-2">
                        <div class="me-5 ms-5 form-text-color mb-4">
                            <label for="name">Nombre</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="text" placeholder="Escribe tu nombre" id="name" name="name">
                        </div>

                        <!--esto-->
                        <div class="me-5 ms-5 form-text-color mb-4">
                            <label for="lastname">Apellido</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="text" placeholder="Escribe tu apellido" id="lastname" name="lastname">
                        </div>

                        <!--esto-->
                        <div class="me-5 ms-5 form-text-color mb-4">
                            <label for="nacimiento">Fecha de nacimiento</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="date" id="nacimiento" name="nacimiento" />
                        </div>

                        <div class="me-5 ms-5 form-text-color mb-4">
                            <label for="email">Correo Electrónico</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="email" id="email" name="email" placeholder="Escribe tu correo">
                        </div>

                        <div class="me-5 ms-5 form-text-color">
                            <label for="password">Contraseña</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="password" id="password" name="password" placeholder="Crea una contraseña" minlength="8" autocomplete>
                            
                            <!-- barra password -->
                            <div id="password-strength-bar" class="h-2 mt-2 bg-gray-200 rounded-md">
                                <div id="password-strength" class="h-full rounded-md"></div>
                            </div>
                            <p id="password-strength-text" class="text-sm mt-1"></p>
                        </div>

                        <div class="me-5 ms-5 form-text-color">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" minlength="8" autocomplete>
                            <p id="password-match-error" class="text-sm text-red-500 hidden">Las contraseñas no coinciden.</p>
                        </div>

                    </div>
        
                    <div class="grid grid-cols-2 mt-12 mb-4">

                        <!--esto-->
                        <div class="me-5 ms-5 form-text-color">
                            <label for="direccion">Dirección envio</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="text" id="direccion" name="direccion" placeholder="Calle Los Pepes 55">
                        </div>

                        <!--esto-->
                        <div class="me-5 ms-5 form-text-color mb-4">
                            <label for="facturacion">Dirección facturación</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="text" id="facturacion" name="facturacion" placeholder="Calle Los Pepes 55">
                        </div>

                        <!--esto-->
                        <div class="me-5 ms-5 form-text-color">
                            <label for="telefono">Teléfono</label>
                            <input class="block w-full bg-form-input p-2 rounded-md" type="text" id="telefono" name="telefono" placeholder="+34 999 99 99 99">
                        </div>

                    </div>
        
                    <div class="color-check">

                        <div class="me-5 ms-5 mt-7 form-text-color">
                            <input type="checkbox" id="terms" name="terms" required />
                            <label for="terms">Acepto los <a href="#">términos y condiciones</a>.</label>
                        </div>

                        <div class="me-5 ms-5 form-text-color">
                            <input type="checkbox" id="cookies" name="cookies" required />
                            <label for="cookies">Acepto la <a href="#">política de cookies</a>.</label>
                        </div>

                    </div>

                    <div class="text-center mt-7">
                        <button class="button-color font-bold py-2 px-4 rounded w-[50%]" type="submit">Registrarse</button>
                    </div>

                    <div class="text-center mt-3 form-text-color color-check">
                        <p>¿Ya tienes cuenta? <a href="#">Inicia sesión</a></p>
                    </div>

                </form>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

@vite(['resources/js/form-register.js'])

</html>
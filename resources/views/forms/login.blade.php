<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Tankshop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/icon.png') }}" type="image/x-icon">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h1>Iniciar Sesión</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Escribe tu correo electrónico" required autofocus autocomplete="username">

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Escribe tu contraseña" required autocomplete="current-password">

                <div class="checkbox">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                        Recordarme
                    </label>
                </div>

                <button type="submit">Iniciar Sesión</button>

                <div class="login">
                    <p>¿No tienes cuenta? <a href="{{route('register')}}">Regístrate</a></p>
                    <p><a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

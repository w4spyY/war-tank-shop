<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TANKSHOP</title>
  <link rel="icon" href="{{ asset('storage/icon.png') }}" type="image/x-icon">
  @vite(['resources/css/main.css'])
</head>
<body>

  <!--navbar-->
  @include('layouts.navigation')

  <!--content-->
  <div>
    @yield('content')
  </div>

  @include('layouts.footer')

  <!--scripts-->
  <script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>

</body>
</html>
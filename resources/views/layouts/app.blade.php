<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TANKSHOP</title>
  <link rel="icon" href="{{ asset('storage/icon.png') }}" type="image/x-icon">
  @vite(['resources/css/main.css'])
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      display: flex;
      flex-direction: column;
    }
    .content {
      flex: 1 0 auto;
    }
    footer {
      flex-shrink: 0;
    }
  </style>
</head>
<body>

  <!--navbar-->
  @include('layouts.navigation')

  <!--content-->
  <div class="content">
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
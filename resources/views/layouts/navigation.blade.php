<nav class="header-bg-color border-b border-[var(--tercero)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('main.index') }}">
                    <img src="{{ asset('storage/icon2.png') }}" alt="logo" class="h-[70px]">
                </a>
            </div>
  
            <div class="hidden md:flex md:items-center md:space-x-4 lg:space-x-6">
                <a href="#" class="header-link p-2 lg:p-3 transition-all duration-300 rounded-lg font-semibold text-base lg:text-lg">Novedades</a>
                <a href="{{ route('main.index') }}" class="header-link p-2 lg:p-3 transition-all duration-300 rounded-lg font-semibold text-base lg:text-lg">Tanques</a>
                <a href="#" class="header-link p-2 lg:p-3 transition-all duration-300 rounded-lg font-semibold text-base lg:text-lg">Piezas</a>
                <a href="{{ route('product.inquiry.form') }}" class="header-link p-2 lg:p-3 transition-all duration-300 rounded-lg font-semibold text-base lg:text-lg">Pregunta</a>
                <a href="{{ route('about-us') }}" class="header-link p-2 lg:p-3 transition-all duration-300 rounded-lg font-semibold text-base lg:text-lg">Sobre nosotros</a>
            </div>
  
            <div class="flex items-center space-x-2 lg:space-x-4">
                <a href="#" class="header-link p-2 lg:p-3 rounded-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </a>
  
                @auth
                    <!--mi perfil-->
                    <a href="{{ route('profile.show') }}" class="header-link p-2 lg:p-3 rounded-lg transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>

                    <!--cerrar sesion-->
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    class="header-link p-2 lg:p-3 rounded-lg transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <!--login-->
                    <a href="{{ route('login') }}" class="header-link p-2 lg:p-3 rounded-lg transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                @endauth
  
                <a href="{{ route('cart.index') }}" class="header-link p-2 lg:p-3 rounded-lg transition-all duration-300 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </a>
                
                <button id="theme-toggle" class="header-link p-2 lg:p-3 rounded-lg transition-all duration-300">
                    <svg id="theme-icon-light" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg id="theme-icon-dark" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>
                
            </div>
  
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-button" class="header-link p-2 rounded-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
  
    <div id="mobile-menu" class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg">Novedades</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg">Tanques</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg">Piezas</a>
            <a href="{{ route('product.inquiry.form') }}" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg">Pregunta</a>
            <a href="#" class="block header-link p-3 rounded-lg transition-all duration-300 font-medium text-lg">Sobre nosotros</a>
        </div>
    </div>
</nav>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Universidad Sistema Escolar')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}?v={{ time() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <nav>
        <div class="container">
            <a href="/" class="logo">
                <img src="{{ asset('images/lion_logo.png') }}" alt="Leon Logo" class="logo-img">
                <span>Universidad Leon</span>
            </a>
            <ul class="nav-links">
                <li><a href="#about">Facultades</a></li>
                <li><a href="#about">Admisiones</a></li>
                <li><a href="#about">Instalaciones</a></li>
                <li><a href="#about">Nuestros atletas</a></li>
                <li><a href="#about">Contacto</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/dashboard') }}" class="btn-login">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
            <p>© 2026 Universidad Sistema Escolar. Inspirado en la excelencia.</p>
            <div style="margin-top: 20px; opacity: 0.6; font-size: 0.8rem;">
            Realizando la mejor labor para el futuro de la educación.
            </div>
        </div>
    </footer>

    @stack('scripts')
    @livewireScripts
</body>
</html>

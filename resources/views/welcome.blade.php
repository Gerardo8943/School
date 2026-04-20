<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Universidad Sistema Escolar</title>
    
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

    <div class="hero-scroll-container">
        <div class="video-wrapper" id="videoWrapper">
            <video autoplay loop muted playsinline class="hero-video" id="heroVideo">
                <source src="{{ asset('videos/hero-video.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-overlay" id="heroOverlay"></div>
            <div class="hero-content">
                <h1 id="heroText">Universidad Leon, un lugar de<br>crecimiento y aprendizaje</h1>
            </div>
        </div>
    </div>

    <section class="premium-quote-section">
        <div class="quote-wrapper">
            <p class="quote-text">"La universidad de Leon es la academia de aprendizaje ideal para tu formacion profesional, grandes mentes se reunen para impulsar su futuro, de la sociedad y del mundo. No te quedes atras"</p>
            <div class="quote-signature-wrapper">
                <p class="quote-signature">Universidad Leon</p>
            </div>
        </div>
    </section>

    <!-- SECCIÓN ESTILO EDITORIAL (Harvard Student Stories Inspired) -->
    <section class="stories-section" id="impact">
        <div class="container">
            <div class="stories-header">
                <h2>Creando juntos soluciones para el mundo.</h2>
                <p>El futuro no es lo que imaginas, es lo que puedes crear el día de hoy para el mañana.</p>
            </div>

            <div class="stories-grid">
                <!-- Tarjeta Principal (Featured) -->
                <article class="story-card story-card-large">
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1200&q=80" alt="Featured Story" class="story-img" loading="lazy">
                    <div class="story-overlay"></div>
                    <div class="story-content-large">
                        <span class="story-category">Student Life</span>
                        <h3 class="story-title-large">First Semester at Universidad Leon: 3 Things I Learned</h3>
                        <a href="#" class="story-btn">Read Full Story</a>
                    </div>
                </article>

                <!-- Fila de 3 Tarjetas Secundarias -->
                <article class="story-card story-card-small">
                    <div class="story-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&q=80" alt="Innovación" class="story-img" loading="lazy">
                    </div>
                    <div class="story-content-small">
                        <span class="story-category">Investigación</span>
                        <h3 class="story-title-small">Los nuevos laboratorios de Inteligencia Artificial</h3>
                        <p class="story-excerpt">Descubre cómo los estudiantes están utilizando tecnología de punta para resolver problemas globales.</p>
                        <a href="#" class="story-link">Leer más</a>
                    </div>
                </article>

                <article class="story-card story-card-small">
                    <div class="story-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&q=80" alt="Excelencia Global" class="story-img" loading="lazy">
                    </div>
                    <div class="story-content-small">
                        <span class="story-category">Comunidad</span>
                        <h3 class="story-title-small">Programas de inmersión y conexión internacional</h3>
                        <p class="story-excerpt">Expandiendo las fronteras de nuestros alumnos para liderar en cualquier país del mundo.</p>
                        <a href="#" class="story-link">Leer más</a>
                    </div>
                </article>

                <article class="story-card story-card-small">
                    <div class="story-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&q=80" alt="Impacto" class="story-img" loading="lazy">
                    </div>
                    <div class="story-content-small">
                        <span class="story-category">Bienestar</span>
                        <h3 class="story-title-small">El compromiso con el proyecto de servicio directo</h3>
                        <p class="story-excerpt">Proyectos sociales profundamente arraigados en el desarrollo y la inclusión comunitaria.</p>
                        <a href="#" class="story-link">Leer más</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- TAREA 2: Sección de Noticias (Livewire News Feed) -->
    @livewire('university-news')


    <section id="careers" style="background-color: var(--yale-light-gray);">
        <div class="container">
            <div class="section-title">
                <h2>Carreras Ofrecidas</h2>
            </div>
            <div class="grid">
                <div class="card">
                    <span style="color: var(--yale-blue); font-weight: 800; font-size: 0.8rem; text-transform: uppercase;">Facultad de Ingeniería</span>
                    <h3 style="margin-top: 10px;">Ciencia de Datos</h3>
                    <p>Analiza y transforma datos en decisiones estratégicas utilizando las últimas tecnologías de inteligencia artificial.</p>
                </div>
                <div class="card">
                    <span style="color: var(--yale-blue); font-weight: 800; font-size: 0.8rem; text-transform: uppercase;">Facultad de Ingeniería</span>
                    <h3 style="margin-top: 10px;">Ingeniería Informática</h3>
                    <p>Desarrolla sistemas complejos y arquitectura de software para resolver los retos del mañana.</p>
                </div>
                <div class="card">
                    <span style="color: var(--yale-blue); font-weight: 800; font-size: 0.8rem; text-transform: uppercase;">Facultad de Medicina</span>
                    <h3 style="margin-top: 10px;">Medicina Odontológica</h3>
                    <p>Formación clínica de excelencia con equipamiento de última generación y enfoque humano.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>© 2026 Universidad Sistema Escolar. Inspirado en la excelencia.</p>
            <div style="margin-top: 20px; opacity: 0.6; font-size: 0.8rem;">
            Realizando la mejor labor para el futuro de la educación.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.getElementById('heroVideo');
            const overlay = document.getElementById('heroOverlay');
            
            window.addEventListener('scroll', () => {
                let scrollY = window.scrollY;
                // Max scroll corresponds to the extra 50vh we added to container
                let maxScroll = window.innerHeight * 0.5; 
                let progress = Math.min(scrollY / maxScroll, 1);
                
                // Calculate scale (from 1 down to 0.85)
                let scale = 1 - (progress * 0.15);
                // Calculate overlay opacity and blur
                let blur = progress * 8; // blur up to 8px
                let opacityDarken = 0.5 + (progress * 0.2);

                // Apply transforms if video exists
                if (video) {
                    video.style.transform = `translate(-50%, -50%) scale(${scale})`;
                    video.style.filter = `blur(${blur}px)`;
                }
                if (overlay) {
                    overlay.style.backgroundColor = `rgba(0, 0, 0, ${opacityDarken})`;
                }
            });
        });
    </script>
    @livewireScripts
</body>
</html>

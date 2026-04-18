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
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>
    <nav>
        <div class="container">
            <a href="/" class="logo">
                <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="4" fill="#00356B"/>
                    <path d="M12 10V30H16V22H24V30H28V10H24V18H16V10H12Z" fill="white"/>
                </svg>
                <span>Universidad Leon</span>
            </a>
            <ul class="nav-links">
                <li><a href="#about">Quiénes Somos</a></li>
                <li><a href="#careers">Carreras</a></li>
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
                <source src="{{ asset('build/assets/videos/hero-video.mp4') }}" type="video/mp4">
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

    <section id="about">
        <div class="container">
            <div class="section-title">
                <h2>Quiénes Somos</h2>
            </div>
            <div class="grid">
                <div class="card">
                    <h3>Nuestra Misión</h3>
                    <p>Brindar una educación integral de vanguardia, fomentando el pensamiento crítico y la investigación para transformar nuestra sociedad.</p>
                </div>
                <div class="card">
                    <h3>Visión 2030</h3>
                    <p>Ser reconocidos como la institución líder en innovación educativa y desarrollo tecnológico en la región.</p>
                </div>
                <div class="card">
                    <h3>Valores</h3>
                    <p>Integridad, Responsabilidad, Excelencia y Compromiso con la comunidad son los pilares que sustentan nuestra institución.</p>
                </div>
            </div>
        </div>
    </section>

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
</body>
</html>

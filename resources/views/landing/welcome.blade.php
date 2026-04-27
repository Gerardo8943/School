@extends('layouts.landing')

@section('content')
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
                        <span class="story-category">Vida en el campus</span>
                        <h3 class="story-title-large">Primer semestre en la universiada Leon</h3>
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

    <section id="careers" class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <div class="section-title text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Carreras Ofrecidas</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <span class="text-blue-800 font-bold text-xs uppercase tracking-wider">Facultad de Ingeniería</span>
                    <h3 class="mt-3 text-xl font-semibold text-gray-900">Ciencia de Datos</h3>
                    <p class="mt-2 text-gray-600">Analiza y transforma datos en decisiones estratégicas utilizando las últimas tecnologías de inteligencia artificial.</p>
                </div>
                <div class="card bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <span class="text-blue-800 font-bold text-xs uppercase tracking-wider">Facultad de Ingeniería</span>
                    <h3 class="mt-3 text-xl font-semibold text-gray-900">Ingeniería Informática</h3>
                    <p class="mt-2 text-gray-600">Desarrolla sistemas complejos y arquitectura de software para resolver los retos del mañana.</p>
                </div>
                <div class="card bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <span class="text-blue-800 font-bold text-xs uppercase tracking-wider">Facultad de Medicina</span>
                    <h3 class="mt-3 text-xl font-semibold text-gray-900">Medicina Odontológica</h3>
                    <p class="mt-2 text-gray-600">Formación clínica de excelencia con equipamiento de última generación y enfoque humano.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.getElementById('heroVideo');
            const overlay = document.getElementById('heroOverlay');
            
            window.addEventListener('scroll', () => {
                let scrollY = window.scrollY;
                let maxScroll = window.innerHeight * 0.5; 
                let progress = Math.min(scrollY / maxScroll, 1);
                
                let scale = 1 - (progress * 0.15);
                let blur = progress * 8; 
                let opacityDarken = 0.5 + (progress * 0.2);

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
@endpush

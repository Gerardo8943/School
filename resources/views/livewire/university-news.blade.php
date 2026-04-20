<section class="news-section">
    <div class="container">
        <div class="news-header">
            <div>
                <h2>Noticias Universidad Leon</h2>
                <p>Novedades y descubrimientos</p>
            </div>
            <a href="#" class="news-header-link">Todas las noticias &rarr;</a>
        </div>

        <div class="news-container">
            <!-- Loading Overlay -->
            <div wire:loading.flex class="news-loading-overlay">
                <svg class="news-spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            <!-- News Grid -->
            <div wire:loading.class="loading" class="news-grid">
                @forelse($newsItems as $news)
                    <article class="news-card">
                        <div class="news-card-image-wrapper">
                            <img src="{{ $news->image_url ?? 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&q=80' }}" alt="{{ $news->title }}" loading="lazy" class="news-card-image">
                        </div>
                        <div class="news-meta">
                            <span class="news-category">{{ $news->category }}</span>
                            <time class="news-date">{{ \Carbon\Carbon::parse($news->published_at)->format('M d, Y') }}</time>
                        </div>
                        <h3 class="news-title">{{ $news->title }}</h3>
                        <p class="news-excerpt">{{ $news->excerpt }}</p>
                    </article>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; color: #888; padding: 40px 0;">
                        No hay noticias disponibles en este momento.
                    </div>
                @endforelse
            </div>
            
            <div class="news-pagination">
                {{ $newsItems->links() }}
            </div>
        </div>
    </div>
</section>

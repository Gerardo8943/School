@props(['image', 'title', 'subtitle', 'linkText' => 'Más información', 'linkUrl' => '#'])

<div class="honor-card">
    <div class="honor-card-image-wrapper">
        <img src="{{ $image }}" alt="{{ $title }}" loading="lazy" class="honor-card-image">
        <div class="honor-card-overlay"></div>
    </div>
    <div class="honor-card-content">
        <h3 class="honor-card-title">{{ $title }}</h3>
        <p class="honor-card-subtitle">{{ $subtitle }}</p>
        <a href="{{ $linkUrl }}" class="honor-card-link">
            {{ $linkText }}
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</div>

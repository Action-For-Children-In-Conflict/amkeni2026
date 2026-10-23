<div class="mt-10 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">More images</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">A photo slider with captions for related images.</p>
        </div>
    </div>

    @if ($galleryImages->isEmpty())
        <p class="text-sm text-gray-500 dark:text-gray-400">No extra images added yet.</p>
    @else
        <div id="detailGalleryCarousel" class="carousel slide detail-gallery-carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($galleryImages as $index => $galleryImage)
                    <div class="carousel-item @if ($index === 0) active @endif">
                        <div class="detail-gallery-slide">
                            <img src="{{ asset('storage/' . $galleryImage->image_url) }}"
                                alt="{{ $galleryImage->caption ?: $pageTitle }}" loading="lazy">
                            @if ($galleryImage->caption)
                                <div class="detail-gallery-caption">
                                    <p class="mb-0">{{ $galleryImage->caption }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($galleryImages->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#detailGalleryCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#detailGalleryCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators detail-gallery-indicators">
                    @foreach ($galleryImages as $index => $galleryImage)
                        <button type="button" data-bs-target="#detailGalleryCarousel" data-bs-slide-to="{{ $index }}"
                            class="@if ($index === 0) active @endif"
                            aria-label="Gallery image {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>

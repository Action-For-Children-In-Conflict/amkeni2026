<!-- ================= PARTNERS SLIDER ================= -->
<section class="section-pad partners-section" id="partners">
    <div class="container container-narrow">
        <div class="section-head text-center mx-auto">
            <span class="section-eyebrow">Our Partners & Allies</span>
            <h2>Standing together for children and families</h2>
            <hr class="rule mx-auto">
            <p class="mx-auto">We collaborate with dedicated local and international partners to expand our reach and multiply community impact.</p>
        </div>
    </div>

    @php
        // Prepare partner list from database, or sample items if empty
        $partnerItems = collect();

        if (isset($partners) && $partners->isNotEmpty()) {
            $partnerItems = $partners;
        } else {
            // Curated fallback partner list so UI is always rich and interactive
            $partnerItems = collect([
                (object)[
                    'name' => 'Del Monte Kenya',
                    'role' => 'Corporate Partner',
                    'image_url' => null,
                    'website_url' => 'https://www.delmontefoods.com/',
                ],
                (object)[
                    'name' => 'Football Kenya Federation',
                    'role' => 'Community Partner',
                    'image_url' => null,
                    'website_url' => 'https://www.footballkenya.org/',
                ],
                (object)[
                    'name' => 'Thika Cloth Mills',
                    'role' => 'Local Industry Partner',
                    'image_url' => null,
                    'website_url' => 'https://www.thikaclothmills.com/',
                ],
                (object)[
                    'name' => 'Believe FC',
                    'role' => 'Youth Sports Partner',
                    'image_url' => null,
                    'website_url' => 'https://www.instagram.com/believe_football.fc/',
                ],
                (object)[
                    'name' => 'Lapwing United FC',
                    'role' => 'Grassroots Partner',
                    'image_url' => null,
                    'website_url' => 'https://actionchildren.or.ke',
                ],
                (object)[
                    'name' => 'Steam Energy',
                    'role' => 'Event Sponsor',
                    'image_url' => null,
                    'website_url' => 'https://www.steamenergydrink.com/',
                ],
            ]);
        }

        // Duplicate items if needed so the marquee loop scrolls seamlessly
        $loopCount = $partnerItems->count() < 8 ? 3 : 2;
    @endphp

    <div class="partners-marquee-wrapper" id="partnersMarqueeWrapper">
        <div class="partners-viewport" id="partnersViewport">
            <div class="partners-track" id="partnersTrack">
                @for ($i = 0; $i < $loopCount; $i++)
                    @foreach ($partnerItems as $partner)
                        <a href="{{ $partner->website_url ?? '#' }}"
                           class="partner-card-link"
                           @if(!empty($partner->website_url) && $partner->website_url !== '#') target="_blank" rel="noopener noreferrer" @endif>
                            <div class="partner-card">
                                <div class="partner-logo-box">
                                    @if (!empty($partner->image_url))
                                        <img src="{{ Str::startsWith($partner->image_url, ['http://', 'https://']) ? $partner->image_url : asset('storage/' . $partner->image_url) }}"
                                             alt="{{ $partner->name }} logo"
                                             loading="lazy">
                                    @else
                                        <div class="partner-placeholder-icon">
                                            <span>{{ strtoupper(substr($partner->name, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="partner-info">
                                    <div class="partner-name">{{ $partner->name }}</div>
                                    @if (!empty($partner->role))
                                        <span class="partner-role">{{ $partner->role }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endfor
            </div>
        </div>
    </div>

    <div class="container container-narrow">
        <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
            <button type="button" class="partner-slider-control" id="partnerPrevBtn" aria-label="Previous partners">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
            </button>
            <span class="partner-slider-indicator">Hover or drag to explore</span>
            <button type="button" class="partner-slider-control" id="partnerNextBtn" aria-label="Next partners">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<script>
    (function () {
        var viewport = document.getElementById('partnersViewport');
        var track = document.getElementById('partnersTrack');
        var prevBtn = document.getElementById('partnerPrevBtn');
        var nextBtn = document.getElementById('partnerNextBtn');

        if (!viewport || !track) return;

        var scrollAmount = 260; // Card width + gap

        function pauseAnimation() {
            track.classList.add('paused');
        }

        function resumeAnimation() {
            track.classList.remove('paused');
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                pauseAnimation();
                viewport.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                pauseAnimation();
                viewport.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            });
        }

        // Drag to scroll handling
        var isDown = false;
        var startX;
        var scrollLeft;

        viewport.addEventListener('mousedown', function (e) {
            isDown = true;
            pauseAnimation();
            startX = e.pageX - viewport.offsetLeft;
            scrollLeft = viewport.scrollLeft;
        });

        viewport.addEventListener('mouseleave', function () {
            isDown = false;
        });

        viewport.addEventListener('mouseup', function () {
            isDown = false;
        });

        viewport.addEventListener('mousemove', function (e) {
            if (!isDown) return;
            e.preventDefault();
            var x = e.pageX - viewport.offsetLeft;
            var walk = (x - startX) * 1.5;
            viewport.scrollLeft = scrollLeft - walk;
        });
    })();
</script>

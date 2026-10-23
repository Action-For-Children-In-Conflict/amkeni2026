@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= ARTICLE ================= -->
    <div class="article-wrap">
        <div class="container container-narrow">
            <div class="row g-5">

                <!-- main column -->
                <div class="col-lg-8">
                    <img src="{{ $event->image_url ? asset('storage/' . $event->image_url) : asset('frontend/images/slider/up.jpg') }}"
                        alt="{{ $event->title }}" class="article-cover">

                    <h1 class="article-title">{{ $event->title }}</h1>
                    <div class="article-meta">
                        @if ($event->date)
                            <span>{{ $event->date }}</span>
                        @endif
                        @if ($event->time)
                            <span> &middot; {{ $event->time }}</span>
                        @endif
                        @if ($event->location)
                            <span> &middot; {{ $event->location }}</span>
                        @endif
                        @if ($event->tag)
                            <span> &middot; {{ $event->tag->title ?? $event->tag->name }}</span>
                        @endif
                    </div>

                    <div class="detail-body">
                        <style>
                            p>img {
                                width: 100%;
                                height: auto;
                                margin: 0 auto;
                            }
                        </style>
                        {!! $event->content !!}

                        @include('frontend.inc.detailGallery', ['galleryImages' => $galleryImages ?? collect()])

                        <div class="donate-line">
                            Donate $20 today at <a href="{{ route('donate') }}">Donate Here</a> to help support our work with children and families.
                        </div>

                        <div class="article-byline">Action for Children in Conflict (AfCiC), Thika, Kenya</div>

                        <div class="share-row">
                            <span>Share:</span>
                            <a href="https://x.com/intent/tweet?url=" target="_blank" rel="noopener"
                                class="social-dot">X</a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank" rel="noopener"
                                class="social-dot">f</a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=" target="_blank" rel="noopener"
                                class="social-dot">in</a>
                        </div>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="col-lg-4">
                    <div class="detail-sidebar">
                        {{-- Recent Events --}}
                        <div class="sidebar-widget">
                            <h5>{{ $recentPostsTitle ?? 'Recent Events' }}</h5>
                            @forelse ($recentEvents ?? [] as $recentEvent)
                                <a href="{{ $recentEvent['url'] }}" class="recent-post">
                                    @if (! empty($recentEvent['image']))
                                        <img src="{{ $recentEvent['image'] }}" alt="{{ $recentEvent['title'] }}" loading="lazy">
                                    @endif
                                    <div>
                                        <div class="rp-title">{{ $recentEvent['title'] }}</div>
                                        @if (! empty($recentEvent['meta']))
                                            <span class="rp-date">{{ $recentEvent['meta'] }}</span>
                                        @endif
                                    </div>
                                </a>
                            @empty
                                <p class="small text-muted mb-0">No recent events yet.</p>
                            @endforelse
                        </div>
                        {{-- Our Partners --}}
                        @include('frontend.inc.partnersCard')
                        {{-- Quotes --}}
                        @include('frontend.inc.quote')
                        {{-- detailview cta --}}
                        @include('frontend.inc.detailCta')

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

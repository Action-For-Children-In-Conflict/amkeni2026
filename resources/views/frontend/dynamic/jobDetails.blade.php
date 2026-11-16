@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= JOB DETAIL ================= -->
    <div class="article-wrap">
        <div class="container container-narrow">
            <div class="row g-5">

                <!-- main column -->
                <div class="col-lg-8">
                    <img src="{{ asset('storage/' . $job->image_url) }}" alt="{{ $job->title }}"
                        class="article-cover">

                    <h1 class="article-title">{{ $job->title }}</h1>
                    <div class="article-meta">
                        Careers &middot; {{ $job->created_at?->format('d M Y') }}
                    </div>

                    <div class="detail-body">
                        <p class="lead">{{ $job->description }}</p>

                        {!! $job->content !!}

                        @if ($job->hasDocument())
                            <div class="donate-line">
                                Download the full job description:
                                <a href="{{ asset('storage/' . $job->document_path) }}" target="_blank" rel="noopener">
                                    Download document
                                </a>
                            </div>
                        @endif

                        <div class="donate-line">
                            Ready to apply? Send your application to
                            <a href="mailto:info@actionchildren.or.ke">info@actionchildren.or.ke</a>.
                        </div>

                        <div class="article-byline">Action for Children in Conflict (AfCiC), Thika, Kenya</div>

                        <div class="share-row">
                            <span>Share:</span>
                            <a href="https://x.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"
                                rel="noopener" class="social-dot">X</a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener" class="social-dot">f</a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener" class="social-dot">in</a>
                        </div>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="col-lg-4">
                    <div class="detail-sidebar">
                        {{-- Other openings --}}
                        @include('frontend.inc.recentPosts')
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

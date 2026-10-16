@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= ARTICLE ================= -->
    <div class="article-wrap">
        <div class="container container-narrow">
            <div class="row g-5">

                <!-- main column -->
                <div class="col-lg-8">
                    <img src="{{ asset('storage/' . $blog->image_url) }}" alt="{{ $blog->title }}" class="article-cover">

                    <h1 class="article-title">{{ $blog->title }}</h1>
                    <div class="article-meta"> &middot; Blog</div>

                    <div class="detail-body">
                        {!! $blog->content !!}  


                       
                        <div class="donate-line">
                            Donate $20 today at <a href="donate">Donate Here</a> to help fund our next programme.
                        </div>

                        <div class="article-byline">Story by the AfCiC Communications Team, Action for Children in Conflict
                            (AfCiC)</div>

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
                        {{-- Recent Posts --}}
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

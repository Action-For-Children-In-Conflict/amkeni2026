@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= ARTICLE ================= -->
    <div class="article-wrap">
        <div class="container container-narrow">
            <div class="row g-5">
                <!-- main column -->
                <div class="col-lg-8">
                    <img src="{{ asset($programdetail->image_url) }}" alt="{{ $programdetail->title }}" class="article-cover">

                    <h1 class="article-title">{{ $programdetail->title }}</h1>
                    {{-- <div class="article-meta">Focus area</div> --}}

                    <div class="detail-body">
                        {{--   <div class="quick-fact">
                            <span class="num">200+</span>
                            <span class="label">Children sponsored this term</span>
                        </div> --}}

                        <style>
                            p>img {
                                width: 100%;
                                height: auto;
                                margin: 0 auto;
                            }
                        </style>


                        <p>{!! $programdetail->content !!}</p>

                        {{--   <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1200&auto=format&fit=crop"
                            alt="Education empowerment programme activity" class="detail-image"> --}}

                        {{--  <h2>What we do</h2>
                        <ul class="detail-list">
                            <li>School fees, uniforms and learning materials for sponsored children</li>
                            <li>Remedial classes for children who have fallen behind their grade level</li>
                            <li>Mentorship pairing each sponsored child with a consistent adult</li>
                            <li>Vocational training pathways for teenagers who won't return to formal school</li>
                        </ul>

                        <h2>Our approach</h2>
                        <p>We sponsor individual children rather than schools, so support follows the child through
                            transitions — primary to secondary, or into vocational training — instead of stopping at a
                            single institution's gate.</p> --}}

                        <div class="donate-line">
                            Donate $20 today at <a href="index.html#donate">Donate Here</a> to help fund this programme.
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

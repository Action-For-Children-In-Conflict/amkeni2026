@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= ARTICLE ================= -->
    <div class="article-wrap">
        <div class="container container-narrow">
            <div class="row g-5">

                <!-- main column -->
                <!-- main column -->
                <div class="col-lg-8">
                    <img src="{{ asset('frontend/images/trc/majengo.jpeg') }}" alt="Temporary Rescue Center"
                        class="article-cover">

                    <h1 class="article-title">Working Children Center(OVPC)-Outreach Programme for Vulnerable Children</h1>
                    <div class="article-meta">Majengo, Thika</div>

                    <div class="detail-body">
                        <p>
                            The program has been encouraging street children to attend our Outreach Programme for Vulnerable
                            Children centre (OPVC) daily from morning untill late afternoon, to keep them away from the
                            streets whilst involving them in activities like life skills, art and sports.
                        </p>
                        <h2>What happens here</h2>

                        <ul class="detail-list">
                            <li>Conducting street walk. This in a bid to identify children to be placed or referred to the
                            temporary rescue center.</li>
                            <li>Street work which involves identification of cases of child abuse, taking older street
                            children to technical and vocational training.</li>
                            <li>Identifying new young street children.</li>
                            <li> Cleaning up activities at the center and surrounding community</li>
                            <li> Identifying and helping street children in need of medical care.</li>

                            <li>Feeding program which entails provision of food ie; porridge in the morning, food during
                            lunch time.</li>
                            <li> Women mobilization and empowerment through table banking.</li>
                            <li> Provision of sanitary towels and diapers to girls and mothers in the streets.</li>
                            <li> Teen mother programs where they are educated on different family planning methods.</li>
                            <li> Following up on older ,re-integrated children (beneficiaries of AfCiC).</li>
                            <li> Providing important services to the community by working together with various service
                            providers</li>
                        </ul>
                        <div class="pull-quote">&ldquo;This is often the first place a child has felt safe enough to
                            actually be a child again.&rdquo;
                            <div
                                style="font-family:'Inter', sans-serif; font-style:normal; font-size:.85rem; color:#5b6472; margin-top:.6rem;">
                                — Centre coordinator, Temporary Rescue Center
                            </div>
                        </div>
                        <div class="donate-line">
                            Donate $20 today at <a href="{{ route('donate') }}">Donate Here</a> to help fund our next programme.
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

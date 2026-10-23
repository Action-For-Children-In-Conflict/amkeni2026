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
                    <img src="{{ asset('frontend/images/trc/trc3.jpeg') }}" alt="Temporary Rescue Center"
                        class="article-cover">

                    <h1 class="article-title">Temporary Rescue Center</h1>
                    <div class="article-meta">Karibaribi, Thika</div>

                    <div class="detail-body">
                        <p>
                            The rehabilitation center which is located at Karibaribi, Ngoigwa, Thika in Kiambu County,
                            serves as a safe haven for street connected children rescued from streets. In the center they are
                            provided with food, shelter, clothing and a formal and non-informal education in a protective
                            and nurturing environment.
                        </p>
                        <h2>What happens here</h2>
                        <p>
                          
                           
                        </p>
                        <ul class="detail-list">
                            <li>Provide accommodation for the children.</li>
                            <li>To educate and equip the children with life skills.</li>
                            <li>To equip the children with self-expression skills which in turn improves their self-esteem.</li>
                            <li>To detoxify the children and mitigate the impact of long-term use of alcoholic and drugs substances.</li>
                            <li>To provide counselling and cater for spiritual, and psychological needs for the children and families.</li>
                             <li> Education which for instance basic numeracy and literacy skills, fashion and art,
                            photography, videography.</li>
                           <li>Sports, education, educational entertainment for example dance, theater and music.</li>
                            <li> Provide counselling and cater for spiritual, and psychological needs for the children and
                            families.</li>
                           <li> Reintergration and home visits.</li>
                        </ul>
                        <div class="pull-quote">&ldquo;This is often the first place a child has felt safe enough to
                            actually be a child again.&rdquo;
                            <div
                                style="font-family:'Inter', sans-serif; font-style:normal; font-size:.85rem; color:#5b6472; margin-top:.6rem;">
                                — Centre Manager, Temporary Rescue Center
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

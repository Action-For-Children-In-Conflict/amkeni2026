@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= OUR TEAM ================= -->
    <section class="section-pad team-section">
        <div class="container container-narrow">
            <div class="section-head text-center mx-auto">
                <span class="section-eyebrow">Our Team</span>
                <h2>The people behind the mission</h2>
                <hr class="rule mx-auto">
                <p>Meet the passionate, skilled and committed individuals working hand in hand with communities to protect, educate and empower children and families in Thika, Kenya.</p>
            </div>

            <div class="row g-4 team-grid">
                @forelse ($teamMembers as $member)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <article class="team-card">
                            <div class="team-card-media">
                                <img src="{{ $member->image_url ? asset('storage/' . $member->image_url) : 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=1974&auto=format&fit=crop' }}"
                                    alt="{{ $member->name }}" loading="lazy">
                                <div class="team-card-overlay"></div>
                            </div>
                            <div class="team-card-body">
                                <h3 class="team-card-name">{{ $member->name }}</h3>
                                <p class="team-card-role">{{ $member->role }}</p>
                                @if ($member->content)
                                    <div class="team-card-bio">
                                        {!! $member->content !!}
                                    </div>
                                @endif
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="team-empty text-center">
                            <p class="mb-0">Our team details are being updated. Please check back soon.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

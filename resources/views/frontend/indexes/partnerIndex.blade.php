@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= ALL PARTNERS ================= -->
    <section class="section-pad partners-section" id="partners">
        <div class="container container-narrow">
            <div class="section-head text-center mx-auto">
                <span class="section-eyebrow">Our Partners &amp; Allies</span>
                <h2>Standing together for children and families</h2>
                <hr class="rule mx-auto">
                <p>Lasting change takes all of us. These organizations, foundations and companies stand with AfCiC to
                    protect children and strengthen families in Thika, Kenya.</p>
            </div>

            @if ($partners->isEmpty())
                <div class="text-center py-5">
                    <p class="text-muted mb-0">Our partner directory is being updated. Please check back soon.</p>
                </div>
            @else
                <div class="row g-4 partners-grid">
                    @foreach ($partners as $partner)
                        <div class="col-md-6 col-lg-4 d-flex">
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener"
                                class="partner-grid-link" title="{{ __('Visit :name', ['name' => $partner->name]) }}">
                                <div class="partner-card">
                                    <div class="partner-logo-box">
                                        @if ($partner->image_url)
                                            <img src="{{ asset('storage/' . $partner->image_url) }}"
                                                alt="{{ $partner->name }} logo" loading="lazy">
                                        @else
                                            <span
                                                class="partner-placeholder-icon">{{ Str::upper(Str::substr($partner->name, 0, 2)) }}</span>
                                        @endif
                                    </div>

                                    <div class="partner-info">
                                        <h3 class="partner-name">{{ $partner->name }}</h3>

                                        @if ($partner->role)
                                            <span class="partner-role">{{ $partner->role }}</span>
                                        @endif

                                        @if ($partner->content)
                                            <p class="partner-excerpt">{{ Str::limit(strip_tags($partner->content), 100) }}</p>
                                        @endif

                                        <span class="partner-visit">
                                            {{ __('Visit website') }}
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" aria-hidden="true">
                                                <path d="M7 17 17 7"></path>
                                                <path d="M7 7h10v10"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="partners-page-cta text-center mt-5">
                <h3 class="mb-2">Want to stand with us?</h3>
                <p class="mb-3">Join the organizations making lasting change possible for children in Thika.</p>
                <a href="{{ route('partner') }}" class="btn-primary-afcic">{{ __('Partner with us') }}</a>
            </div>
        </div>
    </section>
@endsection

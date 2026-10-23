@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <section class="enquiry-wrap">
        <div class="container container-narrow">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5">
                    <span class="section-eyebrow">{{ $eyebrow }}</span>
                    <h2 class="mb-3">{{ $introTitle }}</h2>
                    <hr class="rule">
                    <p class="enquiry-intro">{{ $intro }}</p>

                    @if (! empty($details))
                        <div class="enquiry-details">
                            @foreach ($details as $detail)
                                <div class="enquiry-detail">
                                    <span class="enquiry-detail-icon">
                                        @switch($detail['icon'] ?? 'pin')
                                            @case('phone')
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                                </svg>
                                            @break

                                            @case('mail')
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <rect width="20" height="16" x="2" y="4" rx="2"/>
                                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                                </svg>
                                            @break

                                            @case('clock')
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <polyline points="12 6 12 12 16 14"/>
                                                </svg>
                                            @break

                                            @default
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                        @endswitch
                                    </span>
                                    <div>
                                        <span class="enquiry-detail-label">{{ $detail['label'] }}</span>
                                        @if (! empty($detail['link']))
                                            <a href="{{ $detail['link'] }}"
                                                class="enquiry-detail-value">{{ $detail['value'] }}</a>
                                        @else
                                            <span class="enquiry-detail-value">{{ $detail['value'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if (! empty($points))
                        <ul class="enquiry-points">
                            @foreach ($points as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="col-lg-7">
                    <div class="enquiry-card">
                        <h3 class="mb-1">{{ $formTitle }}</h3>
                        <p class="enquiry-card-sub mb-4">Fields marked * are required.</p>

                        @include('frontend.inc.enquiry-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= CAREERS ================= -->
    <section class="section-pad focus-section" id="careers">
        <div class="container container-narrow">
            <div class="section-head">
                <span class="section-eyebrow">Careers</span>
                <h2>Join our team</h2>
                <hr class="rule">
                <p>Help us protect and empower children and families in Thika. Explore our current openings below.</p>
            </div>

            <div class="row g-4">
                @forelse ($jobs as $job)
                    <div class="col-md-6 col-lg-4">
                        <div class="focus-card h-100">
                            <div class="focus-img"
                                style="background-image:url('{{ asset('storage/' . $job->image_url) }}');"
                                title="{{ $job->title }}"></div>
                            <div class="focus-body">
                                <span class="focus-tag">Open role</span>
                                <h3>{{ $job->title }}</h3>
                                <p>{{ Str::limit(strip_tags($job->description), 120) }}</p>
                                <a href="{{ route('careers.show', $job->slug) }}" class="focus-link">View role</a>
                                @if ($job->hasDocument())
                                    <a href="{{ asset('storage/' . $job->document_path) }}" target="_blank" rel="noopener"
                                        class="focus-link ms-3">Download details</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">There are no open positions at the moment. Please check back soon.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $jobs->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection

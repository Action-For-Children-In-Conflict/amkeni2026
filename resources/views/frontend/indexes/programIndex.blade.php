@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= ALL PROGRAMS ================= -->
    <section class="section-pad focus-section" id="programs">
        <div class="container container-narrow">
            <div class="section-head">
                <span class="section-eyebrow">Our Programs</span>
                <h2>Explore all our programs</h2>
                <hr class="rule">
                <p>From child protection to climate action — discover how AfCiC creates lasting change for children and
                    vulnerable families in Thika, Kenya.</p>
            </div>

            <div class="row g-4">
                @forelse ($programs as $program)
                    <div class="col-md-6 col-lg-4">
                        <div class="focus-card h-100">
                            <div class="focus-img" style="background-image:url('{{ asset('storage/' . $program->image_url) }}');"
                                title="{{ $program->title }}"></div>
                            <div class="focus-body">
                                @if ($program->tag)
                                    <span class="focus-tag">{{ $program->tag->name }}</span>
                                @endif
                                <h3>{{ $program->title }}</h3>
                                <p>{!! Str::limit($program->description, 120) !!}.</p>
                                <a href="{{ route('programs.show', $program->slug) }}" class="focus-link">Read more</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No programs available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $programs->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection

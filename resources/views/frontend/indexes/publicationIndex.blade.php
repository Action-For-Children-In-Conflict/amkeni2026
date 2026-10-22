@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= PUBLICATIONS ================= -->
    <section class="section-pad focus-section" id="publications">
        <div class="container container-narrow">
            <div class="section-head">
                <span class="section-eyebrow">Publications</span>
                <h2>Our publications &amp; resources</h2>
                <hr class="rule">
                <p>Explore our publications, reports and resources on child protection, education, women's empowerment
                    and climate action in Thika, Kenya.</p>
            </div>

            <div class="row g-4">
                @forelse ($publications as $publication)
                    <div class="col-md-6 col-lg-4">
                        <div class="focus-card h-100">
                            <div class="focus-img"
                                style="background-image:url('{{ asset('storage/' . $publication->image_path) }}');"
                                title="{{ $publication->title }}"></div>
                            <div class="focus-body">
                                <h3>{{ $publication->title }}</h3>
                                @if ($publication->category)
                                    <span class="focus-tag">{{ $publication->category->name }}</span>
                                @endif
                                <p>{{ $publication->description }}</p>
                                <a href="{{ asset('storage/' . $publication->file_path) }}" class="focus-link"
                                    target="_blank" rel="noopener">Read more</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No publications available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $publications->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection

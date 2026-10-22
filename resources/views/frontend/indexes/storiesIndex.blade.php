@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= SUCCESS STORIES ================= -->
    <section class="section-pad focus-section" id="stories">
        <div class="container container-narrow">
            <div class="section-head">
                <span class="section-eyebrow">Success Stories</span>
                <h2>Real people, real change</h2>
                <hr class="rule">
                <p>Meet the children, women and families whose lives have been transformed with the support of AfCiC in
                    Thika, Kenya.</p>
            </div>

            <div class="row g-4">
                @forelse ($stories as $story)
                    <div class="col-md-6 col-lg-4">
                        <div class="focus-card h-100">
                            <div class="focus-img" style="background-image:url('{{ asset('storage/' . $story->image) }}');"
                                title="{{ $story->name }}"></div>
                            <div class="focus-body">
                                <h3>{{ $story->name }}</h3>
                                @if ($story->position)
                                    <span class="focus-tag">{{ $story->position }}</span>
                                @endif
                                <p>{!! Str::limit(strip_tags($story->content), 120) !!}.</p>
                                <a href="{{ route('frontend.stories', $story->slug) }}" class="focus-link">Read more</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No success stories available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $stories->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection

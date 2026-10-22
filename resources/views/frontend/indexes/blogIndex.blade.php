@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <!-- ================= BLOG & ARTICLES ================= -->
    <section class="section-pad focus-section" id="blogs">
        <div class="container container-narrow">
            <div class="section-head">
                <span class="section-eyebrow">Blog & Articles</span>
                <h2>Latest from our blog</h2>
                <hr class="rule">
                <p>News, insights and stories on child protection, education, women's empowerment and climate action in
                    Thika, Kenya.</p>
            </div>

            <div class="row g-4">
                @forelse ($blogs as $blog)
                    <div class="col-md-6 col-lg-4">
                        <div class="focus-card h-100">
                            <div class="focus-img"
                                style="background-image:url('{{ asset('storage/' . $blog->image_url) }}');"
                                title="{{ $blog->title }}"></div>
                            <div class="focus-body">
                                @if ($blog->category)
                                    <span class="focus-tag">{{ $blog->category->name }}</span>
                                @endif
                                <h3>{{ $blog->title }}</h3>
                                <p>{!! Str::limit(strip_tags($blog->content), 120) !!}.</p>
                                <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="focus-link">Read more</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No blog posts available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $blogs->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection

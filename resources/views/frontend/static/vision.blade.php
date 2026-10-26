@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <section class="section-pad">
        <div class="container container-narrow">
            <div class="section-head text-center mx-auto">
                <span class="section-eyebrow">Our Vision</span>
                <h2>A world of equal and sustainable opportunities for every child</h2>
                <hr class="rule mx-auto">
                <p>Regardless of where they were born or what they have been through, every child deserves to be safe, seen, heard and empowered.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <article class="about-text-card">
                        <p>A world of equal and sustainable opportunities for every child — regardless of where they were born or what they've already been through.</p>
                        <p>Together with families, communities and partners, we work towards a future where children grow up free from violence, able to access quality education, enjoy good health, and participate fully in shaping their communities.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.cta')
@endsection

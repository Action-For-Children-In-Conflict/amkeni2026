@extends('frontend.layouts.base')

@section('content')
    @include('frontend.inc.breadcrumb')

    <section class="section-pad">
        <div class="container container-narrow">
            <div class="section-head text-center mx-auto">
                <span class="section-eyebrow">Our Mission</span>
                <h2>Enhancing growth through care, opportunity and justice</h2>
                <hr class="rule mx-auto">
                <p>We are committed to walking alongside children, young people and their families as they build stronger, safer and more hopeful futures.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <article class="about-text-card">
                        <p>To enhance and support the growth of children, young people and their families by facilitating access to justice, education, health, psychosocial and economic support — with communities at the centre of their own growth.</p>
                        <p>We believe every child has inherent worth and potential. Our mission drives us to respond to the root causes of vulnerability, empower caregivers to provide safe homes, and equip young people with the skills they need to thrive independently.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.cta')
@endsection

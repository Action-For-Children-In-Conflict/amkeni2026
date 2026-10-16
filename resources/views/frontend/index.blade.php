@extends('frontend.layouts.base')
@section('content')
    @include('frontend.partials.heroslider')
    {{--  @include('frontend.partials.about') --}}
    @include('frontend.partials.programs')
    @include('frontend.partials.focus')
    @include('frontend.partials.centers')
    @include('frontend.partials.stories')
    @include('frontend.partials.cta')
    @include('frontend.partials.youtube')
    @include('frontend.partials.blog')
    @include('frontend.partials.partners')
    @include('frontend.partials.contact')
     <!-- ================= NEWSLETTER ================= -->
    <section class="newsletter py-5">
        <div class="container container-narrow">
            <div class="row align-items-center g-3">
                <div class="col-lg-5">
                    <h3 class="mb-1">Stay close to our work</h3>
                    <p class="mb-0" style="color:rgba(255,255,255,.85);">Monthly updates on programmes, stories and how funds are used.</p>
                </div>
                <div class="col-lg-7">
                    <form class="d-flex flex-column flex-sm-row gap-2" onsubmit="return false;">
                        <input type="email" class="form-control" placeholder="Your email address" required>
                        <button type="submit" class="btn-sub">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@extends('frontend.layouts.base')
@section('content')
    @include('frontend.partials.heroslider')
    {{--  @include('frontend.partials.about') --}}
    @include('frontend.partials.programs')
    @include('frontend.partials.focus')
    @include('frontend.partials.centers')
    @include('frontend.partials.stories')
    @include('frontend.partials.contact')
@endsection

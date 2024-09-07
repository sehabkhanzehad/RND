@extends('layouts.homepage.master')

@section('content')
    @include('components.homepage.hero')
    @include('components.homepage.services.featured-services')
    @include('components.homepage.about.about')
    @include("components.homepage.services.services")
    @include("components.homepage.call-to-action")
    @include('components.homepage.services.features')
    @include("components.homepage.pricing.vertical-pricing")
    @include('components.homepage.testimonial')
    @include('components.homepage.faq')
@endsection

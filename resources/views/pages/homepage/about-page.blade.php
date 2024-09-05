@extends('layouts.homepage.master')
@section('content')
    @include('components.homepage.about.page-title')
    @include('components.homepage.about.about')
    @include('components.homepage.about.stats')
    @include('components.homepage.about.team')
    @include('components.homepage.testimonial')
@endsection

@extends('layouts.dashborad.master')
{{-- @section("scriptH")
<script src="{{ asset('assets/dashboard/js/include/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/include/jquery.dataTables.min.js') }}"></script>
@endsection --}}
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Website</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>
    @include('components.dashboard.aboutus.about.data')
    @include('components.dashboard.aboutus.about.item-create')
    @include('components.dashboard.aboutus.about.item-update')
    @include('components.dashboard.aboutus.about.item-delete')
@endsection

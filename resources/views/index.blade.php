@extends('layouts.main')

@section('content')
    @include('pages.nav')
    @include('pages.banner')
    <div class="section-block"></div>
    @include('pages.aboutus')
    @include('pages.featuredcourse')
    @include('pages.topics')
    @include('pages.coursestart')
    {{-- @include('pages.funfact') --}}
    @include('pages.userfeedback')
    @include('pages.explore')
    @include('layouts.footer')

@endsection

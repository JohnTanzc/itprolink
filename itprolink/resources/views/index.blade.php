@extends('layouts.main')

@section('content')
    @include('pages.nav')
    @include('pages.banner')
    @include('pages.teachers')
    @include('pages.video')
    {{-- @include('pages.feature') --}}
    @include('pages.testimonial')
    @include('pages.registration')
    @include('pages.blog')
    @include('layouts.footer')

@endsection

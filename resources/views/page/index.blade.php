@extends('layouts.app',[
    'title' => 'Home',
])

@push('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">    
@endpush


@section('content')

    <section id="carousel">
        @include('components.carousel')
    </section>

    <section id="statistik">
        @include('components.statistik')
    </section>

    <section id="about">
        @include('components.about')
    </section>

    <section id="artikel">
        @include('components.artikel')
    </section>

    <section id="gallery">
        @include('components.gallery')
    </section>

@endsection
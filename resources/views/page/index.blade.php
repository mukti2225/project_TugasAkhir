@extends('layouts.app', [
    'title' => '',
])

@section('content')
    <div id="hero">
        @include('components.carousel')
    </div>

    @include('components.statistik')

    @include('components.artikel')

    @include('components.agenda')

    @include('components.gallery')

    <div id="about">
        @include('components.about')
    </div>

    @include('components.ptn')
@endsection

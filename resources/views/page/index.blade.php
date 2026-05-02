@extends('layouts.app',[
    'title' => 'Home',
])

@section('content')
    <div id="hero">
        @include('components.carousel')
    </div>    

    @include('components.statistik')

    <div id="about">
        @include('components.about')
    </div>

    @include('components.artikel')

    @include('components.gallery')

    {{-- @include('components.vidio-profil') --}}

    @include('components.ptn')
@endsection

@push('js')
    <script src="{{ asset('js/index.js') }}"></script>
@endpush
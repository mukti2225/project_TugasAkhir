@extends('layouts.app',[
    'title' => 'Home',
])

@section('content')
    @include('components.carousel')

    @include('components.statistik')

    @include('components.artikel')

    @include('components.gallery')

    <div id="about">
        @include('components.about')
    </div>

    {{-- @include('components.vidio-profil') --}}

    @include('components.ptn')
@endsection

@push('js')
    <script src="{{ asset('js/index.js') }}"></script>
@endpush
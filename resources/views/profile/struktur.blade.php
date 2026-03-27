@extends('layouts.app', [
    'title' => 'Struktur Organisasi',
])

@section('content')
    <div>

        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Struktur Organisasi'
        ])

        <!-- Content -->
        <div class="container py-5">

        <div class="row align-items-center">
            <div class="col-12 text-center">
                <img 
                    src="{{ asset('img/dump/struktur.png') }}" 
                    alt="Struktur Organisasi SMA Arif Rahman Hakim"
                    class="img-fluid"
                >
            </div>
        </div>
        </div>

    </div>
@endsection

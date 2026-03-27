@extends('layouts.app', [
    'title' => 'Staff Pendidik',
])

@section('content')
    <div>

        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Tenaga Pendidik'
        ])

        <!-- Content -->
        {{-- <div class="row align-items-center">
            <div class="col-12 text-center">
                <img 
                    src="{{ asset('img/dump/struktur.png') }}" 
                    alt="Struktur Organisasi SMA Arif Rahman Hakim"
                    class="img-fluid"
                >
            </div>
        </div> --}}

    </div>
@endsection

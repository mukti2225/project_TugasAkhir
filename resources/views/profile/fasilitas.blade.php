@extends('layouts.app', [
    'title' => 'Fasilitas Sekolah',
])

@section('content')
    <div>

        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Fasilitas Sekolah'
        ])

        <div class="container py-5">
            <div class="fasilitas-grid">
                @foreach($fasilitas as $fasilitas)
                <div class="card-fasilitas">
                    <img src="{{ asset('storage/' . $fasilitas->foto) }}" alt="gambar">
                    <div class="overlay">
                        <h3>{{ $fasilitas->nama }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

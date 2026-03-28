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
                <div class="card-fasilitas">
                    <img src="{{ asset('img/fasilitas/lapangan.jpg') }}" alt="Lapangan">
                    <div class="overlay">
                        <h3>Lapangan</h3>
                    </div>
                </div>
                <div class="card-fasilitas">
                    <img src="{{ asset('img/fasilitas/perpustakaan.jpg') }}" alt="Perpustakaan">
                    <div class="overlay">
                        <h3>Perpustakaan</h3>
                    </div>
                </div>
                <div class="card-fasilitas">
                    <img src="{{ asset('img/fasilitas/laboratorium.jpg') }}" alt="Laboratorium">
                    <div class="overlay">
                        <h3>Laboratorium</h3>
                    </div>
                </div>
                <div class="card-fasilitas">
                    <img src="{{ asset('img/fasilitas/ruangKelas.jpg') }}" alt="Ruang Kelas">
                    <div class="overlay">
                        <h3>Ruang Kelas</h3>
                    </div>
                </div>
                <div class="card-fasilitas">
                    <img src="{{ asset('img/fasilitas/Masjid.jpg') }}" alt="Masjid">
                    <div class="overlay">
                        <h3>Masjid</h3>
                    </div>
                </div>
                <div class="card-fasilitas">
                    <img src="{{ asset('img/fasilitas/toilet.jpg') }}" alt="Toilet">
                    <div class="overlay">
                        <h3>Toilet</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

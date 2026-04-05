@extends('layouts.app', [
    'title' => 'Fasilitas Sekolah',
])

@section('content')
    <div>

        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Fasilitas Sekolah'
        ])

            <div class="container fasilitas">
                @if($fasilitas->count())
                <div class="fasilitas-grid">
                    @foreach($fasilitas as $fasilitas)
                    <div class="card-fasilitas">
                        <img src="{{ asset('storage/' . $fasilitas->foto) }}">
                        <div class="overlay">
                            <h3>{{ $fasilitas->nama }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <h4 class="fw-bold">Data fasilitas belum tersedia</h4>
                </div>
                @endif
            </div>
    </div>
@endsection

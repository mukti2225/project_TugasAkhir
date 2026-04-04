@extends('layouts.app',[
    'title' => 'Alumni',
])

@section('content')
    <!-- Header -->
        @include('components.page-header', [
            'title' => 'Sebaran Alumni'
        ])

    <!-- Konten -->
    <div class="kesiswaan-page container">
        @if($alumni->count())
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2">DAFTAR PERGURUAN TINGGI ALUMNI</h2>
            <p class="subtitle">Bergabunglah dengan jaringan alumni dari universitas terbaik di Indonesia</p>
        </div>
        
        <div class="logo-kampus">
            @foreach($alumni as $alumni)
            <div class="logo-kesiswaan">
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $alumni->logo) }}" class="logo-kampus-item mb-2">
                            <div class="logo-caption">
                                {{ $alumni->caption }}
                            </div>
                    </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <h3 class="fw-bold">Data alumni belum tersedia</h3>
        </div>
        @endif
    </div>
        
@endsection
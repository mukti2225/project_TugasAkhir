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
        <div class="text-center mt-4 mb-4">
            <h2 class="fw-bold mb-2">DAFTAR PERGURUAN TINGGI ALUMNI</h2>
            <p class="subtitle">Bergabunglah dengan jaringan alumni dari universitas terbaik di Indonesia</p>
        </div>
        
        <div class="logo-kampus">
            <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo ITB" class="logo-kampus-item">
                <span class="logo-caption">Institut Teknologi Bandung</span>
            </div>
            <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UI" class="logo-kampus-item">
                <span class="logo-caption">Universitas Indonesia</span>
            </div>
            <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UGM" class="logo-kampus-item">
                <span class="logo-caption">Universitas Gadjah Mada</span>
            </div>
            <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UNAIR" class="logo-kampus-item">
                <span class="logo-caption">Universitas Airlangga</span>
            </div>
            <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UNDIP" class="logo-kampus-item">
                <span class="logo-caption">Universitas Diponegoro</span>
            </div>
            <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UNHAS" class="logo-kampus-item">
                <span class="logo-caption">Universitas Hasanuddin</span>
            </div>
             <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UNHAS" class="logo-kampus-item">
                <span class="logo-caption">Universitas Hasanuddin</span>
            </div>
             <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UNHAS" class="logo-kampus-item">
                <span class="logo-caption">Universitas Hasanuddin</span>
            </div>
             <div class="logo-kesiswaan">
                <img src="{{ asset('img/logo/ARH.png') }}" alt="Logo UNHAS" class="logo-kampus-item">
                <span class="logo-caption">Universitas Hasanuddin</span>
            </div>
        </div>
    </div>
        
@endsection
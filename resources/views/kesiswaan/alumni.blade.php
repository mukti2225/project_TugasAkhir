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
            <div class="logo-kesiswaan">
                @foreach($alumni as $item)
                    @if($item->ptn) {{-- cek relasi ada --}}
                    <div class="text-center">
                        <img 
                            src="{{ asset('storage/' . $item->ptn->logo) }}" 
                            class="logo-kampus-item mb-2"
                            alt="{{ $item->ptn->universitas }}">

                        <span class="logo-caption">
                            {{ $item->ptn->universitas }}
                        </span>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <h3 class="fw-bold">Data alumni belum tersedia</h3>
        </div>
        @endif
    </div>
        
@endsection
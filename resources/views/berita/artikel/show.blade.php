@extends('layouts.app', [
    'title' => 'Baca Artikel',
])

@section('content')
<div class="container show">

    <div class="kategori mb-2">
        <small>{{ $artikel->kategoriArtikel->nama_kategori }}</small>
    </div>

    <div class="headline mb-2">
        <h3>{{ $artikel->judul }}</h3>
    </div>

    <span class="text-muted d-block mb-3">
        {{ $artikel->created_at->format('F, d Y') }}
    </span>

    <div
        class="blog-img d-flex align-items-center justify-content-center mb-4"
        style="background-image: url('{{ asset('storage/' . $artikel->thumbnail) }}')">
    </div>

    <div class="blog-details-content">
        <div class="blog-details-text">
            {!! $artikel->deskripsi !!}
        </div>
    </div>

</div>
@endsection

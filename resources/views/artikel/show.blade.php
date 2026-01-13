@extends('layouts.app',[
	'title' => 'Baca Artikel',
])

@push('css')
<link rel="stylesheet" href="{{ asset('css/artikel.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="blog-img d-flex align-items-center justify-content-center" 
    style="background-image:url('{{ asset('storage/'.$artikel->thumbnail) }}')">
    </div>

    <div class="blog-details-content">
        <div class="kategori mb-2">
            <small>{{ $artikel->kategoriArtikel->nama_kategori }}</small>
            
        </div>
        <div class="headline mb-2">
            <h3>{{ $artikel->judul }}</h3> 
        </div>   
        <div class="blog-details-text">
            {!! $artikel->deskripsi !!}
      </div>
    </div>
</div>
@endsection
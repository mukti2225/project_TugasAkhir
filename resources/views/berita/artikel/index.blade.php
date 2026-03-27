@extends('layouts.app',[
    'title' => 'List Artikel',
])

@section('content')
<section class="section-padding-100-0 mb-50">
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Berita & Artikel'
        ])

<div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="kategori-filter d-flex flex-wrap gap-2 justify-content-center">
                        <a href="{{ route('berita.artikel') }}"
                        class="btn kategori-btn {{ !request('kategori') ? 'active' : '' }}">
                            Semua
                        </a>
                        @foreach($kategori as $kat)
                            <a href="{{ route('berita.artikel', ['kategori' => $kat->id]) }}"
                            class="btn kategori-btn {{ request('kategori') == $kat->id ? 'active' : '' }}">
                                {{ $kat->nama_kategori }}
                            </a>
                        @endforeach
                    </div>

                    <form class="d-flex" action="{{ route('berita.artikel.search') }}" method="GET" style="width: 250px;">
                        <input class="form-control form-control-sm me-2" type="search"
                               name="keyword" placeholder="Cari berita">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!--Card Artikel -->
        <div class="row g-4 justify-content-start">
            @foreach($artikel as $art)
            <div class="col-6 col-md-3 col-lg-3">
                <article class="h-100 w-100 border-0">

                <div class="artikel-card h-100 shadow-sm">
                    <a href="{{ route('berita.artikel.show',$art->slug) }}">
                        <img src="{{ asset('storage/' . $art->thumbnail) }}" class="card-img-top">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <small class="mt-2 mb-2 d-flex justify-content-between">
                                <span class="kategori">
                                    {{ $art->kategoriArtikel->nama_kategori }}
                                </span>
                                <span class="text-muted">
                                    {{ $art->created_at->format('d M Y') }}
                                </span>
                        </small>
                       
                        <h6 class="card-title mb-2">
                            <a href="{{ route('berita.artikel.show', $art->slug) }}"
                               class="text-decoration-none text-dark">
                                {{ Str::limit($art->judul, 60) }}
                            </a>
                        </h6>

                        <p class="card-text small mb-3">
                            {!! Str::limit(strip_tags($art->deskripsi), 100) !!}
                            <a href="{{ route('berita.artikel.show',$art->slug) }}" class="text-decoration-none">Selengkapnya
                            </a>
                        </p>
                    </div>
                </div>
                </article>
            </div>
        @endforeach
        </div>
    </div>
</section>
@endsection
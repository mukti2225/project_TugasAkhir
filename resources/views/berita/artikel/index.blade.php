@extends('layouts.app', [
    'title' => 'Artikel - ',
])

@section('content')
    <section class="section-padding-100-0 mb-50">
        @include('components.page-header', [
            'title' => 'Berita & Artikel',
        ])

        <div class="container-fluid artikel-index">
            <div class="container">

                <div class="artikel-toolbar">
                    <div class="kategori-filter d-none d-md-flex gap-2">
                        <a href="{{ route('berita.artikel') }}"
                            class="btn kategori-btn {{ !request('kategori') ? 'active' : '' }}">
                            Semua
                        </a>
                        @foreach ($kategori as $kat)
                            <a href="{{ route('berita.artikel', ['kategori' => $kat->id]) }}"
                                class="btn kategori-btn {{ request('kategori') == $kat->id ? 'active' : '' }}">
                                {{ $kat->nama_kategori }}
                            </a>
                        @endforeach
                    </div>

                    <form class="search-form" action="{{ route('berita.artikel.search') }}" method="GET">
                        <input type="search" name="keyword" placeholder="Cari berita atau artikel...">
                        <button type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </form>
                </div>

                <div class="artikel-grid">
                    @if ($artikel->count())
                        @foreach ($artikel as $art)
                            <a href="{{ route('berita.artikel.show', $art->slug) }}" class="artikel-card">
                                <div class="artikel-img-wrapper">
                                    <img src="{{ asset('storage/' . $art->thumbnail) }}" alt="{{ $art->judul }}">
                                </div>
                                <div class="artikel-body">
                                    <div class="artikel-meta">
                                        <span class="badge-kategori">
                                            {{ $art->kategoriArtikel->nama_kategori }}
                                        </span>
                                        <span class="artikel-date">
                                            {{ $art->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    <h6 class="artikel-title">
                                        {{ Str::limit($art->judul, 50) }}
                                    </h6>
                                    <p class="artikel-desc">
                                        {!! Str::limit(strip_tags($art->deskripsi), 75) !!}
                                    </p>
                                    <span class="artikel-readmore">Baca selengkapnya →</span>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="artikel-empty">
                            <h4>Belum ada artikel tersedia</h4>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection

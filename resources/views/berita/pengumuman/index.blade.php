@extends('layouts.app', [
    'title' => 'Pengumuman - ',
])

@section('content')
    <section class="section-padding-100-0 mb-50">
        @include('components.page-header', [
            'title' => 'Pengumuman',
        ])

        <div class="container-fluid artikel-index pengumuman-index">
            <div class="container">

                <div class="artikel-toolbar">
                    <div></div>{{-- spacer agar search tetap ke kanan --}}

                    <form class="search-form" action="{{ route('berita.pengumuman.search') }}" method="GET">
                        <input type="search" name="keyword" placeholder="Cari pengumuman...">
                        <button type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </form>
                </div>

                <div class="artikel-grid">
                    @if ($pengumuman->count())
                        @foreach ($pengumuman as $p)
                            <a href="{{ route('berita.pengumuman.show', $p->slug) }}" class="artikel-card">
                                <div class="artikel-img-wrapper">
                                    <img src="{{ asset('img/logo/Pengumuman.png') }}" alt="{{ $p->judul }}">
                                </div>
                                <div class="artikel-body">
                                    <div class="artikel-meta">
                                        <span class="badge-kategori">Pengumuman</span>
                                        <span class="artikel-date">
                                            {{ $p->created_at ? $p->created_at->format('d M Y') : '' }}
                                        </span>
                                    </div>
                                    <h6 class="artikel-title">
                                        {{ Str::limit($p->judul, 50) }}
                                    </h6>
                                    <span class="artikel-readmore">Baca selengkapnya →</span>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="artikel-empty">
                            <h4>Belum ada pengumuman tersedia</h4>
                        </div>
                    @endif
                </div>

                @if ($pengumuman->count())
                    <div class="mt-4">
                        {{ $pengumuman->links() }}
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection

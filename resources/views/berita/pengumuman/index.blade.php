@extends('layouts.app',[
    'title' => 'List Pengumuman',
])

@section('content')
<section class="section-padding-100-0 mb-50">
        <!-- Header -->
        @include('components.page-header', [
            'title' => 'Pengumuman'
        ])

<div class="container-fluid pengumuman-container">
<div class="container ">
    @if($pengumuman->count())
        <div class="row py-4">
            <div class="col-12">
                <div class="d-flex justify-content-end align-items-end">

                    <form class="d-flex" action="{{ route('berita.pengumuman.search') }}" method="GET" style="width: 250px;">
                        <input class="form-control form-control-sm me-2" type="search"
                               name="keyword" placeholder="Cari pengumuman">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!--Card Artikel -->
        <div class="row g-4 justify-content-start">
            @foreach($pengumuman as $p)
            <div class="col-6 col-md-3 col-lg-3">
                <article class="h-100 w-100 border-0">
                    <div class="artikel-card h-100 shadow-sm">
                        <a href="{{ route('berita.pengumuman.show', $p->slug) }}">
                            <img src="{{ asset('img/logo/announcement.png') }}" class="card-img-top">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <small class="mt-2 mb-2 d-flex justify-content-between">
                                <span class="kategori">Pengumuman</span>
                                <span class="text-muted">{{ $p->created_at ? $p->created_at->format('d M Y') : '' }}</span>
                            </small>
                            <h6 class="card-title mb-2">
                                <a href="{{ route('berita.pengumuman.show', $p->slug) }}" class="text-decoration-none text-dark">
                                    {{ \Illuminate\Support\Str::limit($p->judul, 60) }}
                                </a>
                            </h6>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $pengumuman->links() }}
        </div>
    @else
        <div class="text-center fw-bold py-5">
            <h4 class="text-muted">Belum ada pengumuman tersedia</h4>
        </div>
    @endif
</div>
</section>
@endsection
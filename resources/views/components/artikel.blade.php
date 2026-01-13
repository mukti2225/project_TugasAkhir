@if($artikel->count() > 0)
<section class="artikel section-padding-60-0 mb-5 py-4">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-start d-flex justify-content-between align-items-center">
                <h4 class="fw-bold">Berita Terbaru</h4>
                <form class="d-flex me-3" action="{{ route('artikel.search') }}" method="GET">
                <input class="form-control form-control-sm me-2" type="search"
                       name="keyword" placeholder="Search">
                <button class="btn btn-outline-primary btn-sm" type="submit">Search
                </button>
                </form> 
            </div>
        </div>
            

        <div class="row g-4">
            @foreach($artikel as $art)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="h-100 border-0 shadow-sm">

                    {{-- THUMB --}}
                    <img src="{{ asset('storage/' . $art->thumbnail) }}"
                         class="card-img-top"
                         style="height:180px; object-fit:cover;"
                         alt="{{ $art->judul }}">

                    <div class="card-body">
                        <small class="badge bg-primary mb-2">
                                {{ $art->kategoriArtikel->nama_kategori }}
                        </small>

                        <h6 class="card-title mb-2">
                            {{ Str::limit($art->judul, 60) }}
                        </h6>

                        <p class="card-text small mb-3">
                            {!! Str::limit(strip_tags($art->deskripsi), 90) !!}
                        </p>

                        <a href="{{ route('artikel.show',$art->slug) }}"
                           class="btn btn-sm btn-outline-secondary">
                            Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($artikel->count() > 0)
<section class="artikel py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-3 text-center">
                <h4 class="artikel-section">Artikel Berita</h4>
                <h1 class="artikel-judul">PORTAL INFORMASI SEKOLAH ARIF RAHMAN HAKIM</h1>
                <p class="artikel-desc">
                    Baca artikel, berita, dan informasi terbaru seputar kegiatan dan prestasi sekolah
                </p>
            </div>
        </div>
            

        <div class="row mb-4 g-3 justify-content-center">
            @foreach($artikel as $art)
            <div class="col-12 col-md-6 col-lg-3">
                <article class="h-100 w-100 border-0">
                    <a href="{{ route('berita.artikel.show', $art->slug) }}" class="text-decoration-none text-dark">
                        <div class="artikel-card h-100" data-aos="fade-up">
                            <img src="{{ asset('storage/' . $art->thumbnail) }}" class="card-img-top">
                            <div class="card-body flex-column">
                                <small class="mt-2 mb-2 d-flex justify-content-between">
                                        <span class="kategori">
                                            {{ $art->kategoriArtikel->nama_kategori }}
                                        </span>
                                        <span class="text-muted">
                                            {{ $art->created_at->format('d M Y') }}
                                        </span>
                                </small>
                            
                                <h6 class="card-title mb-2">
                                        {{ Str::limit($art->judul, 60) }}
                                </h6>

                                <p class="card-text small mb-3">
                                    {!! Str::limit(strip_tags($art->deskripsi), 150) !!}
                                </p>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('berita.artikel') }}" class="btn-lihat">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>
@endif

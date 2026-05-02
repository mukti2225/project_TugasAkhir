@if($artikel->count() > 0)
<section class="section-artikel py-5">
    <div class="container">

        {{-- Header --}}
        <div class="row mb-2">
            <div class="col-12 text-center">
                <span class="section-label">Artikel Berita</span>
                <div class="section-divider mx-auto mt-2 mb-3"></div>
                <h2 class="section-title">Portal Informasi Sekolah Arif Rahman Hakim</h2>
                <p class="section-desc mx-auto">
                    Baca artikel, berita, dan informasi terbaru seputar kegiatan dan prestasi sekolah
                </p>
            </div>
        </div>

        {{-- Cards --}}
        <div class="row g-4 justify-content-center">
            @foreach($artikel as $art)
            <div class="col-12 col-sm-6 col-lg-3">
                <a href="{{ route('berita.artikel.show', $art->slug) }}" class="text-decoration-none">
                    <article class="artikel-card h-100" data-aos="fade-up">
                        <div class="artikel-img-wrapper">
                            <img
                                src="{{ asset('storage/' . $art->thumbnail) }}"
                                alt="{{ $art->judul }}"
                                class="artikel-img"
                                loading="lazy"
                            >
                        </div>
                        <div class="artikel-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge-kategori">
                                    {{ $art->kategoriArtikel->nama_kategori }}
                                </span>
                                <span class="artikel-date">
                                    {{ $art->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <h6 class="artikel-title">
                                {{ Str::limit($art->judul, 60) }}
                            </h6>
                            <p class="artikel-desc">
                                {!! Str::limit(strip_tags($art->deskripsi), 100) !!}
                            </p>
                        </div>
                    </article>
                </a>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="text-center mt-5">
            <a href="{{ route('berita.artikel') }}" class="btn-lihat-semua">
                Lihat Semua Artikel &rarr;
            </a>
        </div>

    </div>
</section>
@endif
@if($artikel->count() > 0)
<section class="artikel mb-5 py-4">
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
            

        <div class="row g-4">
            @foreach($artikel as $art)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="h-100 border-0 shadow-sm artikel-card">

                    {{-- THUMB --}}
                    <img src="{{ asset('storage/' . $art->thumbnail) }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;"
                         alt="{{ $art->judul }}">

                    <div class="card-body">
                        <small class="mb-2 d-flex justify-content-between">
                                <div class="badge bg-primary text-white">
                                    {{ $art->kategoriArtikel->nama_kategori }}
                                </div>
                                <div class="text-muted">
                                    {{ $art->created_at->format('d M Y') }}
                                </div>
                        </small>
                       
                        <h6 class="card-title mb-2">
                            {{ Str::limit($art->judul, 60) }}
                        </h6>

                        <p class="card-text small mb-3">
                            {!! Str::limit(strip_tags($art->deskripsi), 200) !!}
                            <a href="{{ route('artikel.show',$art->slug) }}" class="text-decoration-none">Selengkapnya
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($gallery->count() > 0)
<section class="gallery py-4">
    <div class="container">
      <div class="row">

      <!-- TEKS -->
      <div class="col-lg-12 p-3 text-center">
        <h4 class="gallery-section">Galeri Sekolah</h4>
        <h1 class="gallery-judul">DOKUMENTASI KEGIATAN SEKOLAH</h1>
        <p class="gallery-desc">
           lihat berbagai aktivitas dan momen sekolah melalui galeri sekolah
        </p>
      </div>

      <div class="col-lg-12 mb-6 mb-lg-0">
        <div class="gallery-scroll justify-content-center">
          @foreach($gallery as $gallery)
          <div class="gallery-item">
            <div class="card-gallery">
                <img src="{{ asset('storage/'.$gallery->image) }}" alt="Gallery Image">
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif
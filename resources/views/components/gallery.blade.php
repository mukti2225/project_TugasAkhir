@if($gallery->count() > 0)
  <div class="container-fluid gallery py-5">
    <div class="container">
        <div class="row">
      <!-- GALERI -->
      <div class="col-lg-9 mb-4 mb-lg-0">
        <div class="gallery-scroll">
          @foreach($gallery as $gallery)
          <div class="gallery-item">
            <div class="card-gallery">
                <img src="{{ asset('storage/'.$gallery->image) }}" alt="Gallery Image">
            </div>
          </div>
        @endforeach
        </div>
      </div>

      <!-- TEKS -->
      <div class="col-lg-3 p-3">
        <h2 class="gallery-title">Gallery Sekolah</h2>
        <p class="gallery-desc">
          Temukan aktivitas dan kesenangan di sekolahmu.
        </p>
        <a href="#" class="gallery-link">Aktivitas Siswa →</a><br>
        <a href="#" class="gallery-link">Fasilitas →</a>
      </div>
    </div>
    </div>
  </div>
  @endif
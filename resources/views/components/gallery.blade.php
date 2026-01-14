@if($gallery->count() > 0)
  <div class="container-fluid gallery py-5">
    <div class="container">
        <div class="row">

      <!-- TEKS -->
      <div class="col-lg-12 p-3 text-center">
        <h3 class="gallery-title">Gallery Sekolah</h3>
        <p class="gallery-desc">
          Temukan aktivitas dan kesenangan di sekolahmu.
        </p>
      </div>

      <!-- GALERI -->
      <div class="col-lg-12 mb-6 mb-lg-0">
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

    </div>
    </div>
  </div>
  @endif
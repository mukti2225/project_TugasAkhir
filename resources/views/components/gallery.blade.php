@if($gallery->count() > 0)
<section class="gallery">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-2 text-center ">
            <h4 class="section">Gallery Sekolah</h4>
            <h1 class="judul">DOKUMENTASI KEGIATAN</h1>
            <p class="desc">
               Jelajahi berbagai aktivitas, momen, dan prestasi yang terjadi di lingkungan sekolah kami.
            </p>
        </div>
      </div>

          <div class="col-12 mb-6 mb-lg-0 justify-content-center d-flex">
            <div class="scroll" id="galleryContainer">
              @foreach($gallery as $item)
                  <div class="item" data-aos="zoom-in">
                    <div class="card-gallery rounded-3 shadow-sm position-relative overflow-hidden">
                      <!-- Overlay Hover -->
                      <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                        <span class="text-overlay">{{ $item->title }}</span>
                      </div>
                    <img src="{{ asset('storage/'.$item->image) }}" class="img w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                  </div>
                </div>
              @endforeach
            </div>
          </div>
      {{-- <div class="text-center mt-5 mb-4">
            <a href="{{ route('berita.artikel') }}" class="btn-lihat">
                Lihat Semua Gallery
            </a>
        </div> --}}
    </div>
</section>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryContainer = document.getElementById('galleryContainer');
    
    if(galleryContainer) {
        
        // Hover Effects via JS for Overlay
        const cards = galleryContainer.querySelectorAll('.card-gallery');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('active');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('active');
            });
        });
        
        let isDown = false;
        let startX;
        let scrollLeft;

        galleryContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            galleryContainer.style.cursor = 'grabbing';
            startX = e.pageX - galleryContainer.offsetLeft;
            scrollLeft = galleryContainer.scrollLeft;
        });

        const resetDrag = () => {
            isDown = false;
            if(galleryContainer) galleryContainer.style.cursor = 'grab';
        };

        galleryContainer.addEventListener('mouseleave', resetDrag);
        galleryContainer.addEventListener('mouseup', resetDrag);

        galleryContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - galleryContainer.offsetLeft;
            const walk = (x - startX) * 2; 
            galleryContainer.scrollLeft = scrollLeft - walk;
        });
    }
});
</script>
@endpush
@endif
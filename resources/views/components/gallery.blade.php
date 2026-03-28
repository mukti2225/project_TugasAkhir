@if($gallery->count() > 0)
<section class="gallery py-5">
    <div class="container">
      <div class="row align-items-end mb-4">

        <!-- TEKS -->
        <div class="col-lg-12 text-center ">
            <h4 class="gallery-section">
                GALERI SEKOLAH
            </h4>
            <h1 class="gallery-judul">DOKUMENTASI KEGIATAN</h1>
            <p class="gallery-desc">
               Jelajahi berbagai aktivitas, momen, dan prestasi yang terjadi di lingkungan sekolah kami.
            </p>
        </div>
      </div>

      <div class="row">
          <div class="col-12 px-0 px-md-3">
            <div class="gallery-scroll" id="galleryContainer">
              @foreach($gallery as $item)
                  <div class="gallery-item">
                    <div class="card-gallery rounded-3 shadow-sm position-relative overflow-hidden">
                      <!-- Overlay Hover -->
                      <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4">
                        <span class="text-white fw-medium h5 mb-0">{{ $item->title }}</span>
                      </div>
                    <img src="{{ asset('storage/'.$item->image) }}" alt="Gallery Image" class="gallery-img w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                  </div>
                </div>
              @endforeach
            </div>
          </div>
      </div>
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
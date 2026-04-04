@if($ptn->count() > 0)
<section class="ptn">
    <div class="container">
      <div class="row">

        <!-- TEKS -->
        <div class="col-lg-12 text-center">
          <h4 class="section">Prestasi</h4>
          <h1 class="judul">SISWA YANG DITERIMA PERGURUAN TINGGI</h1>
          <p class="desc mb-4">
            Lulusan SMA Arif Rahman Hakim yang berhasil diterima di berbagai Perguruan Tinggi Negeri (PTN) melalui berbagai jalur seleksi seperti SNBP, SNBT, dan jalur mandiri.
          </p>
        </div>

      <!-- CARD -->
      <div class="col-lg-12 mb-6 mb-lg-0 justify-content-center d-flex">
        <div class="scroll"  id="ptnContainer">
          @foreach ($ptn as $ptn)
          <div class="item">
            <div class="card-ptn" data-aos="flip-right">
              <img src="{{ asset('storage/'.$ptn->foto) }}">
              <div class="overlay">
                <img src="{{ asset('storage/'.$ptn->logo) }}">
                <div class="text">
                  <h2>{{ $ptn->nama }}</h2>
                  <h5>{{ $ptn->universitas }}</h5>
                </div>
              </div>
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
    const galleryContainer = document.getElementById('ptnContainer');
    
    if(galleryContainer) {
        
        // Hover Effects via JS for Overlay
        const cards = galleryContainer.querySelectorAll('.scroll');
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
@if($statistik)
  <div class="container statistik" data-aos="fade-up" data-aos-duration="800">
    <div class="row horizontal-card">

      <!-- KIRI: SAMBUTAN -->
      <div class="col-lg-7 mb-4 mb-lg-0">
        <div class="stats-card">
          <h4 class="title">{{ $statistik->title }}</h4>

          <p class="desc">
            {!! Str::limit(strip_tags($statistik->sambutan), 250) ?? 'Sambutan belum tersedia.' !!}
          </p>

          <a href="{{ route('profil.sambutan') }}" class="link-sambutan">Sambutan Kepala Sekolah..</a>

          <div class="d-flex align-items-center mt-3">
            <img src="{{ asset('storage/' . $statistik->photo) }}" class="foto-kepsek" alt="Foto Kepala Sekolah">
            <div class="ms-3">
              <strong>{{ $statistik->name }}</strong><br>
              <span class="text-muted small">{{ $statistik->position }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- KANAN: DATA SEKOLAH -->
      <div class="col-lg-5">
        <div class="data-card">
          <h4 class="text-center mb-4 fw-bold">Data Sekolah</h4>
          <div class="row text-center mb-4">
            <div class="col-4 mt-3 mb-3">
              <div class="stat-number" data-target="{{ $statistik->total_teachers }}">0</div>
              <div class="stat-label">Guru & Staff</div>
            </div>
            <div class="col-4 mt-3 mb-3">
              <div class="stat-number" data-target="{{ $statistik->total_students }}">0</div>
              <div class="stat-label">Siswa</div>
            </div>
            <div class="col-4 mt-3 mb-3">
              <div class="stat-number" data-target="{{ $statistik->total_classes }}">0</div>
              <div class="stat-label">Rombel</div>
            </div>
          </div>
          <div class="d-flex justify-content-center gap-4">
            <a href="#about" class="btn-stat-outline">Tentang Kami</a>
            <a href="{{ route('profil.visi-misi') }}" class="btn-stat">Visi dan Misi</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif

@push('js')
<script>
  const counters = document.querySelectorAll('.stat-number');

  const runCounter = (counter) => {
    const target = +counter.getAttribute('data-target');
    let current = 0;
    const increment = target / 100;

    const updateCounter = () => {
      if (current < target) {
        current += increment;
        counter.innerText = Math.ceil(current);
        setTimeout(updateCounter, 20);
      } else {
        counter.innerText = target;
      }
    };

    updateCounter();
  };

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        runCounter(entry.target);
        obs.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5
  });

  counters.forEach(counter => {
    observer.observe(counter);
  });
</script>
@endpush
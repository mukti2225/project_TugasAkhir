@if($statistik)
  <div class="container statistik">
    <div class="row horizontal-card">

      <!-- KIRI: SAMBUTAN -->
      <div class="col-lg-7 mb-4 mb-lg-0">
        <div class="stats-card p-4 h-100">
          <h4 class="title mb-3">{{ $statistik->title }}</h4>

          <p class="desc">
            {!! Str::limit(strip_tags($statistik->sambutan), 250) ?? 'Sambutan belum tersedia.' !!}
          </p>

          <a href="{{ route('profil.sambutan') }}" class="link-sambutan">Sambutan Kepala Sekolah..</a>

          <div class="d-flex align-items-center mt-4">
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
        <div class="data-card p-4 h-100">
          <h4 class="text-center mb-4 fw-bold">Data Sekolah</h4>
          <div class="row text-center mb-4">
            <div class="col-4 mb-3">
              <div class="stat-number">{{ $statistik->total_teachers }}</div>
              <div class="stat-label">Guru & Staff</div>
            </div>
            <div class="col-4 mb-3">
              <div class="stat-number">{{ $statistik->total_students }}</div>
              <div class="stat-label">Siswa</div>
            </div>
            <div class="col-4 mb-3">
              <div class="stat-number">{{ $statistik->total_classes }}</div>
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
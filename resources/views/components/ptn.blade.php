@if($ptn->count() > 0)
<section class="ptn py-5">
    <div class="container">
      <div class="row g-4">

        <!-- TEKS -->
        <div class="col-lg-12 text-center">
          <h4 class="ptn-section">Prestasi</h4>
          <h1 class="ptn-judul">SISWA YANG DITERIMA PERGURUAN TINGGI</h1>
          <p class="ptn-desc mb-4">
            Lulusan SMA Arif Rahman Hakim yang berhasil diterima di berbagai Perguruan Tinggi Negeri (PTN) melalui berbagai jalur seleksi seperti SNBP, SNBT, dan jalur mandiri.
          </p>
        </div>

      <!-- CARD -->
      <div class="col-lg-12 mb-6 mb-lg-0">
        <div class="ptn-scroll">
          @foreach ($ptn as $ptn)
          <div class="ptn-item">
            <div class="card-ptn">
              <img src="{{ asset('storage/'.$ptn->foto) }}" alt="PTN">
              <div class="ptn-overlay">
                <img src="{{ asset('storage/'.$ptn->logo) }}" alt="">
                <h2>{{ $ptn->nama }}</h2>
                <h5>{{ $ptn->universitas }}</h5>
                <span>SNBP 2024</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif
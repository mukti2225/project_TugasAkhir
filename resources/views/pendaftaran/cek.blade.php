@extends('layouts.app', [
    'title' => 'Cek Status Pendaftaran',
])

@section('content')
<div class="spmb">
<div class="container py-5">

  <div class="row g-4">
    
    <!-- Sidebar -->
    @include('components.sidebar-spmb', [
      'infoText' => 'Masukkan Nomor Pendaftaran untuk melihat status secara real-time.'
    ])

    <!-- Main -->
    <div class="col-lg-9">

      <!-- HERO SEARCH CARD -->
      <div class="card spmb-hover border-0 shadow-sm mb-4">
        <div class="card-body p-4">

          <h5 class="fw-bold mb-3"> Cek Status Pendaftaran </h5>
          <p class="text-muted small mb-4"> Gunakan nomor pendaftaran yang Anda terima setelah melakukan pendaftaran. </p>

          <form action="{{ route('pendaftaran.cek.hasil') }}" method="POST">
            @csrf

            <div class="input-group">
              <span class="input-group-text bg-white border-end-0">
                <i class="bi bi-search"></i>
              </span>

              <input type="text"
                     name="nomor_pendaftaran"
                     class="form-control border-start-0 @error('nomor_pendaftaran') is-invalid @enderror"
                     placeholder="Contoh: SPMB-2026-000123"
                     value="{{ old('nomor_pendaftaran') }}">

              <button class="btn btn-primary px-4">
                Cari
              </button>
            </div>

            @error('nomor_pendaftaran')
              <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
          </form>

        </div>
      </div>

      <!-- RESULT -->
      @if(isset($pendaftaran))
      <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

          <!-- HEADER -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="fw-bold mb-0">{{ $pendaftaran->nama }}</h5>
              <small class="text-muted">{{ $pendaftaran->nomor_pendaftaran }}</small>
            </div>

            <!-- STATUS PENERIMAAN -->
            @php
              $status = $pendaftaran->status_penerimaan;
              $color = match($status) {
                  'Diterima' => 'success',
                  'Ditolak' => 'danger',
                  default => 'warning'
              };
            @endphp

            <span class="badge bg-{{ $color }} px-3 py-2 fs-6">
              {{ $status }}
            </span>
          </div>

          <!-- INFO GRID -->
          <div class="row g-3 mb-4">

            <div class="col-md-6">
              <div class="p-3 bg-light rounded">
                <small class="text-muted">Program Studi</small>
                <div class="fw-semibold">{{ $pendaftaran->program_studi }}</div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="p-3 bg-light rounded">
                <small class="text-muted">Email</small>
                <div class="fw-semibold">{{ $pendaftaran->email }}</div>
              </div>
            </div>

          </div>

          <!-- VERIFIKASI -->
          <div class="border-top pt-4">

            <h6 class="fw-bold mb-3">Verifikasi Berkas</h6>

            @php
              $verif = $pendaftaran->status_verifikasi;
              $verifColor = match($verif) {
                  'diverifikasi' => 'success',
                  'ditolak' => 'danger',
                  default => 'secondary'
              };
              $verifText = match($verif) {
                  'diverifikasi' => 'Berkas Valid',
                  'ditolak' => 'Berkas Ditolak',
                  default => 'Menunggu Verifikasi'
              };
            @endphp

            <div class="d-flex align-items-center justify-content-between mb-3">
              <span class="text-muted">Status</span>
              <span class="badge bg-{{ $verifColor }} px-3 py-2">
                {{ $verifText }}
              </span>
            </div>

            <!-- CATATAN -->
            @if($pendaftaran->status_verifikasi == 'ditolak' && $pendaftaran->catatan_verifikasi)
              <div class="alert alert-danger border-0 small">
                <strong>Catatan Admin:</strong><br>
                {{ $pendaftaran->catatan_verifikasi }}
              </div>
            @endif

          </div>

          <!-- ACTION -->
          @if($pendaftaran->status_verifikasi == 'ditolak')
          <div class="mt-4 text-end">
            <a href="{{ route('pendaftaran', $pendaftaran->nomor_pendaftaran) }}"
               class="btn btn-danger"> Upload Ulang Berkas </a>
          </div>
          @endif

        </div>
      </div>
      @endif

    </div>
  </div>
</div>

@push('css')
<style>
/* Modern Touch */
.card {
  border-radius: 14px;
}

.input-group-text {
  border-radius: 10px 0 0 10px;
}

.form-control {
  border-radius: 0 10px 10px 0;
}

.badge {
  font-weight: 500;
}

.bg-light {
  background-color: #f8f9fa !important;
}
</style>
@endpush
</div>
@endsection
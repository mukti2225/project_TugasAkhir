@extends('layouts.app', [
    'title' => 'Cek Pengumuman Pendaftaran',
])

@section('content')
<div class="container py-4">
  <div class="row g-4">
    
    <!-- Sidebar -->
    <div class="col-lg-3">
      <div class="list-group shadow-sm">
        <div class="list-group-item bg-primary text-white fw-bold border-0">LAMAN SPMB ONLINE</div>
        <a href="{{ route('pendaftaran') }}" class="list-group-item list-group-item-action border-start-0 border-end-0">
          <i class="bi bi-file-text me-2"></i>Pendaftaran
        </a>
        <a href="{{ route('pendaftaran.cek') }}" class="list-group-item list-group-item-action border-start-0 border-end-0">
          <i class="bi bi-search me-2"></i>Cek Pengumuman
        </a>
      </div>
      
      <!-- Info Card -->
      <div class="card bg-light mt-4 shadow-sm">
        <div class="card-body-spmb">
          <h6 class="fw-bold text-primary mb-2">
            <i class="bi bi-info-circle-fill me-1"></i> Informasi Penting
          </h6>
          <p class="small text-muted mb-0">
            Pastikan data yang diisi benar dan lengkap. Pendaftaran akan ditutup pada tanggal 30 November 2024.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
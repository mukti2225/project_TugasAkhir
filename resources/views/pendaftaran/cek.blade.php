@extends('layouts.app', [
    'title' => 'Cek Pengumuman Pendaftaran',
])

@section('content')
<div class="container py-4">
  <div class="row g-4">
    
    <!-- Sidebar -->
    @include('components.sidebar-spmb', [
      'infoText' => 'Masukkan Nomor Pendaftaran Anda untuk melihat status kelulusan/penerimaan secara Real-Time.'
    ])

    <!-- Main Content -->
    <div class="col-lg-9">
      <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
          <h5 class="judul-cek mb-0"><i class="bi bi-search me-2"></i> Cari Berdasarkan Nomor Pendaftaran</h5>
        </div>
        <div class="card-body-spmb">
          <form action="{{ route('pendaftaran.cek.hasil') }}" method="POST">
            @csrf
            <div class="row align-items-center g-3">
              <div class="col-md-9">
                <input type="text" 
                       name="nomor_pendaftaran" 
                       class="form-control form-control-lg @error('nomor_pendaftaran') is-invalid @enderror" 
                       placeholder="Masukkan Nomor Pendaftaran (misal: 12042005)" 
                       value="{{ old('nomor_pendaftaran') }}">
                @error('nomor_pendaftaran')
                  <div class="invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary sbtn-lg">
                  Cari Data
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Result Card -->
      @if(isset($pendaftaran))
        <div class="card shadow-sm border-0 bg-light">
          <div class="card-body-spmb p-4">
            <h5 class="fw-bold border-bottom pb-2 mb-4 text-center">Hasil Pencarian Peserta</h5>

            <div class="row mb-3">
              <div class="col-sm-4 text-muted">Nomor Pendaftaran</div>
              <div class="col-sm-8 fw-bold">{{ $pendaftaran->nomor_pendaftaran }}</div>
            </div>
            
            <div class="row mb-3">
              <div class="col-sm-4 text-muted">Nama Peserta</div>
              <div class="col-sm-8 fw-bold">{{ $pendaftaran->nama }}</div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-4 text-muted">Program Studi</div>
              <div class="col-sm-8 fw-bold">{{ $pendaftaran->program_studi }}</div>
            </div>

            <div class="row mt-4 pt-3 border-top">
              <div class="col-sm-4 text-muted mt-2">Status Penerimaan</div>
              <div class="col-sm-8">
                @if($pendaftaran->status_penerimaan == 'Menunggu')
                  <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                    <i class="bi bi-hourglass-split me-1"></i> Sedang Diproses (Menunggu)
                  </span>
                @elseif($pendaftaran->status_penerimaan == 'Diterima')
                  <span class="badge bg-success fs-6 py-2 px-3">
                    <i class="bi bi-check-circle-fill me-1"></i> Selamat, Anda Diterima!
                  </span>
                @elseif($pendaftaran->status_penerimaan == 'Ditolak')
                  <span class="badge bg-danger fs-6 py-2 px-3">
                    <i class="bi bi-x-circle-fill me-1"></i> Mohon Maaf, Anda Ditolak
                  </span>
                @else
                  <span class="badge bg-secondary fs-6 py-2 px-3">{{ $pendaftaran->status_penerimaan }}</span>
                @endif
              </div>
            </div>

          </div>
        </div>
      @endif

    </div>
  </div>
</div>

@push('css')
<link rel="stylesheet" href="{{ asset('css/pages/spmb.css') }}">
@endpush
@endsection
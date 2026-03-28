@extends('layouts.app', ['title' => 'Pendaftaran Berhasil'])

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                {{-- Header --}}
                <div class="card-header bg-white border-0 pb-0 justify-content-center pt-5">
                    <div class="text-center">
                        <div class="success-icon-wrapper mb-3">
                            <div class="success-circle mx-auto">
                                <i class="bi bi-check-lg text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold text-success mb-2">
                            Pendaftaran Berhasil!
                        </h4>
                        <div class="alert alert-success d-inline-block px-4 py-2 mb-0 rounded-pill">
                            <span class="small">Nomor Pendaftaran: </span>
                            <strong>{{  $pendaftaran->nomor_pendaftaran }}</strong>
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body text-center px-4 py-4">
                    <p class="text-muted mb-4">
                        Halo <strong>{{ $pendaftaran->nama }}</strong>, data pendaftaran Anda telah berhasil disimpan. Terima kasih telah mendaftar sebagai Peserta Didik Baru Tahun Ajaran <strong>2025/2026</strong>.
                    </p>

                    <div class="alert alert-info border-0 rounded-3 d-flex align-items-start gap-2 text-start mb-4" role="alert">
                        <i class="bi bi-info-circle-fill text-info mt-1 flex-shrink-0"></i>
                        <div>
                            <div class="fw-semibold small">Informasi Tambahan</div>
                            <p class="mb-0 small text-muted">
                                Harap simpan nomor pendaftaran Anda untuk melakukan Pengecekan Pengumuman kelulusan di halaman pengecekan.
                            </p>
                        </div>
                    </div>

                    {{-- <div class="bg-light rounded-3 p-3">
                        <p class="small text-muted mb-1">Butuh bantuan? Hubungi kami di:</p>
                        <p class="small fw-semibold mb-0 text-primary">
                            <i class="bi bi-telephone-fill me-1"></i>(021) 1234-5678
                            &nbsp;|&nbsp;
                            <i class="bi bi-whatsapp me-1"></i>0812-3456-7890
                        </p>
                    </div> --}}
                </div>

                {{-- Footer --}}
                <div class="card-footer bg-white border-0 justify-content-center pb-5 pt-2 d-flex flex-wrap gap-2">
                    <a href="{{ route('pendaftaran') }}" class="btn btn-outline-secondary px-4 rounded-3">
                        <i class="bi bi-house me-1"></i> Kembali
                    </a>
                    <a href="{{ route('pendaftaran.cek') }}" class="btn btn-primary px-4 rounded-3">
                        <i class="bi bi-search me-1"></i> Cek Pengumuman
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
.success-icon-wrapper {
  display: flex;
  justify-content: center;
}

.success-circle {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  background: linear-gradient(135deg, #28a745, #20c997);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 25px rgba(40, 167, 69, 0.35);
  animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}

@keyframes popIn {
  0%   { transform: scale(0); opacity: 0; }
  80%  { transform: scale(1.1); }
  100% { transform: scale(1); opacity: 1; }
}
</style>
@endpush

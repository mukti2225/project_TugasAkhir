{{-- resources/views/pendaftaran/verify-identity.blade.php --}}
@extends('layouts.app', [
    'title' => 'Verifikasi Identitas',
])

@section('content')
    <div class="spmb">
        <div class="container py-3">
            <div class="row g-4">

                <!-- Sidebar -->
                @include('components.sidebar-spmb', [
                    'infoText' => 'Masukkan NIK untuk membuktikan identitas Anda sebelum mengupload ulang berkas.',
                ])

                <!-- Content -->
                <div class="col-lg-9">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                        <!-- Header Gradient -->
                        <div class="px-4 py-4 text-center text-white"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25 p-3"
                                    style="width:64px;height:64px;">
                                    <i class="bi bi-shield-lock fs-2 text-white"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-2">VERIFIKASI IDENTITAS</h3>
                            <p class="mb-0 opacity-75">Konfirmasi identitas Anda untuk melanjutkan upload ulang berkas</p>
                        </div>

                        <div class="card-body p-4 p-md-5">

                            {{-- Alert info --}}
                            <div class="alert border-0 rounded-3 mb-4"
                                style="background: linear-gradient(135deg, #e0e7ff 0%, #f0e6ff 100%);">
                                <div class="d-flex gap-3 align-items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:36px;height:36px;background:linear-gradient(135deg,#667eea,#764ba2);">
                                            <i class="bi bi-info-lg text-white small"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <strong class="d-block mb-1" style="color:#4c3d8f;">Mengapa perlu
                                            verifikasi?</strong>
                                        <p class="mb-0 small text-muted">
                                            Karena sistem ini tidak menggunakan login, NIK digunakan untuk memastikan
                                            hanya pemilik pendaftaran yang dapat mengubah berkas.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('pendaftaran.verifikasi-identitas', $pendaftaran->nomor_pendaftaran) }}"
                                method="POST">
                                @csrf

                                {{-- Nomor Pendaftaran (readonly) --}}
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-muted small text-uppercase ls-1">
                                        <i class="bi bi-hash me-1"></i>Nomor Pendaftaran
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted">
                                            <i class="bi bi-card-text"></i>
                                        </span>
                                        <input type="text" class="form-control bg-light border-start-0 fw-semibold"
                                            value="{{ $pendaftaran->nomor_pendaftaran }}" readonly>
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-lock-fill text-muted small"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Nomor pendaftaran Anda yang diterima saat mendaftar.</div>
                                </div>

                                {{-- NIK --}}
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-muted small text-uppercase ls-1">
                                        <i class="bi bi-person-vcard me-1"></i>NIK <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-primary">
                                            <i class="bi bi-fingerprint fs-5"></i>
                                        </span>
                                        <input type="text" name="nik"
                                            class="form-control border-start-0 @error('nik') is-invalid @enderror"
                                            placeholder="Masukkan 16 digit NIK" maxlength="16" inputmode="numeric"
                                            pattern="\d{16}" autofocus value="{{ old('nik') }}">
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">NIK sesuai KTP/Kartu Keluarga yang terdaftar.</div>
                                </div>

                                {{-- Divider --}}
                                <hr class="my-4">

                                {{-- Buttons --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('pendaftaran.cek') }}" class="btn btn-outline-secondary px-4">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn px-5 py-2 fw-semibold text-white"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                             border: none; box-shadow: 0 4px 15px rgba(102,126,234,0.4);">
                                        <i class="bi bi-shield-check me-2"></i>Verifikasi Sekarang
                                    </button>
                                </div>

                            </form>
                        </div>

                        {{-- Footer card --}}
                        <div class="px-4 py-3 border-top text-center" style="background:#fafafa;">
                            <small class="text-muted">
                                <i class="bi bi-lock me-1"></i>
                                Data Anda aman. NIK hanya digunakan untuk verifikasi identitas, tidak disimpan ulang.
                            </small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nikInput = document.querySelector('input[name="nik"]');
                if (nikInput) {
                    // Hanya izinkan angka
                    nikInput.addEventListener('input', function() {
                        this.value = this.value.replace(/\D/g, '');
                    });

                    // Visual counter
                    nikInput.addEventListener('input', function() {
                        const len = this.value.length;
                        const isComplete = len === 16;
                        this.classList.toggle('border-success', isComplete);
                        this.classList.toggle('is-valid', isComplete);
                    });
                }
            });
        </script>
    @endpush
@endsection

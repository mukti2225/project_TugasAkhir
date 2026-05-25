@extends('layouts.app', [
    'title' => 'Cek Status Pendaftaran',
])

@section('content')
    <div class="spmb">
        <div class="container py-5">

            <div class="row g-4">

                <!-- Sidebar -->
                @include('components.sidebar-spmb', [
                    'infoText' => 'Masukkan Nomor Pendaftaran untuk melihat status secara real-time.',
                ])

                <!-- Main -->
                <div class="col-lg-9">

                    <!-- HERO SEARCH CARD -->
                    <div class="card search-card spmb-hover border-0 shadow-sm mb-4">
                        <div class="card-body p-4">

                            <h5 class="fw-bold mb-3"> Cek Status Pendaftaran </h5>
                            <p class="text-muted small mb-4"> Gunakan nomor pendaftaran yang Anda terima setelah melakukan
                                pendaftaran. </p>

                            <form action="{{ route('pendaftaran.cek.hasil') }}" method="POST">
                                @csrf

                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>

                                    <input type="text" name="nomor_pendaftaran"
                                        class="form-control border-start-0 @error('nomor_pendaftaran') is-invalid @enderror"
                                        placeholder="Contoh: SPMB-2026-000123" value="{{ old('nomor_pendaftaran') }}">

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
                    @if (isset($pendaftaran))
                        <div class="card result-card border-0 shadow-sm">

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
                                        $color = match ($status) {
                                            'Diterima' => 'success',
                                            'Ditolak' => 'danger',
                                            default => 'warning',
                                        };
                                    @endphp

                                    <span class="badge bg-{{ $color }} px-3 py-2 fs-6">
                                        {{ $status }}
                                    </span>
                                </div>

                                <!-- INFO GRID -->
                                <div class="row g-3 mb-4">

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <small>Program Studi</small>
                                            <div class="fw-semibold">{{ $pendaftaran->program_studi }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <small>Email</small>
                                            <div class="fw-semibold">{{ $pendaftaran->email }}</div>
                                        </div>
                                    </div>

                                </div>

                                <!-- VERIFIKASI -->
                                <div class="border-top pt-4 verif-section">

                                    <h6 class="fw-bold mb-3">Verifikasi Berkas</h6>

                                    @php
                                        $verif = $pendaftaran->status_verifikasi;
                                        $verifColor = match ($verif) {
                                            'diverifikasi' => 'success',
                                            'ditolak' => 'danger',
                                            default => 'secondary',
                                        };
                                        $verifText = match ($verif) {
                                            'diverifikasi' => 'Berkas Valid',
                                            'ditolak' => 'Berkas Ditolak',
                                            default => 'Menunggu Verifikasi',
                                        };
                                    @endphp

                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <span class="text-muted">Status</span>
                                        <span class="badge bg-{{ $verifColor }} px-3 py-2">
                                            {{ $verifText }}
                                        </span>
                                    </div>

                                    <!-- CATATAN -->
                                    @if ($pendaftaran->status_verifikasi == 'ditolak' && $pendaftaran->catatan_verifikasi)
                                        <div class="alert alert-danger border-0 small">
                                            <strong>Catatan Admin:</strong><br>
                                            {{ $pendaftaran->catatan_verifikasi }}
                                        </div>
                                    @endif

                                </div>

                                <!-- ACTION -->
                                @if ($pendaftaran->status_verifikasi == 'ditolak')
                                    <div class="mt-4 text-end">
                                        <a href="{{ route('pendaftaran.edit', $pendaftaran->nomor_pendaftaran) }}"
                                            class="btn btn-upload-ulang">
                                            <i class="bi bi-cloud-upload me-2"></i>Upload Ulang Berkas
                                        </a>
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
                /* ── Cek Status Page ── */

                /* Search Card */
                .spmb .search-card .card-body {
                    border-left: 3px solid #1d4ed8;
                }

                .spmb .search-card h5 {
                    font-size: var(--fs-md);
                    color: #1f2937;
                    letter-spacing: 0.2px;
                }

                /* Input Group Search */
                .spmb .input-group .input-group-text {
                    background: #fff;
                    border: 1px solid #d1d9e0;
                    border-right: none;
                    border-radius: 4px 0 0 4px;
                    color: #6b7280;
                }

                .spmb .input-group .form-control {
                    border: 1px solid #d1d9e0;
                    border-left: none;
                    border-right: none;
                    border-radius: 0;
                    padding-left: 0;
                }

                .spmb .input-group .form-control:focus {
                    border-color: #d1d9e0;
                    box-shadow: none;
                    z-index: 0;
                }

                .spmb .input-group .form-control:focus~.btn,
                .spmb .input-group:focus-within .input-group-text {
                    border-color: #1d4ed8;
                }

                .spmb .input-group:focus-within .input-group-text,
                .spmb .input-group:focus-within .form-control {
                    border-color: #1d4ed8;
                }

                .spmb .input-group .btn-primary {
                    border-radius: 0 4px 4px 0;
                }

                /* Result Card */
                .spmb .result-card {
                    border-top: 3px solid #1d4ed8;
                }

                /* Nama & Nomor Pendaftaran */
                .spmb .result-card h5 {
                    font-size: var(--fs-md);
                    color: #1f2937;
                }

                .spmb .result-card small.text-muted {
                    font-size: var(--fs-xs);
                    letter-spacing: 0.5px;
                    font-family: monospace;
                }

                /* Badge Status Penerimaan */
                .spmb .badge {
                    font-weight: 600;
                    font-size: var(--fs-xs) !important;
                    letter-spacing: 0.4px;
                    border-radius: 4px;
                    padding: 5px 10px !important;
                }

                .spmb .badge.bg-success {
                    background: linear-gradient(135deg, #038180 0%, #0369a1 100%) !important;
                }

                .spmb .badge.bg-danger {
                    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
                }

                .spmb .badge.bg-warning {
                    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
                    color: #fff !important;
                }

                .spmb .badge.bg-secondary {
                    background: linear-gradient(135deg, #64748b 0%, #475569 100%) !important;
                }

                /* Info Grid (Program Studi & Email) */
                .spmb .info-item {
                    background: linear-gradient(135deg, #f8faff 0%, #f0f7ff 100%);
                    border: 1px solid #e2e8f0;
                    border-radius: 4px;
                    padding: 12px 14px;
                }

                .spmb .info-item small {
                    font-size: var(--fs-xs);
                    color: #6b7280;
                    font-weight: 500;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    display: block;
                    margin-bottom: 3px;
                }

                .spmb .info-item .fw-semibold {
                    font-size: var(--fs-sm);
                    color: #1f2937;
                }

                /* Verifikasi Section */
                .spmb .verif-section h6 {
                    font-size: var(--fs-xs);
                    text-transform: uppercase;
                    letter-spacing: 0.8px;
                    color: #374151;
                    font-weight: 700;
                }

                .spmb .verif-section .status-label {
                    font-size: var(--fs-sm);
                    color: #6b7280;
                }

                /* Catatan Admin Alert */
                .spmb .alert-danger {
                    background: linear-gradient(90deg, #fef2f2 0%, #fff5f5 100%);
                    border-left: 3px solid #dc2626;
                    border-radius: 4px;
                    color: #7f1d1d;
                    font-size: var(--fs-xs);
                }

                /* Upload Ulang Button */
                .spmb .btn-upload-ulang {
                    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
                    border: none;
                    color: #fff;
                    font-size: var(--fs-sm);
                    font-weight: 600;
                    border-radius: 4px;
                    padding: 0.55rem 1.4rem;
                    letter-spacing: 0.2px;
                    transition: all 0.2s ease;
                }

                .spmb .btn-upload-ulang:hover {
                    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
                    box-shadow: 0 3px 10px rgba(220, 38, 38, 0.35);
                    transform: translateY(-1px);
                    color: #fff;
                }
            </style>
        @endpush
    </div>
@endsection

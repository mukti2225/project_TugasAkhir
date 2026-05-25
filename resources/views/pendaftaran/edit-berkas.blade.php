{{-- resources/views/pendaftaran/edit-berkas.blade.php --}}
@extends('layouts.app', [
    'title' => 'Upload Ulang Berkas',
])

@section('content')
    <div class="spmb">
        <div class="container py-3">
            <div class="row g-4">

                <!-- Sidebar -->
                @include('components.sidebar-spmb', [
                    'infoText' => 'Upload ulang berkas yang ditolak agar pendaftaran dapat diproses kembali.',
                ])

                <!-- Content -->
                <div class="col-lg-9">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                        <!-- Header Gradient — sama dengan form pendaftaran -->
                        <div class="px-4 py-4 text-center text-white"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <h3 class="fw-bold mb-2">UPLOAD ULANG BERKAS</h3>
                            <p class="mb-0 opacity-75">
                                {{ $pendaftaran->nama }} &mdash; {{ $pendaftaran->nomor_pendaftaran }}
                            </p>
                        </div>

                        <div class="card-body p-4 p-md-5">

                            {{-- Alasan Penolakan --}}
                            @if ($pendaftaran->catatan_verifikasi)
                                <div class="alert alert-danger border-0 rounded-3 mb-4">
                                    <div class="d-flex gap-3">
                                        <i class="bi bi-exclamation-triangle-fill fs-4 text-danger mt-1"></i>
                                        <div>
                                            <strong class="d-block mb-1">Alasan Penolakan Berkas:</strong>
                                            <p class="mb-0">{{ $pendaftaran->catatan_verifikasi }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Pesan Error Validasi --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 mb-4"
                                    role="alert">
                                    <div class="d-flex">
                                        <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                                        <div>
                                            <strong class="d-block mb-1">Terdapat kesalahan:</strong>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('pendaftaran.update-berkas', $pendaftaran->nomor_pendaftaran) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Section Header -->
                                <div class="section-header mb-4 pb-2 border-bottom">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="section-icon">
                                            <i class="bi bi-cloud-upload fs-3 text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold text-primary mb-0">BERKAS PERSYARATAN</h5>
                                            <p class="text-muted small mb-0">
                                                Upload ulang dokumen yang diperlukan (maks. 2MB, format: PDF/JPG/PNG)
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- ============ IJAZAH ============ --}}
                                <div class="upload-card border rounded-3 p-4 mb-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="upload-icon bg-primary bg-opacity-10 rounded-circle p-3 flex-shrink-0">
                                                    <i class="bi bi-file-text fs-3 text-primary"></i>
                                                </div>
                                                <div>
                                                    <label class="form-label fw-bold mb-1">
                                                        Ijazah / SKL <span class="text-danger">*</span>
                                                    </label>
                                                    <p class="text-muted small mb-0">Ijazah SMP/MTs atau SKL</p>
                                                    {{-- File saat ini --}}
                                                    @if ($pendaftaran->ijazah_file_name)
                                                        <p class="text-info small mb-0 mt-1">
                                                            <i class="bi bi-paperclip me-1"></i>
                                                            {{ $pendaftaran->ijazah_file_name }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <input type="file" name="ijazah_file" id="ijazah_file"
                                                accept=".pdf,.jpg,.jpeg,.png" style="display:none;">
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                                <button type="button" class="btn btn-primary px-4 py-2"
                                                    onclick="document.getElementById('ijazah_file').click()">
                                                    <i class="bi bi-cloud-upload me-2"></i>Pilih File
                                                </button>
                                                <div>
                                                    <div class="text-muted">
                                                        <i class="bi bi-file-earmark me-1"></i>
                                                        <span id="ijazah_file_name">Belum ada file dipilih</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upload-preview mt-3" id="ijazah_preview" style="display:none;">
                                                <div class="alert alert-success alert-dismissible fade show mb-0 py-2">
                                                    <i class="bi bi-check-circle-fill me-2"></i>
                                                    <span id="ijazah_preview_text"></span>
                                                    <button type="button" class="btn-close btn-sm"
                                                        onclick="removeFile('ijazah')"></button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                <i class="bi bi-info-circle me-1"></i>Format: PDF, JPG, PNG (Maks. 2MB)
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ============ KK ============ --}}
                                <div class="upload-card border rounded-3 p-4 mb-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="upload-icon bg-primary bg-opacity-10 rounded-circle p-3 flex-shrink-0">
                                                    <i class="bi bi-files fs-3 text-primary"></i>
                                                </div>
                                                <div>
                                                    <label class="form-label fw-bold mb-1">
                                                        Kartu Keluarga (KK) <span class="text-danger">*</span>
                                                    </label>
                                                    <p class="text-muted small mb-0">Kartu Keluarga yang masih berlaku</p>
                                                    @if ($pendaftaran->kk_file_name)
                                                        <p class="text-info small mb-0 mt-1">
                                                            <i class="bi bi-paperclip me-1"></i>
                                                            {{ $pendaftaran->kk_file_name }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <input type="file" name="kk_file" id="kk_file"
                                                accept=".pdf,.jpg,.jpeg,.png" style="display:none;">
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                                <button type="button" class="btn btn-primary px-4 py-2"
                                                    onclick="document.getElementById('kk_file').click()">
                                                    <i class="bi bi-cloud-upload me-2"></i>Pilih File
                                                </button>
                                                <div>
                                                    <div class="text-muted">
                                                        <i class="bi bi-file-earmark me-1"></i>
                                                        <span id="kk_file_name">Belum ada file dipilih</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upload-preview mt-3" id="kk_preview" style="display:none;">
                                                <div class="alert alert-success alert-dismissible fade show mb-0 py-2">
                                                    <i class="bi bi-check-circle-fill me-2"></i>
                                                    <span id="kk_preview_text"></span>
                                                    <button type="button" class="btn-close btn-sm"
                                                        onclick="removeFile('kk')"></button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                <i class="bi bi-info-circle me-1"></i>Format: PDF, JPG, PNG (Maks. 2MB)
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ============ AKTA ============ --}}
                                <div class="upload-card border rounded-3 p-4 mb-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-5 col-lg-4 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="upload-icon bg-primary bg-opacity-10 rounded-circle p-3 flex-shrink-0">
                                                    <i class="bi bi-file-earmark-text fs-3 text-primary"></i>
                                                </div>
                                                <div>
                                                    <label class="form-label fw-bold mb-1">
                                                        Akta Kelahiran <span class="text-danger">*</span>
                                                    </label>
                                                    <p class="text-muted small mb-0">Dari Dinas Kependudukan dan Catatan
                                                        Sipil</p>
                                                    @if ($pendaftaran->akta_file_name)
                                                        <p class="text-info small mb-0 mt-1">
                                                            <i class="bi bi-paperclip me-1"></i>
                                                            {{ $pendaftaran->akta_file_name }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-lg-8">
                                            <input type="file" name="akta_file" id="akta_file"
                                                accept=".pdf,.jpg,.jpeg,.png" style="display:none;">
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                                <button type="button" class="btn btn-primary px-4 py-2"
                                                    onclick="document.getElementById('akta_file').click()">
                                                    <i class="bi bi-cloud-upload me-2"></i>Pilih File
                                                </button>
                                                <div>
                                                    <div class="text-muted">
                                                        <i class="bi bi-file-earmark me-1"></i>
                                                        <span id="akta_file_name">Belum ada file dipilih</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="upload-preview mt-3" id="akta_preview" style="display:none;">
                                                <div class="alert alert-success alert-dismissible fade show mb-0 py-2">
                                                    <i class="bi bi-check-circle-fill me-2"></i>
                                                    <span id="akta_preview_text"></span>
                                                    <button type="button" class="btn-close btn-sm"
                                                        onclick="removeFile('akta')"></button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                <i class="bi bi-info-circle me-1"></i>Format: PDF, JPG, PNG (Maks. 2MB)
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Catatan --}}
                                <div class="alert alert-info border-0 bg-info bg-opacity-10 rounded-3 mb-4">
                                    <div class="d-flex gap-3">
                                        <i class="bi bi-info-circle-fill fs-4 text-info"></i>
                                        <div>
                                            <strong class="d-block mb-1">Catatan Penting:</strong>
                                            <ul class="mb-0 small ps-3">
                                                <li>Pastikan file yang diupload jelas dan terbaca</li>
                                                <li>File maksimal berukuran 2MB per dokumen</li>
                                                <li>Format file yang diperbolehkan: PDF, JPG, JPEG, PNG</li>
                                                <li>Minimal satu berkas harus diunggah ulang</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tombol --}}
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <a href="{{ route('pendaftaran.cek') }}" class="btn btn-outline-secondary px-4">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-danger px-5">
                                        <i class="bi bi-cloud-upload me-2"></i>Upload Ulang Berkas
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('js')
        <script>
            function handleFileUpload(inputId, fileType) {
                const input = document.getElementById(inputId);
                const file = input.files[0];
                if (!file) return false;

                const maxSize = 2 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert(`File ${fileType.toUpperCase()} terlalu besar. Maksimal 2MB!`);
                    input.value = '';
                    return false;
                }

                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    alert(`Format file tidak didukung. Gunakan PDF, JPG, atau PNG!`);
                    input.value = '';
                    return false;
                }

                const fileNameSpan = document.getElementById(`${fileType}_file_name`);
                const previewDiv = document.getElementById(`${fileType}_preview`);
                const previewText = document.getElementById(`${fileType}_preview_text`);

                if (fileNameSpan) {
                    fileNameSpan.textContent = file.name;
                    fileNameSpan.classList.add('text-success');
                }
                if (previewDiv && previewText) {
                    previewText.textContent = `${file.name} (${formatFileSize(file.size)}) siap diupload`;
                    previewDiv.style.display = 'block';
                }
                return true;
            }

            function removeFile(fileType) {
                const input = document.getElementById(`${fileType}_file`);
                const fileNameSpan = document.getElementById(`${fileType}_file_name`);
                const previewDiv = document.getElementById(`${fileType}_preview`);

                if (input) input.value = '';
                if (fileNameSpan) {
                    fileNameSpan.textContent = 'Belum ada file dipilih';
                    fileNameSpan.classList.remove('text-success');
                }
                if (previewDiv) previewDiv.style.display = 'none';
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            document.addEventListener('DOMContentLoaded', function() {
                ['ijazah', 'kk', 'akta'].forEach(function(type) {
                    const input = document.getElementById(`${type}_file`);
                    if (input) {
                        input.addEventListener('change', function() {
                            handleFileUpload(`${type}_file`, type);
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection

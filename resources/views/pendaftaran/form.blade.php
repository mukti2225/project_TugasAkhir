@extends('layouts.app', [
    'title' => 'Pendaftaran Peserta Didik Baru',
])

@section('content')
<div class="spmb">
<div class="container py-5">
  <div class="row g-4">
    
    <!-- Sidebar -->
    @include('components.sidebar-spmb', [
      'infoText' => 'Pastikan data yang diisi benar dan sesuai dokumen resmi.'
    ])

    <!-- Content -->
    <div class="col-lg-9">
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <!-- Header Gradient -->
        <div class="bg-gradient-primary px-4 py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
          <div class="text-center text-white">
            <h3 class="fw-bold mb-2">FORMULIR PENDAFTARAN</h3>
            <p class="mb-0 opacity-75">Peserta Didik Baru SMA ARH Tahun Ajaran 2025/2026</p>
          </div>
        </div>

        <div class="card-body p-4 p-md-5">
          
          <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
            @csrf
            
            <!-- Progress Steps -->
            <div class="mb-5">
              <div class="d-flex justify-content-between align-items-center">
                <div class="step-item active" data-step="1">
                  <div class="step-circle">1</div>
                  <div class="step-label">Data Diri</div>
                </div>
                <div class="step-line flex-grow-1"></div>
                <div class="step-item" data-step="2">
                  <div class="step-circle">2</div>
                  <div class="step-label">Tempat Tinggal</div>
                </div>
                <div class="step-line flex-grow-1"></div>
                <div class="step-item" data-step="3">
                  <div class="step-circle">3</div>
                  <div class="step-label">Pendidikan</div>
                </div>
                <div class="step-line flex-grow-1"></div>
                <div class="step-item" data-step="4">
                  <div class="step-circle">4</div>
                  <div class="step-label">Orang Tua</div>
                </div>
                <div class="step-line flex-grow-1"></div>
                <div class="step-item" data-step="5">
                  <div class="step-circle">5</div>
                  <div class="step-label">Unggah Dokumen</div>
                </div>
              </div>
            </div>

            <!-- Pesan Error Validasi -->
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert">
                <div class="d-flex">
                  <i class="bi bi-exclamation-triangle-fill me-3 fs-4"></i>
                  <div>
                    <strong class="d-block mb-1">Terdapat kesalahan dalam pengisian form:</strong>
                    <ul class="mb-0 ps-3">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <!-- SECTION 1 -->
            @include('components.form.section-data-diri')

            <!-- SECTION 2 -->
            @include('components.form.section-alamat')

            <!-- SECTION 3 -->
            @include('components.form.section-pendidikan')

            <!-- SECTION 4 -->
            @include('components.form.section-orang-tua')

            <!-- SECTION 5 -->
            @include('components.form.section-upload')

            <!-- Navigation Buttons -->
            <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
              <button type="button" class="btn btn-outline-secondary px-4" id="prevBtn" onclick="changeStep(-1)" style="display: none;">
                <i class="bi bi-arrow-left me-2"></i>Sebelumnya
              </button>
              <div class="ms-auto">
                <button type="button" class="btn btn-primary px-5" id="nextBtn" onclick="changeStep(1)">
                  Selanjutnya<i class="bi bi-arrow-right ms-2"></i>
                </button>
                <button type="submit" class="btn btn-success px-5" id="submitBtn" style="display: none;">
                  <i class="bi bi-send me-2"></i>Kirim Pendaftaran
                </button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>
</div>

@push ('js')
<script>
//Step Navigation
let currentStep = 1;
const totalSteps = 5;

function changeStep(direction) {
    const nextStep = currentStep + direction;

    // Batas langkah
    if (nextStep < 1 || nextStep > totalSteps) return;

    // Validasi sebelum lanjut
    if (direction === 1 && !validateSection(currentStep)) {
        return;
    }

    // Hide section lama
    document.querySelector(`[data-section="${currentStep}"]`).style.display =
        "none";

    // Update progress bar
    document
        .querySelector(`.step-item[data-step="${currentStep}"]`)
        .classList.remove("active");
    document
        .querySelector(`.step-item[data-step="${currentStep}"]`)
        .classList.add("completed");

    // Show section baru
    currentStep = nextStep;
    document.querySelector(`[data-section="${currentStep}"]`).style.display =
        "block";
    document
        .querySelector(`.step-item[data-step="${currentStep}"]`)
        .classList.add("active");

    // Update buttons
    updateButtons();
}

function validateSection(section) {
    const sectionElement = document.querySelector(
        `[data-section="${section}"]`,
    );
    const requiredFields = sectionElement.querySelectorAll("[required]");
    let isValid = true;

    requiredFields.forEach((field) => {
        if (!field.value.trim()) {
            field.classList.add("is-invalid");
            isValid = false;
        } else {
            field.classList.remove("is-invalid");
        }
    });

    if (!isValid) {
        // Scroll to first invalid field
        const firstInvalid = sectionElement.querySelector(".is-invalid");
        if (firstInvalid) {
            firstInvalid.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
            firstInvalid.focus();
        }

        // Show toast message
        showToast("Harap lengkapi semua field yang bertanda *", "error");
    }

    return isValid;
}

function updateButtons() {
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const submitBtn = document.getElementById("submitBtn");

    if (currentStep === 1) {
        prevBtn.style.display = "none";
    } else {
        prevBtn.style.display = "inline-flex";
    }

    if (currentStep === totalSteps) {
        nextBtn.style.display = "none";
        submitBtn.style.display = "inline-flex";
    } else {
        nextBtn.style.display = "inline-flex";
        submitBtn.style.display = "none";
    }
}

function showToast(message, type = "info") {
    // You can implement a toast notification here
    // For now, we'll use alert
    if (type === "error") {
        alert(message);
    }
}

//salin alamat
function salinAlamat(targetId, checkbox) {
    const alamatSiswa = document.getElementById("alamat");
    const targetTextarea = document.getElementById(targetId);

    if (!alamatSiswa || !targetTextarea) return;

    if (checkbox.checked) {
        targetTextarea.value = alamatSiswa.value;
        targetTextarea.setAttribute("readonly", true);
        targetTextarea.classList.add("bg-light");
    } else {
        targetTextarea.value = "";
        targetTextarea.removeAttribute("readonly");
        targetTextarea.classList.remove("bg-light");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const alamatSiswa = document.getElementById("alamat");
    const ids = ["alamat_ayah", "alamat_ibu", "alamat_wali"];

    if (alamatSiswa) {
        alamatSiswa.addEventListener("input", function () {
            ids.forEach((id) => {
                const checkbox = document.getElementById(id + "_sama");
                if (checkbox && checkbox.checked) {
                    document.getElementById(id).value = this.value;
                }
            });
        });
    }

    // Initialize step items
    document.querySelectorAll(".step-item").forEach((item, index) => {
        item.setAttribute("data-step", index + 1);
    });
});

// File Upload Handling
function handleFileUpload(inputId, fileType) {
    const input = document.getElementById(inputId);
    const file = input.files[0];

    if (file) {
        // Validasi ukuran file (2MB)
        const maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
            showToast(
                `File ${fileType.toUpperCase()} terlalu besar. Maksimal 2MB!`,
                "error",
            );
            input.value = "";
            return false;
        }

        // Validasi tipe file
        const allowedTypes = [
            "application/pdf",
            "image/jpeg",
            "image/jpg",
            "image/png",
        ];
        if (!allowedTypes.includes(file.type)) {
            showToast(
                `Format file ${fileType.toUpperCase()} tidak didukung. Gunakan PDF, JPG, JPEG, atau PNG!`,
                "error",
            );
            input.value = "";
            return false;
        }

        // Update tampilan preview
        const fileNameSpan = document.getElementById(`${fileType}_file_name`);
        const previewDiv = document.getElementById(`${fileType}_preview`);
        const previewText = document.getElementById(`${fileType}_preview_text`);

        if (fileNameSpan) {
            fileNameSpan.textContent = file.name;
            fileNameSpan.classList.add("text-success");
        }

        if (previewDiv && previewText) {
            previewText.textContent = `File ${file.name} (${formatFileSize(file.size)}) berhasil diupload`;
            previewDiv.style.display = "block";
        }

        return true;
    }
    return false;
}

function removeFile(fileType) {
    const input = document.getElementById(`${fileType}_file`);
    const fileNameSpan = document.getElementById(`${fileType}_file_name`);
    const previewDiv = document.getElementById(`${fileType}_preview`);

    if (input) input.value = "";
    if (fileNameSpan) {
        fileNameSpan.textContent = "Belum ada file dipilih";
        fileNameSpan.classList.remove("text-success");
    }
    if (previewDiv) previewDiv.style.display = "none";
}

function formatFileSize(bytes) {
    if (bytes === 0) return "0 Bytes";
    const k = 1024;
    const sizes = ["Bytes", "KB", "MB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
}

// Event listeners untuk upload file
document.addEventListener("DOMContentLoaded", function () {
    // Ijazah file
    const ijazahInput = document.getElementById("ijazah_file");
    if (ijazahInput) {
        ijazahInput.addEventListener("change", function () {
            handleFileUpload("ijazah_file", "ijazah");
        });
    }

    // KK file
    const kkInput = document.getElementById("kk_file");
    if (kkInput) {
        kkInput.addEventListener("change", function () {
            handleFileUpload("kk_file", "kk");
        });
    }

    // Akta file
    const aktaInput = document.getElementById("akta_file");
    if (aktaInput) {
        aktaInput.addEventListener("change", function () {
            handleFileUpload("akta_file", "akta");
        });
    }
});

// Update validateSection function untuk mengecek file upload
function validateSection(section) {
    const sectionElement = document.querySelector(
        `[data-section="${section}"]`,
    );

    // Untuk section 5 (upload), validasi file
    if (section == 5) {
        const ijazahFile = document.getElementById("ijazah_file");
        const kkFile = document.getElementById("kk_file");
        const aktaFile = document.getElementById("akta_file");

        let isValid = true;

        if (!ijazahFile || !ijazahFile.files || ijazahFile.files.length === 0) {
            showToast("Harap upload file Ijazah/SKL", "error");
            isValid = false;
        }

        if (!kkFile || !kkFile.files || kkFile.files.length === 0) {
            showToast("Harap upload file Kartu Keluarga (KK)", "error");
            isValid = false;
        }

        if (!aktaFile || !aktaFile.files || aktaFile.files.length === 0) {
            showToast("Harap upload file Akta Kelahiran", "error");
            isValid = false;
        }

        return isValid;
    }

    // Validasi biasa untuk section lain
    const requiredFields = sectionElement.querySelectorAll("[required]");
    let isValid = true;

    requiredFields.forEach((field) => {
        if (!field.value.trim()) {
            field.classList.add("is-invalid");
            isValid = false;
        } else {
            field.classList.remove("is-invalid");
        }
    });

    if (!isValid) {
        const firstInvalid = sectionElement.querySelector(".is-invalid");
        if (firstInvalid) {
            firstInvalid.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
            firstInvalid.focus();
        }
        showToast("Harap lengkapi semua field yang bertanda *", "error");
    }

    return isValid;
}
</script>
@endpush
@endsection
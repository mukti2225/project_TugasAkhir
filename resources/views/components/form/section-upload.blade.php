<!-- Section 5: Unggah Berkas -->
<div class="form-section" data-section="5" style="display: none;">
  <div class="section-header mb-4 pb-2 border-bottom">
    <div class="d-flex align-items-center gap-3">
      <div class="section-icon">
        <i class="bi bi-cloud-upload fs-3 text-primary"></i>
      </div>
      <div>
        <h5 class="fw-bold text-primary mb-0">UNGGAH BERKAS PERSYARATAN</h5>
        <p class="text-muted small mb-0">Upload dokumen yang diperlukan (maksimal 2MB per file, format: PDF/JPG/PNG)</p>
      </div>
    </div>
  </div>
  
  <!-- Ijazah / SKL -->
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="upload-card border rounded-3 p-4">
        <div class="row align-items-center">
          <!-- Kolom Kiri: Icon, Title, dan Deskripsi -->
          <div class="col-md-5 col-lg-4 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-3">
              <div class="upload-icon bg-primary bg-opacity-10 rounded-circle p-3 flex-shrink-0">
                <i class="bi bi-file-text fs-3 text-primary"></i>
              </div>
              <div>
                <label class="form-label fw-bold mb-1">
                  Ijazah / SKL <span class="text-danger">*</span>
                </label>
                <p class="text-muted small mb-0">Ijazah SMP/MTs atau Surat Keterangan Lulus (SKL)</p>
              </div>
            </div>
          </div>
          
          <!-- Kolom Kanan: Tombol Upload dan Info File -->
          <div class="col-md-7 col-lg-8">
            <div class="upload-wrapper">
              <input type="file" name="ijazah_file" id="ijazah_file" class="upload-input" accept=".pdf,.jpg,.jpeg,.png" style="display: none;" required>
              <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                <button type="button" class="btn btn-primary upload-btn px-4 py-2" onclick="document.getElementById('ijazah_file').click()">
                  <i class="bi bi-cloud-upload me-2"></i>Pilih File
                </button>
                <div class="file-status" id="ijazah_status">
                  <div class="file-indicator text-muted">
                    <i class="bi bi-file-earmark me-1"></i>
                    <span id="ijazah_file_name">Belum ada file dipilih</span>
                  </div>
                  <div class="file-size-indicator text-muted small" id="ijazah_file_size"></div>
                </div>
              </div>
              <div class="upload-preview mt-3" id="ijazah_preview" style="display: none;">
                <div class="alert alert-success alert-dismissible fade show mb-0 py-2">
                  <i class="bi bi-check-circle-fill me-2"></i>
                  <span id="ijazah_preview_text"></span>
                  <button type="button" class="btn-close btn-sm" onclick="removeFile('ijazah')"></button>
                </div>
              </div>
              <div class="form-text mt-2">
                <i class="bi bi-info-circle me-1"></i>
                Format: PDF, JPG, PNG (Maks. 2MB)
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Kartu Keluarga (KK) -->
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="upload-card border rounded-3 p-4">
        <div class="row align-items-center">
          <!-- Kolom Kiri: Icon, Title, dan Deskripsi -->
          <div class="col-md-5 col-lg-4 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-3">
              <div class="upload-icon bg-primary bg-opacity-10 rounded-circle p-3 flex-shrink-0">
                <i class="bi bi-files fs-3 text-primary"></i>
              </div>
              <div>
                <label class="form-label fw-bold mb-1">
                  Kartu Keluarga (KK) <span class="text-danger">*</span>
                </label>
                <p class="text-muted small mb-0">Kartu Keluarga yang masih berlaku</p>
              </div>
            </div>
          </div>
          
          <!-- Kolom Kanan: Tombol Upload dan Info File -->
          <div class="col-md-7 col-lg-8">
            <div class="upload-wrapper">
              <input type="file" name="kk_file" id="kk_file" class="upload-input" accept=".pdf,.jpg,.jpeg,.png" style="display: none;" required>
              <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                <button type="button" class="btn btn-primary upload-btn px-4 py-2" onclick="document.getElementById('kk_file').click()">
                  <i class="bi bi-cloud-upload me-2"></i>Pilih File
                </button>
                <div class="file-status" id="kk_status">
                  <div class="file-indicator text-muted">
                    <i class="bi bi-file-earmark me-1"></i>
                    <span id="kk_file_name">Belum ada file dipilih</span>
                  </div>
                  <div class="file-size-indicator text-muted small" id="kk_file_size"></div>
                </div>
              </div>
              <div class="upload-preview mt-3" id="kk_preview" style="display: none;">
                <div class="alert alert-success alert-dismissible fade show mb-0 py-2">
                  <i class="bi bi-check-circle-fill me-2"></i>
                  <span id="kk_preview_text"></span>
                  <button type="button" class="btn-close btn-sm" onclick="removeFile('kk')"></button>
                </div>
              </div>
              <div class="form-text mt-2">
                <i class="bi bi-info-circle me-1"></i>
                Format: PDF, JPG, PNG (Maks. 2MB)
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Akta Kelahiran -->
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="upload-card border rounded-3 p-4">
        <div class="row align-items-center">
          <!-- Kolom Kiri: Icon, Title, dan Deskripsi -->
          <div class="col-md-5 col-lg-4 mb-3 mb-md-0">
            <div class="d-flex align-items-center gap-3">
              <div class="upload-icon bg-primary bg-opacity-10 rounded-circle p-3 flex-shrink-0">
                <i class="bi bi-file-earmark-text fs-3 text-primary"></i>
              </div>
              <div>
                <label class="form-label fw-bold mb-1">
                  Akta Kelahiran <span class="text-danger">*</span>
                </label>
                <p class="text-muted small mb-0">Akta kelahiran dari Dinas Kependudukan dan Catatan Sipil</p>
              </div>
            </div>
          </div>
          
          <!-- Kolom Kanan: Tombol Upload dan Info File -->
          <div class="col-md-7 col-lg-8">
            <div class="upload-wrapper">
              <input type="file" name="akta_file" id="akta_file" class="upload-input" accept=".pdf,.jpg,.jpeg,.png" style="display: none;" required>
              <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                <button type="button" class="btn btn-primary upload-btn px-4 py-2" onclick="document.getElementById('akta_file').click()">
                  <i class="bi bi-cloud-upload me-2"></i>Pilih File
                </button>
                <div class="file-status" id="akta_status">
                  <div class="file-indicator text-muted">
                    <i class="bi bi-file-earmark me-1"></i>
                    <span id="akta_file_name">Belum ada file dipilih</span>
                  </div>
                  <div class="file-size-indicator text-muted small" id="akta_file_size"></div>
                </div>
              </div>
              <div class="upload-preview mt-3" id="akta_preview" style="display: none;">
                <div class="alert alert-success alert-dismissible fade show mb-0 py-2">
                  <i class="bi bi-check-circle-fill me-2"></i>
                  <span id="akta_preview_text"></span>
                  <button type="button" class="btn-close btn-sm" onclick="removeFile('akta')"></button>
                </div>
              </div>
              <div class="form-text mt-2">
                <i class="bi bi-info-circle me-1"></i>
                Format: PDF, JPG, PNG (Maks. 2MB)
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Catatan Penting -->
  <div class="alert alert-info border-0 bg-info bg-opacity-10 rounded-3 mt-4">
    <div class="d-flex gap-3">
      <i class="bi bi-info-circle-fill fs-4 text-info"></i>
      <div>
        <strong class="d-block mb-1">Catatan Penting:</strong>
        <ul class="mb-0 small ps-3">
          <li>Pastikan file yang diupload jelas dan terbaca</li>
          <li>File maksimal berukuran 2MB per dokumen</li>
          <li>Format file yang diperbolehkan: PDF, JPG, JPEG, PNG</li>
          <li>Nama file disarankan menggunakan format: [JenisDokumen]_[NamaLengkap] (contoh: Ijazah_BudiSantoso.pdf)</li>
        </ul>
      </div>
    </div>
  </div>
</div>
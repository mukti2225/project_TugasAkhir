            <!-- Section 1: Data Diri Siswa -->
            <div class="form-section" data-section="1">
              <div class="section-header mb-4 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                  <div class="section-icon">
                    <i class="bi bi-person-badge fs-3 text-primary"></i>
                  </div>
                  <div>
                    <h5 class="fw-bold text-primary mb-0">KETERANGAN DATA DIRI SISWA</h5>
                    <p class="text-muted small mb-0">Informasi identitas lengkap calon siswa</p>
                  </div>
                </div>
              </div>
              
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">
                    Nama Lengkap <span class="text-danger">*</span>
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                    <input type="text" name="nama" class="form-control border-start-0 ps-0" placeholder="Masukkan nama lengkap" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">
                    NIK <span class="text-danger">*</span>
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-card-text text-muted"></i></span>
                    <input type="text" name="nik" class="form-control border-start-0 ps-0 @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="16 digit angka" minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus persis 16 digit angka" required>
                  </div>
                  @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-12">
                  <label class="form-label fw-semibold">
                    Email Aktif <span class="text-danger">*</span>
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="namaemail@gmail.com" required>
                  </div>
                  <div class="form-text mt-2">
                    <i class="bi bi-info-circle text-primary me-1"></i>
                    Email akan digunakan untuk mengirim Nomor Pendaftaran. Pastikan aktif dan bisa dibuka.
                  </div>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                  <input type="text" name="tempat_lahir" class="form-control" placeholder="Contoh: Jakarta" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                  <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                  <select name="agama" class="form-select" required>
                    <option value="">-- Pilih Agama --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                  </select>
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Anak Ke- <span class="text-danger">*</span></label>
                  <input type="number" name="anak" class="form-control" placeholder="Contoh: 2" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Status Anak <span class="text-danger">*</span></label>
                  <select name="status" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option>Kandung</option>
                    <option>Angkat</option>
                  </select>
                </div>
              </div>
            </div>
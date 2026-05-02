            <!-- Section 2: Tempat Tinggal -->
            <div class="form-section" data-section="2" style="display: none;">
              <div class="section-header mb-4 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                  <div class="section-icon">
                    <i class="bi bi-house-door fs-3 text-primary"></i>
                  </div>
                  <div>
                    <h5 class="fw-bold text-primary mb-0">KETERANGAN TEMPAT TINGGAL SISWA</h5>
                    <p class="text-muted small mb-0">Informasi alamat dan kontak siswa</p>
                  </div>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nomor Telepon Siswa <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-whatsapp text-muted"></i></span>
                    <input type="number" name="nomor_telepon_siswa" class="form-control border-start-0 ps-0" placeholder="081234567890" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nomor Telepon Rumah</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                    <input type="number" name="nomor_telepon" class="form-control border-start-0 ps-0" placeholder="02112345678">
                  </div>
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tinggal Dengan <span class="text-danger">*</span></label>
                  <select name="tinggal" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option>Orang Tua</option>
                    <option>Saudara</option>
                    <option>Wali</option>
                    <option>Kost</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Jarak ke Sekolah <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="text" name="jarak_sekolah" class="form-control" placeholder="2 km" required>
                    <span class="input-group-text bg-light">km</span>
                  </div>
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-12">
                  <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                  <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota" required></textarea>
                </div>
              </div>
            </div>
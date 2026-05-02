            <!-- Section 3: Pendidikan Sebelumnya -->
            <div class="form-section" data-section="3" style="display: none;">
              <div class="section-header mb-4 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-3">
                  <div class="section-icon">
                    <i class="bi bi-mortarboard fs-3 text-primary"></i>
                  </div>
                  <div>
                    <h5 class="fw-bold text-primary mb-0">KETERANGAN PENDIDIKAN SEBELUMNYA</h5>
                    <p class="text-muted small mb-0">Informasi sekolah asal dan akademik</p>
                  </div>
                </div>
              </div>
              
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
                  <select name="pendidikan" class="form-select" required>
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="SD">SD</option>
                    <option value="MI">MI</option>
                    <option value="SMP">SMP</option>
                    <option value="MTS">MTS</option>
                    <option value="Paket A/B">Paket A/B</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">NISN <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-123 text-muted"></i></span>
                    <input type="text" name="nisn" class="form-control border-start-0 ps-0 @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" placeholder="10 digit angka" minlength="10" maxlength="10" pattern="\d{10}" title="NISN harus persis 10 digit angka" required>
                  </div>
                  @error('nisn')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">No Ijazah <span class="text-danger">*</span></label>
                  <input type="text" name="ijazah" class="form-control" placeholder="1234567890" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Asal Sekolah <span class="text-danger">*</span></label>
                  <input type="text" name="asal_sekolah" class="form-control" placeholder="SMP Negeri 1 Tangerang" required>
                </div>
              </div>

              <div class="row g-4 mt-2">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Alasan Pindahan (Jika Pindahan)</label>
                  <input type="text" name="pindahan" class="form-control" placeholder="Alasan pindah sekolah">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Program Studi Pilihan <span class="text-danger">*</span></label>
                  <select name="program_studi" class="form-select" required>
                    <option value="">-- Pilih Program Studi --</option>
                    <option>IPA</option>
                    <option>IPS</option>
                    <option>BAHASA</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- Section 4: Orang Tua & Wali -->
            <div class="form-section" data-section="4" style="display: none;">
              <!-- Data Ayah -->
              <div class="mb-5">
                <div class="section-header mb-4 pb-2 border-bottom">
                  <div class="d-flex align-items-center gap-3">
                    <div class="section-icon">
                      <i class="bi bi-person-circle fs-3 text-primary"></i>
                    </div>
                    <div>
                      <h5 class="fw-bold text-primary mb-0">KETERANGAN AYAH KANDUNG</h5>
                      <p class="text-muted small mb-0">Informasi data orang tua (Ayah)</p>
                    </div>
                  </div>
                </div>

                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ayah" class="form-control" placeholder="Masukkan nama ayah" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir_ayah" class="form-control" placeholder="Jakarta" required>
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir_ayah" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                    <select name="agama_ayah" class="form-select" required>
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
                    <label class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
                    <select name="pendidikan_ayah" class="form-select" required>
                      <option value="">-- Pilih Pendidikan --</option>
                      <option>SD/Sederajat</option>
                      <option>SMP/Sederajat</option>
                      <option>SMA/Sederajat</option>
                      <option>D3</option>
                      <option>S1</option>
                      <option>S2</option>
                      <option>S3</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Pekerjaan <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ayah" class="form-control" placeholder="PNS, Swasta, Wiraswasta" required>
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Penghasilan <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text bg-light">Rp</span>
                      <input type="number" name="penghasilan_ayah" class="form-control" placeholder="5000000" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                    <input type="number" name="nomor_telepon_ayah" class="form-control" placeholder="081234567890" required>
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-12">
                    <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="alamat_ayah_sama" onchange="salinAlamat('alamat_ayah', this)">
                      <label class="form-check-label text-muted" for="alamat_ayah_sama"> Sama dengan alamat siswa
                      </label>
                    </div>
                    <textarea name="alamat_ayah" id="alamat_ayah" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota" required></textarea>
                  </div>
                </div>
              </div>

              <!-- Data Ibu -->
              <div class="mb-5">
                <div class="section-header mb-4 pb-2 border-bottom">
                  <div class="d-flex align-items-center gap-3">
                    <div class="section-icon">
                      <i class="bi bi-person-circle fs-3 text-primary"></i>
                    </div>
                    <div>
                      <h5 class="fw-bold text-primary mb-0">KETERANGAN IBU KANDUNG</h5>
                      <p class="text-muted small mb-0">Informasi data orang tua (Ibu)</p>
                    </div>
                  </div>
                </div>

                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ibu" class="form-control" placeholder="Masukkan nama ibu" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir_ibu" class="form-control" placeholder="Jakarta" required>
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir_ibu" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                    <select name="agama_ibu" class="form-select" required>
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
                    <label class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
                    <select name="pendidikan_ibu" class="form-select" required>
                      <option value="">-- Pilih Pendidikan --</option>
                      <option>SD/Sederajat</option>
                      <option>SMP/Sederajat</option>
                      <option>SMA/Sederajat</option>
                      <option>D3</option>
                      <option>S1</option>
                      <option>S2</option>
                      <option>S3</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Pekerjaan <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ibu" class="form-control" placeholder="PNS, Swasta, Wiraswasta" required>
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Penghasilan <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text bg-light">Rp</span>
                      <input type="number" name="penghasilan_ibu" class="form-control" placeholder="5000000" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                    <input type="number" name="nomor_telepon_ibu" class="form-control" placeholder="081234567890" required>
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-12">
                    <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="alamat_ibu_sama" onchange="salinAlamat('alamat_ibu', this)">
                      <label class="form-check-label text-muted" for="alamat_ibu_sama"> Sama dengan alamat siswa
                      </label>
                    </div>
                    <textarea name="alamat_ibu" id="alamat_ibu" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota" required></textarea>
                  </div>
                </div>
              </div>

              <!-- Data Wali -->
              <div>
                <div class="section-header mb-4 pb-2 border-bottom">
                  <div class="d-flex align-items-center gap-3">
                    <div class="section-icon">
                      <i class="bi bi-people fs-3 text-primary"></i>
                    </div>
                    <div>
                      <h5 class="fw-bold text-primary mb-0">KETERANGAN WALI</h5>
                      <p class="text-muted small mb-0">Informasi wali (jika ada)</p>
                    </div>
                  </div>
                </div>

                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" placeholder="Masukkan nama wali">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir_wali" class="form-control" placeholder="Jakarta">
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir_wali" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Agama</label>
                    <select name="agama_wali" class="form-select">
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
                    <label class="form-label fw-semibold">Pendidikan Terakhir</label>
                    <select name="pendidikan_wali" class="form-select">
                      <option value="">-- Pilih Pendidikan --</option>
                      <option>SD/Sederajat</option>
                      <option>SMP/Sederajat</option>
                      <option>SMA/Sederajat</option>
                      <option>D3</option>
                      <option>S1</option>
                      <option>S2</option>
                      <option>S3</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Pekerjaan</label>
                    <input type="text" name="pekerjaan_wali" class="form-control" placeholder="PNS, Swasta, Wiraswasta">
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Penghasilan</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light">Rp</span>
                      <input type="number" name="penghasilan_wali" class="form-control" placeholder="5000000">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="number" name="nomor_telepon_wali" class="form-control" placeholder="081234567890">
                  </div>
                </div>

                <div class="row g-4 mt-2">
                  <div class="col-12">
                    <label class="form-label fw-semibold">Alamat Lengkap</label>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="alamat_wali_sama" onchange="salinAlamat('alamat_wali', this)">
                      <label class="form-check-label text-muted" for="alamat_wali_sama"> Sama dengan alamat siswa
                      </label>
                    </div>
                    <textarea name="alamat_wali" id="alamat_wali" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota"></textarea>
                  </div>
                </div>
              </div>
            </div>
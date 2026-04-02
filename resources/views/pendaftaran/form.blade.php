@extends('layouts.app', [
    'title' => 'Pendaftaran Peserta Didik Baru',
])

@section('content')
<div class="container py-4">
  <div class="row g-4">
    
    <!-- Sidebar -->
    @include('components.sidebar-spmb', [
      'infoText' => 'Isi custom di sini'
    ])

    <!-- Content -->
    <div class="col-lg-9">
      <div class="card shadow-sm border-0">
        <div class="card-body-spmb p-3 p-md-5">

          <form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf
            
            <!-- Header Form -->
            <div class="text-center mb-4">
              <h4 class="fw-bold text-primary mb-2">FORMULIR PENDAFTARAN</h4>
              <p class="text-muted small">Peserta Didik Baru SMA ARH Tahun Ajaran 2025/2026</p>
              <hr class="my-4">
            </div>

            <!-- Tampilkan Pesan Error Validasi -->
            @if ($errors->any())
              <div class="alert alert-danger shadow-sm rounded-3">
                <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat kesalahan:</div>
                <ul class="mb-0 small">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- KETERANGAN DATA DIRI SISWA -->
            <div class="mb-4">
              <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-person-fill me-2"></i>KETERANGAN DATA DIRI SISWA
              </h5>
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                  <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="16 digit angka" minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus persis 16 digit angka" required>
                  @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-12">
                  <label class="form-label fw-semibold">Email Aktif <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Contoh: namaemail@gmail.com" required>
                  <div class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i>Email ini akan digunakan untuk mengirim Nomor Pendaftaran. Pastikan aktif dan bisa dibuka.</div>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                  <input type="text" name="tempat_lahir" class="form-control" placeholder="Contoh: Jakarta" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
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
                    <option value="">-- Pilih --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                  </select>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Anak Ke- <span class="text-danger">*</span></label>
                  <input type="number" name="anak" class="form-control" placeholder="Contoh: 2" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Status anak <span class="text-danger">*</span></label>
                  <select name="status" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option>Kandung</option>
                    <option>Angkat</option>
                  </select>
                </div>
              </div>

            </div>

            <hr class="my-4">

            <div class="mb-4">
              <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-house-fill me-2"></i>KETERANGAN TEMPAT TINGGAL SISWA
              </h5>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nomor Telpon Siswa <span class="text-danger">*</span></label>
                  <input type="number" name="nomor_telepon_siswa" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nomor Telpon Rumah</label>
                  <input type="number" name="nomor_telepon" class="form-control" placeholder="Contoh: 02112345678">
                </div>
              </div>

               <div class="row g-3 mt-1">
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
                  <input type="text" name="jarak_sekolah" class="form-control" placeholder="Contoh: 2km" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-12">
                  <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                  <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota" required></textarea>
                </div>
              </div>
            </div>

            <hr class="my-4">
            
             <!-- Data Pendidikan sebelumnya -->
            <div class="mb-4">
              <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2"></i>KETERANGAN PENDIDIKAN SEBELUMNYA
              </h5>
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Pendidikan terakhir <span class="text-danger">*</span></label>
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
                  <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" placeholder="10 digit angka" minlength="10" maxlength="10" pattern="\d{10}" title="NISN harus persis 10 digit angka" required>
                  @error('nisn')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">No Ijazah <span class="text-danger">*</span></label>
                  <input type="text" name="ijazah" class="form-control" placeholder="Contoh: 1234567890" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Asal Sekolah <span class="text-danger">*</span></label>
                  <input type="text" name="asal_sekolah" class="form-control" placeholder="Contoh: SMP Negeri 1 Tangerang" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Alasan Pindahan (Pindahan) </label>
                   <input type="text" name="pindahan" class="form-control" placeholder="">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Program Studi Pilihan <span class="text-danger">*</span></label>
                  <select name="program_studi" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option>IPA</option>
                    <option>IPS</option>
                    <option>BAHASA</option>
                  </select>
                </div>
              </div>
            </div>

            <hr class="my-4">

            <!-- Data Ayah -->
            <div class="mb-4">
              <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-people-fill me-2"></i>KETERANGAN AYAH KANDUNG
              </h5>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nama Ayah <span class="text-danger">*</span></label>
                  <input type="text" name="nama_ayah" class="form-control" placeholder="Masukkan nama ayah" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tempat lahir <span class="text-danger">*</span></label>
                  <input type="text" name="tempat_lahir_ayah" class="form-control" placeholder="Contoh: Jakarta" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" name="tanggal_lahir_ayah" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                  <select name="agama_ayah" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                  </select>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
                  <select name="pendidikan_ayah" class="form-select" required>
                    <option value="">-- Pilih --</option>
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
                  <input type="text" name="pekerjaan_ayah" class="form-control" placeholder="Contoh: PNS, Swasta, Wiraswasta" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Penghasilan <span class="text-danger">*</span></label>
                  <input type="number" name="penghasilan_ayah" class="form-control" placeholder="Contoh: 5000000" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                  <input type="number" name="nomor_telepon_ayah" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-12">
                  <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="alamat_ayah_sama" onchange="salinAlamat('alamat_ayah', this)">
                    <label class="form-check-label text-muted small" for="alamat_ayah_sama">
                     Sama dengan alamat siswa
                    </label>
                  </div>
                  <textarea name="alamat_ayah" id="alamat_ayah" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota" required></textarea>
                </div>
              </div>
            </div>

            <hr class="my-4">

            <!-- Data Ibu -->
            <div class="mb-4">
              <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-people-fill me-2"></i>KETERANGAN IBU KANDUNG
              </h5>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nama Ibu <span class="text-danger">*</span></label>
                  <input type="text" name="nama_ibu" class="form-control" placeholder="Masukkan nama ibu" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tempat lahir <span class="text-danger">*</span></label>
                  <input type="text" name="tempat_lahir_ibu" class="form-control" placeholder="Contoh: Jakarta" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" name="tanggal_lahir_ibu" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                  <select name="agama_ibu" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                  </select>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
                  <select name="pendidikan_ibu" class="form-select" required>
                    <option value="">-- Pilih --</option>
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
                  <input type="text" name="pekerjaan_ibu" class="form-control" placeholder="Contoh: PNS, Swasta, Wiraswasta" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Penghasilan <span class="text-danger">*</span></label>
                  <input type="number" name="penghasilan_ibu" class="form-control" placeholder="Contoh: 5000000" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                  <input type="number" name="nomor_telepon_ibu" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-12">
                  <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="alamat_ibu_sama" onchange="salinAlamat('alamat_ibu', this)">
                    <label class="form-check-label text-muted small" for="alamat_ibu_sama">
                     Sama dengan alamat siswa
                    </label>
                  </div>
                  <textarea name="alamat_ibu" id="alamat_ibu" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota" required></textarea>
                </div>
              </div>
            </div>

            <hr class="my-4">

            <!-- Data Wali -->
            <div class="mb-4">
              <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-people-fill me-2"></i>KETERANGAN WALI
              </h5>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nama Wali</label>
                  <input type="text" name="nama_wali" class="form-control" placeholder="Masukkan nama wali">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tempat lahir</label>
                  <input type="text" name="tempat_lahir_wali" class="form-control" placeholder="Contoh: Jakarta">
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir_wali" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Agama</label>
                  <select name="agama_wali" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                  </select>
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Pendidikan Terakhir</label>
                  <select name="pendidikan_wali" class="form-select">
                    <option value="">-- Pilih --</option>
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
                  <input type="text" name="pekerjaan_wali" class="form-control" placeholder="Contoh: PNS, Swasta, Wiraswasta">
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Penghasilan</label>
                  <input type="number" name="penghasilan_wali" class="form-control" placeholder="Contoh: 5000000">
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Nomor Telepon</label>
                  <input type="number" name="nomor_telepon_wali" class="form-control" placeholder="Contoh: 081234567890">
                </div>
              </div>

              <div class="row g-3 mt-1">
                <div class="col-12">
                  <label class="form-label fw-semibold">Alamat Lengkap</label>
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="alamat_wali_sama" onchange="salinAlamat('alamat_wali', this)">
                    <label class="form-check-label text-muted small" for="alamat_wali_sama">
                     Sama dengan alamat siswa
                    </label>
                  </div>
                  <textarea name="alamat_wali" id="alamat_wali" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kabupaten/Kota"></textarea>
                </div>
              </div>
            </div>
          
            <!-- Tombol Submit -->
            <div class="d-flex gap-2 justify-content-end mt-4">
              <button type="reset" class="btn btn-light px-4" onclick="resetCheckboxes()">
                Reset
              </button>
              <button type="submit" class="btn btn-primary px-4">
                Kirim Pendaftaran
              </button>
            </div> 

          </form>

        </div>
      </div>
    </div>

  </div>
</div>

@push('js')
<script>
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
});

function resetCheckboxes() {
    const targets = ["alamat_ayah", "alamat_ibu", "alamat_wali"];
    targets.forEach((id) => {
        const checkbox = document.getElementById(id + "_sama");
        const textarea = document.getElementById(id);
        if (checkbox) checkbox.checked = false;
        if (textarea) {
            textarea.removeAttribute("readonly");
            textarea.classList.remove("bg-light");
        }
    });
}
</script>
@endpush
@endsection



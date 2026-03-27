@extends('layouts.app', [
    'title' => 'Pendaftaran Peserta Didik Baru',
])

@section('content')
<div class="container py-4">
  <div class="row">
    
    <!-- Sidebar -->
    <div class="sidebar col-md-3">
      <div class="list-group shadow-sm">
        <div class="list-group-item bg-primary text-white fw-bold">Pengguna</div>
        <a href="#" class="list-group-item list-group-item-action">Pendaftaran</a>
        <a href="#" class="list-group-item list-group-item-action">Pengumuman</a>
        <a href="#" class="list-group-item list-group-item-action">Edit Profil</a>
      </div>
    </div>

    <!-- Content -->
    <div class="col-md-9">
      <div class="card shadow-sm">
        <div class="card-body">

          <form action="simpan.php" method="POST">

            <h5 class="fw-bold text-primary mb-3">FORMULIR PENDAFTARAN PESERTA DIDIK</h5>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Tempat & Tanggal Lahir</label>
                <input type="text" name="ttl" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                  <option value="">-- Pilih --</option>
                  <option>Laki-laki</option>
                  <option>Perempuan</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Asal Sekolah</label>
                <input type="text" name="asal_sekolah" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Agama</label>
                <input type="text" name="agama" class="form-control" required>
              </div>
            </div>

            <hr>

            <h5 class="fw-bold text-primary mb-3">FORMULIR DATA ORANG TUA / WALI</h5>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">NIK Ayah</label>
                <input type="text" name="nik_ayah" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan_ayah" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan_ayah" class="form-control" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Penghasilan</label>
                <input type="text" name="penghasilan_ayah" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Nomor Aktif</label>
                <input type="text" name="nomor_aktif_ayah" class="form-control" required>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">
              Simpan Pendaftaran
            </button>

          </form>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection

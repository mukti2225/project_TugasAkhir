@extends('layouts.app', [
    'title' => 'Pendaftaran Peserta Didik Baru',
])

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Pendaftaran Peserta Didik Baru (PPDB)</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="/pendaftaran">
                        @csrf

                        {{-- DATA SISWA --}}
                        <h6 class="mb-3 text-primary">Data Siswa</h6>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text" name="nisn" class="form-control"
                                       placeholder="Nomor Induk Siswa Nasional" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" name="agama" class="form-control"
                                       placeholder="Agama" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                       placeholder="Tempat lahir" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control"
                                   placeholder="Nama sekolah asal" required>
                        </div>

                        {{-- DATA ORANG TUA --}}
                        <h6 class="mb-3 text-primary">Data Orang Tua</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control"
                                       placeholder="Nama ayah" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control"
                                       placeholder="Nama ibu" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. HP Orang Tua</label>
                            <input type="text" name="no_hp_orang_tua" class="form-control"
                                   placeholder="08xxxxxxxxxx" required>
                        </div>

                        {{-- ALAMAT --}}
                        <h6 class="mb-3 text-primary">Alamat Lengkap</h6>

                        <div class="mb-3">
                            <textarea name="alamat" class="form-control" rows="3"
                                      placeholder="Alamat lengkap siswa" required></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Kirim Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

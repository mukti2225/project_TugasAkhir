<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran SPMB - {{ $data->nama }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.6;
            color: #1a1a1a;
            background: #fff;
        }

        .page {
            padding: 40px 50px;
        }

        /* ── HEADER ── */
        .header {
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 2px solid #1a1a1a;
            margin-bottom: 4px;
        }

        .header-title {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-sub {
            font-size: 14px;
            font-weight: bold;
            margin-top: 2px;
        }

        .header-year {
            font-size: 12px;
            color: #555;
            margin-top: 3px;
        }

        .header-line2 {
            width: 100%;
            border: none;
            border-top: 1px solid #1a1a1a;
            margin-top: 0;
            margin-bottom: 22px;
        }

        /* ── SECTION TITLE ── */
        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 5px 10px;
            margin-top: 18px;
            margin-bottom: 4px;
        }

        /* ── DATA TABLE ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 4.5px 8px;
            vertical-align: top;
            border-bottom: 1px solid #ebebeb;
            margin-left: 10px;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .col-label {
            width: 34%;
            font-weight: 400;
            font-family: Helvetica;
            color: #444;
        }

        .col-sep {
            width: 3%;
            color: #888;
            text-align: center;
        }

        .col-value {
            width: 63%;
            font-weight: 400;
            font-family: Helvetica;
            color: #1a1a1a;
        }

        /* ── PAGE BREAK ── */
        .page-break {
            page-break-before: always;
            padding-top: 40px;
        }

        /* ── FOOTER ── */
        .footer-meta {
            margin-top: 28px;
            font-size: 9px;
            color: #aaa;
            text-align: right;
        }

        /* ── SIGNATURE ── */
        .sign-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
        }

        .sign-table td {
            vertical-align: top;
            padding: 0;
            text-align: center;
            width: 33.33%;
        }

        .sign-role {
            font-size: 10.5px;
            color: #444;
        }

        .sign-space {
            height: 54px;
        }

        .sign-line {
            border-bottom: 1px solid #1a1a1a;
            width: 150px;
            margin: 0 auto 4px;
        }

        .sign-name {
            font-size: 10.5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="page">

    {{-- HEADER --}}
    <div class="header">
        <div class="header-title">Formulir Pendaftaran Siswa Baru</div>
        <div class="header-sub">Penerimaan Murid Baru SMA ARH</div>
        <div class="header-year">Tahun Pelajaran {{ date('Y') }}/{{ date('Y') + 1 }}</div>
    </div>
    <hr class="header-line2">

    {{-- A. DATA PRIBADI --}}
    <div class="section-title">A. Keterangan Diri Siswa</div>
    <table class="data-table">
        <tr>
            <td class="col-label">Nama Lengkap</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nama }}</td>
        </tr>
        <tr>
            <td class="col-label">Tempat, Tanggal Lahir</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="col-label">NIK</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nik }}</td>
        </tr>
        <tr>
            <td class="col-label">Jenis Kelamin</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td class="col-label">Agama</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->agama }}</td>
        </tr>
        <tr>
            <td class="col-label">Anak Ke</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->anak }}</td>
        </tr>
        <tr>
            <td class="col-label">Status Anak</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->status }}</td>
        </tr>
    </table>

    {{-- B. TEMPAT TINGGAL --}}
    <div class="section-title">B. Keterangan Tempat Tinggal Siswa</div>
    <table class="data-table">
        <tr>
            <td class="col-label">Alamat Lengkap</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->alamat }}</td>
        </tr>
        <tr>
            <td class="col-label">Jalan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->jalan }}</td>
        </tr>
        <tr>
            <td class="col-label">RT / RW</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->rt_rw }}</td>
        </tr>
        <tr>
            <td class="col-label">Kelurahan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->kelurahan }}</td>
        </tr>
        <tr>
            <td class="col-label">Kecamatan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->kecamatan }}</td>
        </tr>
        <tr>
            <td class="col-label">Kota</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->kota }}</td>
        </tr>
        <tr>
            <td class="col-label">Nomor Telepon Rumah</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nomor_telepon ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Nomor Telepon Siswa</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nomor_telepon_siswa ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Tinggal Bersama</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->tinggal }}</td>
        </tr>
        <tr>
            <td class="col-label">Jarak ke Sekolah</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->jarak_sekolah }} Km</td>
        </tr>
    </table>

    {{-- C. PENDIDIKAN --}}
    <div class="section-title">C. Keterangan Pendidikan Sebelumnya</div>
    <table class="data-table">
        <tr>
            <td class="col-label">Pendidikan Terakhir</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pendidikan }}</td>
        </tr>
        <tr>
            <td class="col-label">NISN</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nisn }}</td>
        </tr>
        <tr>
            <td class="col-label">No. Ijazah</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->ijazah }}</td>
        </tr>
        <tr>
            <td class="col-label">Asal Sekolah</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->asal_sekolah }}</td>
        </tr>
        <tr>
            <td class="col-label">Program Studi Pilihan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->program_studi ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Alasan Pindahan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pindahan ?: '-' }}</td>
        </tr>
    </table>

    {{-- PAGE BREAK --}}
    <div class="page-break">

    {{-- D. AYAH --}}
    <div class="section-title">D. Keterangan Ayah Kandung</div>
    <table class="data-table">
        <tr>
            <td class="col-label">Nama Lengkap</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nama_ayah }}</td>
        </tr>
        <tr>
            <td class="col-label">Tempat, Tanggal Lahir</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->tempat_lahir_ayah }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir_ayah)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="col-label">Agama</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->agama_ayah }}</td>
        </tr>
        <tr>
            <td class="col-label">Pendidikan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pendidikan_ayah }}</td>
        </tr>
        <tr>
            <td class="col-label">Pekerjaan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pekerjaan_ayah }}</td>
        </tr>
        <tr>
            <td class="col-label">Penghasilan per Bulan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->penghasilan_ayah ? 'Rp ' . number_format($data->penghasilan_ayah, 0, ',', '.') : '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->alamat_ayah }}</td>
        </tr>
        <tr>
            <td class="col-label">Nomor Telepon</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nomor_telepon_ayah ?: '-' }}</td>
        </tr>
    </table>

    {{-- E. IBU --}}
    <div class="section-title">E. Keterangan Ibu Kandung</div>
    <table class="data-table">
        <tr>
            <td class="col-label">Nama Lengkap</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nama_ibu }}</td>
        </tr>
        <tr>
            <td class="col-label">Tempat, Tanggal Lahir</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->tempat_lahir_ibu }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir_ibu)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="col-label">Agama</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->agama_ibu }}</td>
        </tr>
        <tr>
            <td class="col-label">Pendidikan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pendidikan_ibu }}</td>
        </tr>
        <tr>
            <td class="col-label">Pekerjaan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pekerjaan_ibu ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Penghasilan per Bulan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->penghasilan_ibu ? 'Rp ' . number_format($data->penghasilan_ibu, 0, ',', '.') : '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->alamat_ibu ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Nomor Telepon</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nomor_telepon_ibu ?: '-' }}</td>
        </tr>
    </table>

    {{-- F. WALI --}}
    @if($data->nama_wali)
    <div class="section-title">F. Keterangan Wali</div>
    <table class="data-table">
        <tr>
            <td class="col-label">Nama Lengkap</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nama_wali ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Tempat, Tanggal Lahir</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->tempat_lahir_wali }}, {{ $data->tanggal_lahir_wali ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Agama</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->agama_wali ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Pendidikan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pendidikan_wali ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Pekerjaan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->pekerjaan_wali ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Penghasilan per Bulan</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->penghasilan_wali ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Alamat</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->alamat_wali ?: '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Nomor Telepon</td>
            <td class="col-sep">:</td>
            <td class="col-value">{{ $data->nomor_telepon_wali ?: '-' }}</td>
        </tr>
    </table>
    @endif

    {{-- TANDA TANGAN --}}
    <table class="sign-table">
        <tr>
            <td style="text-align:right; width:50%;">
                <p class="sign-role">Tangerang Selatan, {{ date('d F Y') }}</p>
                <p class="sign-role">Calon Siswa Baru,</p>
                <div class="sign-space"></div>
                <div class="sign-line" style="margin-right:0; margin-left:auto; width:160px;"></div>
                <p class="sign-name">{{ $data->nama }}</p>
            </td>
        </tr>
    </table>

    <div class="footer-meta">Dicetak pada: {{ date('d F Y, H:i') }} WIB</div>

    </div>{{-- end page-break --}}

</div>
</body>
</html>
{{-- resources/views/emails/pendaftaran/sukses.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #f4f4f5;
            color: #18181b;
            padding: 32px 16px;
        }

        .wrapper {
            max-width: 540px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e4e4e7;
        }

        /* ── Header ── */
        .header {
            padding: 24px 36px;
            border-bottom: 1px solid #f0f0f0;
        }

        .school-name {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #1d4ed8;
        }

        .header-title {
            font-size: 18px;
            font-weight: 700;
            color: #18181b;
            margin-top: 4px;
            line-height: 1.3;
        }

        .header-sub {
            font-size: 12px;
            color: #71717a;
            margin-top: 3px;
        }

        /* ── Body ── */
        .body {
            padding: 24px 36px;
        }

        .greeting {
            font-size: 14px;
            color: #3f3f46;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .greeting strong {
            color: #18181b;
        }

        /* ── Nomor Pendaftaran Box ── */
        .nomor-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 3px solid #038180;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }

        .nomor-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .nomor-value {
            font-family: monospace;
            font-size: 22px;
            font-weight: 700;
            color: #038180;
            letter-spacing: 1px;
        }

        .nomor-note {
            font-size: 11px;
            color: #6b7280;
            margin-top: 8px;
        }

        /* ── Section Title ── */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #a1a1aa;
            margin-bottom: 10px;
        }

        /* ── Info Table ── */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .info-table tr {
            border-bottom: 1px solid #f4f4f5;
        }

        .info-table tr:last-child {
            border-bottom: none;
        }

        .info-table td {
            padding: 9px 0;
            vertical-align: top;
        }

        .info-table td:first-child {
            color: #71717a;
            width: 40%;
            font-size: 12px;
        }

        .info-table td:last-child {
            font-weight: 600;
            color: #18181b;
        }

        /* ── Notice Box ── */
        .notice-box {
            background: #fafafa;
            border: 1px solid #e4e4e7;
            border-left: 3px solid #d97706;
            padding: 14px 16px;
            margin: 20px 0;
        }

        .notice-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #d97706;
            margin-bottom: 8px;
        }

        .notice-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .notice-list li {
            font-size: 12px;
            color: #3f3f46;
            padding: 3px 0;
            padding-left: 14px;
            position: relative;
            line-height: 1.6;
        }

        .notice-list li::before {
            content: '—';
            position: absolute;
            left: 0;
            color: #d97706;
            font-size: 11px;
        }

        /* ── Button ── */
        .btn-wrap {
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            padding: 11px 24px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.2px;
            border: 1.5px solid #1d4ed8;
            background: #1d4ed8;
            color: #ffffff !important;
        }

        /* ── Kontak ── */
        .kontak-row {
            display: flex;
            gap: 20px;
            margin: 16px 0;
        }

        .kontak-item {
            font-size: 12px;
            color: #3f3f46;
        }

        .kontak-item span {
            font-weight: 600;
            color: #18181b;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid #f0f0f0;
            margin: 20px 0;
        }

        .closing {
            font-size: 13px;
            color: #3f3f46;
            line-height: 1.7;
        }

        .closing strong {
            color: #18181b;
        }

        /* ── Footer ── */
        .footer {
            padding: 14px 36px 18px;
            border-top: 1px solid #f0f0f0;
        }

        .footer p {
            font-size: 11px;
            color: #a1a1aa;
            line-height: 1.7;
        }

        .mono {
            font-family: monospace;
            background: #f4f4f5;
            padding: 2px 6px;
            font-size: 11px;
            color: #71717a;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        {{-- Header --}}
        <div class="header">
            <div class="school-name">SMA ARH</div>
            <div class="header-title">Pendaftaran Berhasil Diterima</div>
            <div class="header-sub">SPMB Online — Tahun Ajaran 2026/2027</div>
        </div>

        {{-- Body --}}
        <div class="body">

            <p class="greeting">
                Yth. <strong>{{ $pendaftaran->nama }}</strong>,<br>
                Terima kasih telah mendaftar sebagai calon Peserta Didik Baru di
                <strong>SMA Arif Rahman Hakim</strong>. Pendaftaran Anda telah berhasil kami terima.
            </p>

            {{-- Nomor Pendaftaran --}}
            <div class="nomor-box">
                <div class="nomor-label">Nomor Pendaftaran Anda</div>
                <div class="nomor-value">{{ $pendaftaran->nomor_pendaftaran }}</div>
                <div class="nomor-note">Simpan nomor ini untuk keperluan selanjutnya</div>
            </div>

            {{-- Detail --}}
            <div class="section-title">Detail Pendaftaran</div>
            <table class="info-table">
                <tr>
                    <td>Nama Lengkap</td>
                    <td>{{ $pendaftaran->nama }}</td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>{{ $pendaftaran->program_studi }}</td>
                </tr>
                <tr>
                    <td>Asal Sekolah</td>
                    <td>{{ $pendaftaran->asal_sekolah }}</td>
                </tr>
                <tr>
                    <td>Tanggal Daftar</td>
                    <td>{{ $pendaftaran->created_at->format('d M Y, H:i') }} WIB</td>
                </tr>
            </table>

            {{-- Penting --}}
            <div class="notice-box">
                <div class="notice-title">Perhatian</div>
                <ul class="notice-list">
                    <li>Simpan nomor pendaftaran untuk pengecekan status</li>
                    <li>Nomor diperlukan saat proses verifikasi berkas</li>
                    <li>Pantau email ini untuk pengumuman hasil seleksi</li>
                </ul>
            </div>

            {{-- Button --}}
            <div class="btn-wrap">
                <a href="{{ url(route('pendaftaran.download', $pendaftaran->nomor_pendaftaran)) }}" class="btn">
                    Download Formulir Pendaftaran
                </a>
            </div>

            <hr class="divider">

            {{-- Kontak --}}
            <div class="section-title">Hubungi Kami</div>
            <div class="kontak-row">
                <div class="kontak-item">
                    Telepon<br>
                    <span>(021) 1234-5678</span>
                </div>
                <div class="kontak-item">
                    WhatsApp<br>
                    <span>0812-3456-7890</span>
                </div>
            </div>

            <hr class="divider">

            <p class="closing">
                Terima kasih atas kepercayaan Anda kepada <strong>SMA Arif Rahman Hakim</strong>
                sebagai pilihan pendidikan putra/putri Anda.<br><br>
                Salam hangat,<br>
                <strong>Panitia SPMB ARH</strong>
            </p>

        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>
                Email ini dikirim otomatis ke <span class="mono">{{ $pendaftaran->email }}</span>
                karena melakukan pendaftaran SPMB Online SMA ARH.<br>
                Jangan membalas email ini.
            </p>
        </div>

    </div>
</body>

</html>

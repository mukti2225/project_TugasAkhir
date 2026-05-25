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

        .header {
            padding: 28px 36px 24px;
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
            font-size: 20px;
            font-weight: 700;
            color: #18181b;
            margin-top: 4px;
            line-height: 1.3;
        }

        .header-sub {
            font-size: 13px;
            color: #71717a;
            margin-top: 4px;
        }

        .body {
            padding: 28px 36px;
        }

        .greeting {
            font-size: 14px;
            color: #3f3f46;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .greeting strong {
            color: #18181b;
        }

        /* ── Status Row ── */
        .status-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            border: 1px solid #e4e4e7;
            margin-bottom: 24px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dot-diterima {
            background: #038180;
        }

        .dot-ditolak {
            background: #dc2626;
        }

        .dot-menunggu {
            background: #d97706;
        }

        .status-label {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .label-diterima {
            color: #038180;
        }

        .label-ditolak {
            color: #dc2626;
        }

        .label-menunggu {
            color: #d97706;
        }

        .status-desc {
            font-size: 12px;
            color: #71717a;
            margin-top: 1px;
        }

        /* ── Info Table ── */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #a1a1aa;
            margin-bottom: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 24px;
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
            width: 45%;
            font-size: 12px;
        }

        .info-table td:last-child {
            font-weight: 600;
            color: #18181b;
        }

        /* ── Info Box Diterima ── */
        .info-box {
            background: #fafafa;
            border: 1px solid #e4e4e7;
            padding: 14px 16px;
            font-size: 13px;
            color: #3f3f46;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .info-box.diterima {
            border-left: 3px solid #038180;
        }

        .info-box.ditolak {
            border-left: 3px solid #dc2626;
        }

        .info-box strong {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 5px;
        }

        .info-box.diterima strong {
            color: #038180;
        }

        .info-box.ditolak strong {
            color: #dc2626;
        }

        /* ── Button ── */
        .btn-wrap {
            margin-top: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 22px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.2px;
            border: 1.5px solid;
        }

        .btn-primary {
            background: #1d4ed8;
            color: #ffffff !important;
            border-color: #1d4ed8;
        }

        /* ── Footer ── */
        .footer {
            padding: 16px 36px 20px;
            border-top: 1px solid #f0f0f0;
        }

        .footer p {
            font-size: 11px;
            color: #a1a1aa;
            line-height: 1.7;
        }

        .footer .nomor {
            font-family: monospace;
            font-size: 11px;
            color: #71717a;
            background: #f4f4f5;
            padding: 2px 6px;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        {{-- Header --}}
        <div class="header">
            <div class="school-name">SMA ARH</div>
            <div class="header-title">Hasil Seleksi Penerimaan Peserta Didik Baru</div>
            <div class="header-sub">SPMB Online — Tahun Ajaran 2026/2027</div>
        </div>

        {{-- Body --}}
        <div class="body">

            <p class="greeting">
                Yth. <strong>{{ $pendaftaran->nama }}</strong>,<br>
                Berikut adalah informasi resmi mengenai hasil seleksi penerimaan peserta didik baru SMA ARH.
            </p>

            {{-- Status --}}
            @php
                $status = $pendaftaran->status_penerimaan;

                $dotClass = match ($status) {
                    'Diterima' => 'dot-diterima',
                    'Ditolak' => 'dot-ditolak',
                    default => 'dot-menunggu',
                };
                $labelClass = match ($status) {
                    'Diterima' => 'label-diterima',
                    'Ditolak' => 'label-ditolak',
                    default => 'label-menunggu',
                };
                $labelText = match ($status) {
                    'Diterima' => 'Diterima sebagai Peserta Didik Baru',
                    'Ditolak' => 'Tidak Diterima',
                    default => 'Menunggu Pengumuman',
                };
                $descText = match ($status) {
                    'Diterima' => 'Selamat! Anda resmi diterima di SMA ARH.',
                    'Ditolak' => 'Mohon maaf, Anda belum berhasil dalam seleksi ini.',
                    default => 'Hasil seleksi masih dalam proses.',
                };
            @endphp

            <div class="status-row">
                <div class="status-dot {{ $dotClass }}"></div>
                <div>
                    <div class="status-label {{ $labelClass }}">{{ $labelText }}</div>
                    <div class="status-desc">{{ $descText }}</div>
                </div>
            </div>

            {{-- Info Table --}}
            <div class="section-title">Detail Pendaftaran</div>
            <table class="info-table">
                <tr>
                    <td>Nomor Pendaftaran</td>
                    <td>{{ $pendaftaran->nomor_pendaftaran }}</td>
                </tr>
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
            </table>

            {{-- Info Box & Button --}}
            @if ($status === 'Diterima')
                <div class="info-box diterima">
                    <strong>Langkah Selanjutnya</strong>
                    Silakan datang ke sekolah untuk melakukan daftar ulang dan melengkapi
                    administrasi pendaftaran. Bawa formulir dan dokumen asli beserta fotokopi.
                </div>
                <div class="btn-wrap">
                    <a href="{{ route('pendaftaran.cek') }}" class="btn btn-primary">
                        Lihat Detail Pendaftaran
                    </a>
                </div>
            @elseif($status === 'Ditolak')
                <div class="info-box ditolak">
                    <strong>Informasi</strong>
                    Terima kasih telah mendaftar di SMA ARH. Kami menghargai minat Anda
                    dan mendoakan yang terbaik untuk langkah selanjutnya.
                </div>
            @endif

        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>
                Email ini dikirim otomatis kepada <span class="nomor">{{ $pendaftaran->email }}</span>
                karena terdaftar sebagai peserta SPMB Online SMA ARH.<br>
                Jangan membalas email ini.
            </p>
        </div>

    </div>
</body>

</html>

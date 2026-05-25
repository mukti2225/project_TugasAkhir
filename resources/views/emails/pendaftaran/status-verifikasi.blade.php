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

        /* ── Body ── */
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

        /* ── Status Badge ── */
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

        .dot-verified {
            background: #038180;
        }

        .dot-rejected {
            background: #dc2626;
        }

        .dot-pending {
            background: #d97706;
        }

        .status-label {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .label-verified {
            color: #038180;
        }

        .label-rejected {
            color: #dc2626;
        }

        .label-pending {
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

        /* ── Catatan ── */
        .catatan {
            background: #fafafa;
            border: 1px solid #e4e4e7;
            border-left: 3px solid #dc2626;
            padding: 12px 14px;
            font-size: 13px;
            color: #3f3f46;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .catatan strong {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #dc2626;
            margin-bottom: 5px;
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

        .btn-danger {
            background: #dc2626;
            color: #ffffff !important;
            border-color: #dc2626;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid #f0f0f0;
            margin: 24px 0;
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
            <div class="header-title">Update Status Verifikasi Berkas</div>
            <div class="header-sub">SPMB Online — Tahun Ajaran 2026/2027</div>
        </div>

        {{-- Body --}}
        <div class="body">

            <p class="greeting">
                Yth. <strong>{{ $pendaftaran->nama }}</strong>,<br>
                Berikut adalah informasi terbaru mengenai status verifikasi berkas pendaftaran Anda di SMA ARH.
            </p>

            {{-- Status Row --}}
            @php
                $verif = $pendaftaran->status_verifikasi;

                $dotClass = match ($verif) {
                    'diverifikasi' => 'dot-verified',
                    'ditolak' => 'dot-rejected',
                    default => 'dot-pending',
                };
                $labelClass = match ($verif) {
                    'diverifikasi' => 'label-verified',
                    'ditolak' => 'label-rejected',
                    default => 'label-pending',
                };
                $labelText = match ($verif) {
                    'diverifikasi' => 'Berkas Diverifikasi',
                    'ditolak' => 'Berkas Ditolak',
                    default => 'Menunggu Verifikasi',
                };
                $descText = match ($verif) {
                    'diverifikasi' => 'Berkas Anda telah diperiksa dan dinyatakan valid.',
                    'ditolak' => 'Berkas Anda tidak memenuhi syarat. Silakan upload ulang.',
                    default => 'Berkas Anda sedang dalam antrian pemeriksaan.',
                };
            @endphp

            <div class="status-row">
                <div class="status-dot {{ $dotClass }}"></div>
                <div>
                    <div class="status-label {{ $labelClass }}">{{ $labelText }}</div>
                    <div class="status-desc">{{ $descText }}</div>
                </div>
            </div>

            {{-- Info --}}
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
                    <td>Status Penerimaan</td>
                    <td>{{ $pendaftaran->status_penerimaan }}</td>
                </tr>
            </table>

            {{-- Catatan & Button --}}
            @if ($verif === 'ditolak')
                @if ($pendaftaran->catatan_verifikasi)
                    <div class="catatan">
                        <strong>Catatan Admin</strong>
                        {{ $pendaftaran->catatan_verifikasi }}
                    </div>
                @endif
                <div class="btn-wrap">
                    <a href="{{ route('pendaftaran.edit', $pendaftaran->nomor_pendaftaran) }}" class="btn btn-danger">
                        Upload Ulang Berkas
                    </a>
                </div>
            @elseif($verif === 'diverifikasi')
                <div class="btn-wrap">
                    <a href="{{ route('pendaftaran.cek') }}" class="btn btn-primary">
                        Lihat Status Pendaftaran
                    </a>
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

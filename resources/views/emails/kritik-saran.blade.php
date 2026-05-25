{{-- resources/views/emails/kritik-saran.blade.php --}}
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
        }

        .header-sub {
            font-size: 12px;
            color: #71717a;
            margin-top: 3px;
        }

        .body {
            padding: 24px 36px;
        }

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
            width: 35%;
            font-size: 12px;
        }

        .info-table td:last-child {
            font-weight: 600;
            color: #18181b;
        }

        .subjek-badge {
            display: inline-block;
            padding: 2px 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border: 1px solid;
        }

        .badge-kritik {
            color: #dc2626;
            border-color: #dc2626;
            background: #fef2f2;
        }

        .badge-saran {
            color: #038180;
            border-color: #038180;
            background: #f0fdf4;
        }

        .badge-pertanyaan {
            color: #1d4ed8;
            border-color: #1d4ed8;
            background: #eff6ff;
        }

        .badge-lainnya {
            color: #71717a;
            border-color: #e4e4e7;
            background: #fafafa;
        }

        .pesan-box {
            background: #fafafa;
            border: 1px solid #e4e4e7;
            border-left: 3px solid #1d4ed8;
            padding: 16px;
            font-size: 13px;
            color: #3f3f46;
            line-height: 1.75;
            margin-bottom: 24px;
            white-space: pre-line;
        }

        .btn {
            display: inline-block;
            padding: 10px 22px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid #1d4ed8;
            background: #1d4ed8;
            color: #ffffff !important;
        }

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

        <div class="header">
            <div class="school-name">SMA ARH</div>
            <div class="header-title">Pesan Masuk — Kritik & Saran</div>
            <div class="header-sub">Diterima pada {{ now()->format('d M Y, H:i') }} WIB</div>
        </div>

        <div class="body">

            <div class="section-title">Informasi Pengirim</div>
            <table class="info-table">
                <tr>
                    <td>Nama</td>
                    <td>{{ $kritikSaran->nama }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $kritikSaran->email }}</td>
                </tr>
                <tr>
                    <td>Subjek</td>
                    <td>
                        @php
                            $badgeClass = match ($kritikSaran->subjek) {
                                'kritik' => 'badge-kritik',
                                'saran' => 'badge-saran',
                                'pertanyaan' => 'badge-pertanyaan',
                                default => 'badge-lainnya',
                            };
                        @endphp
                        <span class="subjek-badge {{ $badgeClass }}">
                            {{ ucfirst($kritikSaran->subjek) }}
                        </span>
                    </td>
                </tr>
            </table>

            <div class="section-title">Isi Pesan</div>
            <div class="pesan-box">{{ $kritikSaran->pesan }}</div>

            <a href="{{ config('app.url') }}/admin/kritik-sarans" class="btn">
                Balas di Dashboard
            </a>

        </div>

        <div class="footer">
            <p>
                Pesan ini dikirim dari form Kritik & Saran di
                <span class="mono">{{ config('app.url') }}</span>
            </p>
        </div>

    </div>
</body>

</html>

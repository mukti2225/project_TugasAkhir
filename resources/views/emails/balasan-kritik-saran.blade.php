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

        .greeting {
            font-size: 14px;
            color: #3f3f46;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .greeting strong {
            color: #18181b;
        }

        .section-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #a1a1aa;
            margin-bottom: 10px;
        }

        .pesan-box {
            background: #fafafa;
            border: 1px solid #e4e4e7;
            border-left: 3px solid #e4e4e7;
            padding: 14px 16px;
            font-size: 13px;
            color: #71717a;
            line-height: 1.75;
            margin-bottom: 24px;
            white-space: pre-line;
        }

        .balasan-box {
            background: #fafafa;
            border: 1px solid #e4e4e7;
            border-left: 3px solid #1d4ed8;
            padding: 14px 16px;
            font-size: 13px;
            color: #3f3f46;
            line-height: 1.75;
            margin-bottom: 24px;
            white-space: pre-line;
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

        .divider {
            border: none;
            border-top: 1px solid #f0f0f0;
            margin: 20px 0;
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

        {{-- Header --}}
        <div class="header">
            <div class="school-name">SMA ARH</div>
            <div class="header-title">Balasan Pesan Anda</div>
            <div class="header-sub">Dibalas pada {{ $kritikSaran->dibalas_at?->format('d M Y, H:i') }} WIB</div>
        </div>

        {{-- Body --}}
        <div class="body">

            <p class="greeting">
                Yth. <strong>{{ $kritikSaran->nama }}</strong>,<br>
                Terima kasih telah mengirimkan pesan kepada kami. Berikut adalah balasan dari pihak SMA ARH.
            </p>

            {{-- Info ringkas --}}
            <div class="section-title">Detail Pesan</div>
            <table class="info-table">
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
                <tr>
                    <td>Dikirim pada</td>
                    <td>{{ $kritikSaran->created_at->format('d M Y, H:i') }} WIB</td>
                </tr>
            </table>

            {{-- Pesan asli --}}
            <div class="section-title">Pesan Anda</div>
            <div class="pesan-box">{{ $kritikSaran->pesan }}</div>

            <hr class="divider">

            {{-- Balasan --}}
            <div class="section-title">Balasan dari SMA ARH</div>
            <div class="balasan-box">{{ $kritikSaran->balasan }}</div>

        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>
                Email ini merupakan balasan otomatis dari
                <span class="mono">{{ config('app.url') }}</span>.<br>
                Jangan membalas email ini.
            </p>
        </div>

    </div>
</body>

</html>

<?php

namespace App\Filament\Resources\FormulirResource\Widgets;

use App\Filament\Resources\FormulirResource;
use App\Models\KritikSaran;
use App\Models\Pendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatusPendaftaran extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = '30s';

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $total        = Pendaftaran::count();
        $menunggu     = Pendaftaran::where('status_penerimaan', 'Menunggu')->count();
        $diterima     = Pendaftaran::where('status_penerimaan', 'Diterima')->count();
        $ditolak      = Pendaftaran::where('status_penerimaan', 'Ditolak')->count();
        $verifikasiOK = Pendaftaran::where('status_verifikasi', 'diverifikasi')->count();
        $belumBalas   = KritikSaran::whereNull('dibalas_at')->count();

        $persenDiterima    = $total > 0 ? round(($diterima / $total) * 100, 1) : 0;
        $persenVerifikasi  = $total > 0 ? round(($verifikasiOK / $total) * 100, 1) : 0;

        return [

            // ── Baris 1: Overview ────────────────────────────────────────
            Stat::make('Total Pendaftar', number_format($total))
                ->description('Seluruh data pendaftaran SPMB')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([
                    $ditolak, $menunggu, $diterima,
                ]),

            Stat::make('Tingkat Penerimaan', $persenDiterima . '%')
                ->description("{$diterima} dari {$total} pendaftar diterima")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([20, 35, 50, 60, 70, $persenDiterima]),

            Stat::make('Berkas Terverifikasi', $persenVerifikasi . '%')
                ->description("{$verifikasiOK} berkas lolos OCR")
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('info')
                ->chart([30, 45, 55, 65, 75, $persenVerifikasi]),

            // ── Baris 2: Status Detail ────────────────────────────────────
            Stat::make('Menunggu Diproses', number_format($menunggu))
                ->description('Antrian perlu tindakan admin')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Diterima', number_format($diterima))
                ->description('Calon siswa lolos seleksi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Ditolak', number_format($ditolak))
                ->description('Tidak memenuhi syarat')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            // ── Baris 3: Support ──────────────────────────────────────────
            Stat::make('Pesan Belum Dibalas', number_format($belumBalas))
                ->description(
                    $belumBalas > 0
                        ? "{$belumBalas} kritik & saran perlu direspons"
                        : 'Semua pesan telah dibalas'
                )
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color($belumBalas > 0 ? 'warning' : 'success')
                ->extraAttributes([
                    'class' => $belumBalas > 0
                        ? 'ring-1 ring-warning-400 ring-inset'
                        : '',
                ]),
        ];
    }
}

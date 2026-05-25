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

    protected function getStats(): array
    {
        $totalPendaftar   = Pendaftaran::count();
        $menunggu         = Pendaftaran::where('status_penerimaan', 'Menunggu')->count();
        $diterima         = Pendaftaran::where('status_penerimaan', 'Diterima')->count();
        $ditolak          = Pendaftaran::where('status_penerimaan', 'Ditolak')->count();
        $belumVerifikasi  = Pendaftaran::where('status_verifikasi', 'diverifikasi')->count();
        $pesanMasuk       = KritikSaran::whereNull('dibalas_at')->count();

        return [
            Stat::make('Total Pendaftar', $totalPendaftar)
                ->description('Seluruh pendaftar SPMB')
                ->descriptionIcon('heroicon-m-users')
                ->chart(
                    Pendaftaran::selectRaw('COUNT(*) as total')
                        ->groupBy('created_at')
                        ->orderBy('created_at')
                        ->limit(7)
                        ->pluck('total')
                        ->toArray()
                )
                ->color('primary'),
            
            Stat::make('Verifikasi Berkas', $belumVerifikasi)
                ->description('Berhasil Verifikasi Berkas')
                ->color('success'),

            Stat::make('Diterima', $diterima)
                ->description('Peserta yang diterima')
                ->color('success'),

            Stat::make('Ditolak', $ditolak)
                ->description('Peserta tidak diterima')
                ->color('danger'),

            Stat::make('Pesan Belum Dibalas', $pesanMasuk)
                ->description('Kritik & saran menunggu')
                ->color($pesanMasuk > 0 ? 'warning' : 'success'),
        ];
    }
}

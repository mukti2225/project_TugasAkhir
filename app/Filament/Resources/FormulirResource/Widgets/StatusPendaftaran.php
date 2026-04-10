<?php

namespace App\Filament\Resources\FormulirResource\Widgets;

use App\Models\Pendaftaran;
use App\Filament\Resources\FormulirResource;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatusPendaftaran extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Menunggu', Pendaftaran::where('status_penerimaan', 'Menunggu')->count())
                ->color('warning'),

            Stat::make('Diterima', Pendaftaran::where('status_penerimaan', 'Diterima')->count())
                ->color('success'),

            Stat::make('Ditolak', Pendaftaran::where('status_penerimaan', 'Ditolak')->count())
                ->color('danger'),
        ];
    }
}

<?php

namespace App\Filament\Resources\FormulirResource\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;

class PendaftaranChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pendaftar per Bulan';

    protected function getData(): array
    {
        $data = Pendaftaran::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $labels = [];
        $values = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('M', mktime(0, 0, 0, $i, 1)); // Jan, Feb, dst
            $values[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftar',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

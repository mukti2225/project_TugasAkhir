<?php

namespace App\Filament\Resources\FormulirResource\Widgets;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PendaftaranChart extends ChartWidget
{
    
    protected static ?string $heading = 'Grafik Pendaftar per Bulan';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '280px';

    // Filter tahun
    public ?string $filter = null;

    protected function getFilters(): ?array
    {
        return [
            now()->year       => now()->year,
            now()->year - 1   => now()->year - 1,
        ];
    }

    protected function getData(): array
    {
        $year = $this->filter ?? now()->year;

        $raw = Pendaftaran::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $labels = [];
        $values = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->translatedFormat('M');
            $values[] = $raw[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Jumlah Pendaftar',
                    'data'            => $values,
                    'borderColor'     => '#1d4ed8',
                    'backgroundColor' => 'rgba(29, 78, 216, 0.08)',
                    'borderWidth'     => 2,
                    'pointRadius'     => 4,
                    'pointBackgroundColor' => '#1d4ed8',
                    'fill'            => true,
                    'tension'         => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                    'grid' => [
                        'color' => 'rgba(0,0,0,0.04)',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}

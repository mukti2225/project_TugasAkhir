<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;

class ProgramStudiChart extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Program Studi';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $data = Pendaftaran::selectRaw('program_studi, COUNT(*) as total')
            ->groupBy('program_studi')
            ->pluck('total', 'program_studi')
            ->toArray();

        return [
            'datasets' => [
                [
                    'data'            => array_values($data),
                    'backgroundColor' => ['#1d4ed8', '#038180', '#d97706'],
                    'borderWidth'     => 0,
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
            'cutout' => '65%',
        ];
    }
}

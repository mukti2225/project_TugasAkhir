<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PengunjungWebsite extends ChartWidget
{
    protected static ?string $heading = 'Pengunjung Website';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $pollingInterval = '60s';

    public ?string $filter = '30';

    protected function getFilters(): ?array
    {
        return [
            '7'  => '7 Hari Terakhir',
            '14' => '14 Hari Terakhir',
            '30' => '30 Hari Terakhir',
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filter ?? 30);

        $views = PageView::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total, COUNT(DISTINCT session_id) as unik')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'datasets' => [
                [
                    'label'           => 'Total Kunjungan',
                    'data'            => $views->pluck('total')->toArray(),
                    'borderColor'     => '#378ADD',
                    'backgroundColor' => 'rgba(55,138,221,0.1)',
                    'fill'            => true,
                    'tension'         => 0.4,
                ],
                [
                    'label'       => 'Pengunjung Unik',
                    'data'        => $views->pluck('unik')->toArray(),
                    'borderColor' => '#1D9E75',
                    'borderDash'  => [5, 5],
                    'fill'        => false,
                    'tension'     => 0.4,
                ],
            ],
            'labels' => $views->pluck('tanggal')
                ->map(fn($d) => Carbon::parse($d)->isoFormat('D MMM'))
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

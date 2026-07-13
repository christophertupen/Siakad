<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Absensi;
use Filament\Widgets\ChartWidget;

class AbsensiChart extends ChartWidget
{
    protected static ?string $heading = 'Rekap Absensi';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $statuses = ['Hadir', 'Izin', 'Sakit', 'Alpha'];

        $totals = Absensi::query()
            ->selectRaw('status, COUNT(*) as aggregate')
            ->whereIn('status', $statuses)
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Absensi',
                    'data' => collect($statuses)
                        ->map(fn (string $status): int => (int) ($totals[$status] ?? 0))
                        ->all(),
                    'backgroundColor' => [
                        'rgba(34, 197, 94, 0.75)',
                        'rgba(245, 158, 11, 0.75)',
                        'rgba(59, 130, 246, 0.75)',
                        'rgba(239, 68, 68, 0.75)',
                    ],
                    'borderColor' => [
                        'rgb(34, 197, 94)',
                        'rgb(245, 158, 11)',
                        'rgb(59, 130, 246)',
                        'rgb(239, 68, 68)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $statuses,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

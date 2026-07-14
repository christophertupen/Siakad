<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Pembayaran;
use Filament\Widgets\ChartWidget;

class PembayaranChart extends ChartWidget
{
    protected static ?string $heading = 'Status Pembayaran';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $statuses = ['Pending', 'Lunas', 'Gagal'];

        $totals = Pembayaran::query()
            ->selectRaw('status, COUNT(*) as aggregate')
            ->whereIn('status', $statuses)
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => collect($statuses)
                        ->map(fn (string $status): int => (int) ($totals[$status] ?? 0))
                        ->all(),
                    'backgroundColor' => [
                        'rgba(245, 158, 11, 0.75)',
                        'rgba(34, 197, 94, 0.75)',
                        'rgba(239, 68, 68, 0.75)',
                    ],
                    'borderColor' => [
                        'rgb(245, 158, 11)',
                        'rgb(34, 197, 94)',
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
        return 'doughnut';
    }
}

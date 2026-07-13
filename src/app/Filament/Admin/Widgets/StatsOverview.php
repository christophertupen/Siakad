<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Guru', Guru::count())
                ->description('Jumlah guru terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Total Siswa', Siswa::count())
                ->description('Jumlah siswa terdaftar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Total Kelas', Kelas::count())
                ->description('Jumlah kelas')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning'),

            Stat::make(
                'Total Pembayaran Lunas',
                'Rp ' . number_format(
                    Pembayaran::where('status', 'Lunas')->sum('total'),
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Nominal pembayaran lunas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'),
        ];
    }
}

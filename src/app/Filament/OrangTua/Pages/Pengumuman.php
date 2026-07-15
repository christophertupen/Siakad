<?php

namespace App\Filament\OrangTua\Pages;

use Filament\Pages\Page;
use App\Models\Berita;

class Pengumuman extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static string $view = 'filament.orangtua.pages.pengumuman';
    protected static ?string $title = 'Informasi & Pengumuman';
    protected static string $layout = 'layouts.orangtua';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $pengumumans = Berita::where('status_publish', true)
            ->orderBy('tanggal', 'desc')
            ->get();

        return [
            'pengumumans' => $pengumumans,
        ];
    }
}

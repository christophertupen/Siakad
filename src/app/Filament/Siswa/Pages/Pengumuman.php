<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;
use App\Models\Berita;

class Pengumuman extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static string $view = 'filament.siswa.pages.pengumuman';
    protected static ?string $title = 'Informasi & Pengumuman';
    protected static string $layout = 'layouts.siswa';
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

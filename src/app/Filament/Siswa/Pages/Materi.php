<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;
use App\Models\Materi as MateriModel;

class Materi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.siswa.pages.materi';
    protected static ?string $title = 'Learning Library';
    protected static string $layout = 'layouts.siswa';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $user = auth()->user();
        $siswa = $user->siswa;
        $activeKelasSiswa = $siswa ? $siswa->kelasSiswas()->where('status', true)->first() : null;
        $activeKelas = $activeKelasSiswa ? $activeKelasSiswa->kelas : null;

        $materis = collect();
        if ($activeKelas) {
            $materis = MateriModel::where('kelas_id', $activeKelas->id)
                ->where('status', true)
                ->with(['mataPelajaran', 'guru'])
                ->latest()
                ->get();
        }

        return [
            'materis' => $materis,
            'activeKelasName' => $activeKelas ? $activeKelas->nama_kelas : 'Tidak Terdaftar',
        ];
    }
}

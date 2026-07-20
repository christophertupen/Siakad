<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;
use App\Models\BankSoal as BankSoalModel;

class BankSoal extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.siswa.pages.bank-soal';
    protected static ?string $title = 'Bank Soal';
    protected static string $layout = 'layouts.siswa';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $user = auth()->user();
        $siswa = $user->siswa;
        $activeKelasSiswa = $siswa ? $siswa->kelasSiswas()->where('status', true)->first() : null;
        $activeKelas = $activeKelasSiswa ? $activeKelasSiswa->kelas : null;

        $bankSoals = collect();
        if ($activeKelas) {
            $bankSoals = BankSoalModel::where('kelas_id', $activeKelas->id)
                ->where('is_publish', true)
                ->with(['mataPelajaran', 'guru'])
                ->latest()
                ->get();
        }

        return [
            'bankSoals' => $bankSoals,
            'activeKelasName' => $activeKelas ? $activeKelas->nama_kelas : 'Tidak Terdaftar',
        ];
    }
}

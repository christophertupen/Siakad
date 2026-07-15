<?php

namespace App\Filament\OrangTua\Pages;

use Filament\Pages\Page;
use App\Models\JadwalPelajaran;

class Jadwal extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static string $view = 'filament.orangtua.pages.jadwal';
    protected static ?string $title = 'Jadwal Pelajaran Anak';
    protected static string $layout = 'layouts.orangtua';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $user = auth()->user();
        $parent = $user->orangTua;
        $child = $parent ? $parent->siswa : null;
        $activeKelasSiswa = $child ? $child->kelasSiswas()->where('status', true)->first() : null;
        $activeKelas = $activeKelasSiswa ? $activeKelasSiswa->kelas : null;

        $jadwals = collect();
        if ($activeKelas) {
            $jadwals = JadwalPelajaran::where('kelas_id', $activeKelas->id)
                ->where('status', true)
                ->with(['mataPelajaran', 'guru'])
                ->get()
                ->groupBy('hari');
        }

        $hariSequence = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return [
            'jadwals' => $jadwals,
            'hariSequence' => $hariSequence,
            'activeKelasName' => $activeKelas ? $activeKelas->nama_kelas : 'Tidak Terdaftar',
        ];
    }
}

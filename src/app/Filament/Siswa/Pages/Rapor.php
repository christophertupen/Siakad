<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;
use App\Models\Nilai;
use App\Models\Absensi;

class Rapor extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static string $view = 'filament.siswa.pages.rapor';
    protected static ?string $title = 'Rapor Akademik';
    protected static string $layout = 'layouts.siswa';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        $nilais = collect();
        $activeKelasSiswa = $siswa ? $siswa->kelasSiswas()->where('status', true)->first() : null;
        $activeKelas = $activeKelasSiswa ? $activeKelasSiswa->kelas : null;

        $presentDays = 0;
        $absentDays = 0;
        $sickLeaveDays = 0;

        if ($siswa) {
            $nilais = Nilai::where('siswa_id', $siswa->id)
                ->with('mataPelajaran')
                ->get();

            $absensis = Absensi::where('siswa_id', $siswa->id)->get();
            $presentDays = $absensis->where('status', 'Hadir')->count();
            $absentDays = $absensis->where('status', 'Alpha')->count();
            $sickLeaveDays = $absensis->whereIn('status', ['Sakit', 'Izin'])->count();
        }

        return [
            'nilais' => $nilais,
            'activeKelasName' => $activeKelas ? $activeKelas->nama_kelas : 'Tidak Terdaftar',
            'semester' => $activeKelasSiswa ? $activeKelasSiswa->semester : '2',
            'tahunAjaran' => $activeKelasSiswa ? $activeKelasSiswa->tahun_ajaran : '2024/2025',
            'presentDays' => $presentDays,
            'absentDays' => $absentDays,
            'sickLeaveDays' => $sickLeaveDays,
        ];
    }
}

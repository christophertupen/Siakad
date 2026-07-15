<?php

namespace App\Filament\OrangTua\Pages;

use Filament\Pages\Page;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;

class Perkembangan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static string $view = 'filament.orangtua.pages.perkembangan';
    protected static ?string $title = 'Perkembangan Anak';
    protected static string $layout = 'layouts.orangtua';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $user = auth()->user();
        $parent = $user->orangTua;
        $child = $parent ? $parent->siswa : null;
        $activeKelasSiswa = $child ? $child->kelasSiswas()->where('status', true)->first() : null;
        $activeKelas = $activeKelasSiswa ? $activeKelasSiswa->kelas : null;

        $tugasList = collect();
        $submissionsCount = 0;
        $totalTugas = 0;
        $completionRate = 0;

        if ($child && $activeKelas) {
            $tugasList = Tugas::where('kelas_id', $activeKelas->id)
                ->where('status', true)
                ->with('mataPelajaran')
                ->latest()
                ->get();

            $totalTugas = $tugasList->count();
            
            $submissions = PengumpulanTugas::where('siswa_id', $child->id)
                ->get()
                ->keyBy('tugas_id');

            $submissionsCount = $submissions->count();
            if ($totalTugas > 0) {
                $completionRate = round(($submissionsCount / $totalTugas) * 100);
            }

            foreach ($tugasList as $t) {
                $t->submission = $submissions->get($t->id);
            }
        }

        return [
            'childName' => $child ? $child->nama : '-',
            'totalTugas' => $totalTugas,
            'submissionsCount' => $submissionsCount,
            'completionRate' => $completionRate,
            'tugasList' => $tugasList,
        ];
    }
}

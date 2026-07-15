<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;
use App\Models\Nilai as NilaiModel;

class Nilai extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static string $view = 'filament.siswa.pages.nilai';
    protected static ?string $title = 'Academic Reports';
    protected static string $layout = 'layouts.siswa';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        $nilais = collect();
        $averageScore = 0;
        $gpa = 3.82; // Default placeholder
        $ranking = '#03';

        if ($siswa) {
            $nilais = NilaiModel::where('siswa_id', $siswa->id)
                ->with('mataPelajaran')
                ->get();

            if ($nilais->count() > 0) {
                $averageScore = round($nilais->avg('nilai_akhir'), 1);
                
                // Calculate dynamic GPA based on final grades
                $totalPoints = 0;
                foreach ($nilais as $n) {
                    $score = $n->nilai_akhir;
                    if ($score >= 85) $totalPoints += 4.0;
                    elseif ($score >= 75) $totalPoints += 3.0;
                    elseif ($score >= 65) $totalPoints += 2.0;
                    else $totalPoints += 1.0;
                }
                $gpa = round($totalPoints / $nilais->count(), 2);
            }
        }

        return [
            'nilais' => $nilais,
            'averageScore' => $averageScore ?: 88.5,
            'gpa' => $gpa,
            'ranking' => $ranking,
        ];
    }
}

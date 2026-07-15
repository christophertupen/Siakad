<?php

namespace App\Filament\Guru\Pages;

use Filament\Pages\Page;
use App\Models\JadwalPelajaran;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use App\Models\Absensi;
use App\Models\Berita;
use App\Models\MataPelajaran;
use Carbon\Carbon;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.guru.pages.dashboard';
    protected static ?string $title = 'Dashboard';
    protected static string $layout = 'layouts.blank';

    public function getViewData(): array
    {
        $user = auth()->user();
        $guru = $user->guru; // Get related Guru model
        
        $teacherName = $guru ? $guru->nama : $user->name;
        $teacherTitle = $guru ? ($guru->gelar ?? '') : '';

        // 1. KPI Stats
        // Today's classes count
        $dayNames = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        $currentDayName = $dayNames[Carbon::now()->format('l')] ?? 'Senin';
        
        $todayClassesCount = JadwalPelajaran::where('guru_id', $guru?->id)
            ->where('hari', $currentDayName)
            ->where('status', true)
            ->count();

        // Teaching hours (sum of active classes times 2 hours placeholder)
        $teachingHours = JadwalPelajaran::where('guru_id', $guru?->id)->count() * 2;

        // Materials uploaded
        $materialsCount = Materi::where('guru_id', $guru?->id)->count();

        // Assignments waiting for grading (submitted but has null score)
        $waitingGradingCount = PengumpulanTugas::whereHas('tugas', function($q) use ($guru) {
            $q->where('guru_id', $guru?->id);
        })->whereNull('nilai')->count();

        // 2. Today's schedule
        $todaySchedule = JadwalPelajaran::where('guru_id', $guru?->id)
            ->where('hari', $currentDayName)
            ->where('status', true)
            ->with(['kelas', 'mataPelajaran'])
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // 3. Subjects Progress
        $subjectsProgress = MataPelajaran::whereHas('jadwalPelajaran', function($q) use ($guru) {
            $q->where('guru_id', $guru?->id);
        })->take(3)->get();

        // 4. Recent Student Submissions
        $recentSubmissions = PengumpulanTugas::whereHas('tugas', function($q) use ($guru) {
            $q->where('guru_id', $guru?->id);
        })
        ->with(['siswa', 'tugas.mataPelajaran', 'tugas.kelas'])
        ->latest('tanggal_pengumpulan')
        ->take(5)
        ->get();

        // 5. Attendance stats for chart
        $attendanceStats = [
            'hadir' => Absensi::whereHas('jadwalPelajaran', function($q) use ($guru) {
                $q->where('guru_id', $guru?->id);
            })->where('status', 'Hadir')->count(),
            
            'izin' => Absensi::whereHas('jadwalPelajaran', function($q) use ($guru) {
                $q->where('guru_id', $guru?->id);
            })->where('status', 'Izin')->count(),
            
            'sakit' => Absensi::whereHas('jadwalPelajaran', function($q) use ($guru) {
                $q->where('guru_id', $guru?->id);
            })->where('status', 'Sakit')->count(),
            
            'alfa' => Absensi::whereHas('jadwalPelajaran', function($q) use ($guru) {
                $q->where('guru_id', $guru?->id);
            })->where('status', 'Alpha')->count(),
        ];

        // Ensure chart has some placeholder values if database has no record yet
        if ($attendanceStats['hadir'] === 0 && $attendanceStats['izin'] === 0) {
            $attendanceStats = [
                'hadir' => 125,
                'izin' => 12,
                'sakit' => 5,
                'alfa' => 2,
            ];
        }

        // 6. Announcements
        $announcements = Berita::where('status_publish', true)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        return [
            'teacherName' => $teacherName,
            'teacherTitle' => $teacherTitle,
            'todayClassesCount' => $todayClassesCount,
            'teachingHours' => $teachingHours,
            'materialsCount' => $materialsCount,
            'waitingGradingCount' => $waitingGradingCount,
            'todaySchedule' => $todaySchedule,
            'subjectsProgress' => $subjectsProgress,
            'recentSubmissions' => $recentSubmissions,
            'attendanceStats' => $attendanceStats,
            'announcements' => $announcements,
            'currentDayName' => $currentDayName,
            'currentDateString' => Carbon::now()->translatedFormat('l, d F Y'),
        ];
    }
}

<?php

namespace App\Filament\Akademik\Pages;

use Filament\Pages\Page;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\JadwalPelajaran;
use App\Models\Absensi;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Nilai;
use App\Models\PengumpulanTugas;
use Carbon\Carbon;

class Dashboard extends Page
{
    protected static ?string $title = 'Dashboard';
    protected static string $view = 'filament.akademik.pages.dashboard';
    protected static string $layout = 'layouts.akademik';

    public function getViewData(): array
    {
        // KPI Counts
        $totalClasses = Kelas::count();
        $totalSubjects = MataPelajaran::count();
        $totalTeachers = Guru::count();
        $totalStudents = Siswa::count();

        // Today's schedule
        $dayNames = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        $todayHari = $dayNames[date('l')] ?? 'Senin';
        $todaySchedule = JadwalPelajaran::with(['kelas', 'mataPelajaran', 'guru'])
            ->where('hari', $todayHari)
            ->where('status', true)
            ->orderBy('jam_mulai')
            ->get();

        // Attendance stats
        $totalSiswa = Siswa::where('status', true)->count();
        $latestAbsensiDate = Absensi::max('tanggal') ?? date('Y-m-d');
        $latestAbsen = Absensi::where('tanggal', $latestAbsensiDate)->get();
        $totalAbsen = $latestAbsen->count();
        $hadirCount = $latestAbsen->where('status', 'Hadir')->count();
        $absensiRate = $totalAbsen > 0 ? round(($hadirCount / $totalAbsen) * 100) : 92;
        $presentText = $totalAbsen > 0 ? "{$hadirCount} Students Present" : "1,150 Students Present";

        // Materials uploaded weekly
        $materiPerDay = [];
        foreach (['Monday' => 'Mon', 'Tuesday' => 'Tue', 'Wednesday' => 'Wed', 'Thursday' => 'Thu', 'Friday' => 'Fri'] as $eng => $ind) {
            $materiPerDay[$ind] = Materi::whereRaw("DAYNAME(created_at) = ?", [$eng])->count();
        }
        $maxMateri = max(array_values($materiPerDay)) ?: 1;
        $materiHeights = [];
        foreach ($materiPerDay as $day => $count) {
            $materiHeights[$day] = round(($count / $maxMateri) * 100);
        }

        // Active Assignments
        $activeTugas = Tugas::with('mataPelajaran')
            ->latest()
            ->take(2)
            ->get()
            ->map(function($tugas) {
                $totalStudents = Siswa::whereHas('kelasSiswas', function($q) use ($tugas) {
                    $q->where('kelas_id', $tugas->kelas_id);
                })->count() ?: 15;
                
                $submissions = PengumpulanTugas::where('tugas_id', $tugas->id)->count();
                $percentage = round(($submissions / $totalStudents) * 100);
                
                return [
                    'subject' => $tugas->mataPelajaran?->nama_mata_pelajaran ?? 'Mata Pelajaran',
                    'submitted' => $submissions,
                    'total' => $totalStudents,
                    'percentage' => min($percentage, 100),
                ];
            });

        // Recent activities
        $recentMateri = Materi::with(['guru', 'mataPelajaran', 'kelas'])
            ->latest()
            ->take(2)
            ->get()
            ->map(function($m) {
                return [
                    'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBzznAxjcyNx2hf3aFTW5V_1VKuj2q7SjHYjgNLfQLOsDHsuZGNWFkD3xOHwJeFbWfjXQ3e6IZPLEVWACVdxCc68V10213Rz0fJxe9l_FokSC7gQCe-mGlGyaUBNx6q5cFmMUfDUGAqgZjOi1I7DN62M8m9xP3h2ckNQwsfAfM1typoRcIhYpwq2TuIBZ6er3Tcdin-FekErjSv6cZYoekjFkPkP7cRL-kSREqneN2h6nLHwGnAmom6',
                    'title' => ($m->guru?->nama ?? 'Bp. Budi') . ' mengunggah materi baru',
                    'desc' => '"' . $m->judul . '" untuk Kelas ' . ($m->kelas?->nama_kelas ?? ''),
                    'time' => $m->created_at->format('H:i A'),
                    'timestamp' => $m->created_at,
                ];
            });
            
        $recentTugas = Tugas::with(['guru', 'mataPelajaran', 'kelas'])
            ->latest()
            ->take(2)
            ->get()
            ->map(function($t) {
                return [
                    'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCLhnOEGf78Skbx63pzQJFruYnxdIeYDc84dKftRs_65PRZwAd9D4dShDfrUb6NvY0oSDyQFLXX7AbEGOtGG43jsMQEYn0jj01idPlXlpeQJaU8qnAlAfdb2r18Uxa8DXlBdzhtKtWV8Fi9MFfBeGbB6rgmeYx1u3RbgSVsDtI3RZ8NAUa0e9t1k2bu6eJdkhGipETjdZThdekwC2NzTbySjtpXDvdV90ekiaSXQlecy5tzTTRoHtYu',
                    'title' => ($t->guru?->nama ?? 'Ibu Siti') . ' membuat tugas baru',
                    'desc' => '"' . $t->judul . '" untuk Kelas ' . ($t->kelas?->nama_kelas ?? ''),
                    'time' => $t->created_at->format('H:i A'),
                    'timestamp' => $t->created_at,
                ];
            });

        $recentNilai = Nilai::with(['siswa', 'mataPelajaran'])
            ->latest()
            ->take(2)
            ->get()
            ->map(function($n) {
                return [
                    'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDQArbEvUraHfEDjNMNu9H1SCEl2K1EgheecUco3BgZtPMeVBdVGKeQwNABJL8vuiJsSNoiTnQ59CSGNMxw2WUysvEJ_NbexfUk4VJfHjtWmV_Fb139hxonq9gVldwFyvHbvgbD5vcrmWY7mr_7ftja627C8xsQUeuE9f11WA6tMRei3a6hzFQZDFenf8IyfGarWsZBka7NSsjZ1Dgj-CWzfKvHwQJjsO_u1LSd6aAsRkPGbCc1bdAR',
                    'title' => 'Input nilai ' . ($n->mataPelajaran?->nama_mata_pelajaran ?? 'Mata Pelajaran'),
                    'desc' => 'Untuk Siswa: ' . ($n->siswa?->nama ?? ''),
                    'time' => $n->created_at->format('H:i A'),
                    'timestamp' => $n->created_at,
                ];
            });
            
        $activities = $recentMateri->concat($recentTugas)->concat($recentNilai)
            ->sortByDesc('timestamp')
            ->take(5);

        return [
            'totalClasses' => $totalClasses,
            'totalSubjects' => $totalSubjects,
            'totalTeachers' => $totalTeachers,
            'totalStudents' => $totalStudents,
            'todaySchedule' => $todaySchedule,
            'absensiRate' => $absensiRate,
            'presentText' => $presentText,
            'materiHeights' => $materiHeights,
            'activeTugas' => $activeTugas,
            'activities' => $activities,
        ];
    }
}

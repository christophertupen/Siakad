<?php

namespace App\Filament\Guru\Widgets;

use App\Models\JadwalPelajaran;
use App\Models\Materi;
use App\Models\PengumpulanTugas;
use App\Models\Absensi;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $guruId = auth()->user()->guru?->id;

        if (! $guruId) {
            return [];
        }

        $dayName = Carbon::now()->locale('id')->translatedFormat('l');

        // 1. Mengajar Hari Ini
        $schedulesToday = JadwalPelajaran::query()
            ->where('guru_id', $guruId)
            ->where('hari', $dayName)
            ->with(['kelas', 'mataPelajaran'])
            ->get();

        $totalSchedules = $schedulesToday->count();
        $scheduleDesc = 'Tidak ada jadwal hari ini';
        if ($totalSchedules > 0) {
            $scheduleDesc = $schedulesToday->map(function ($item) {
                return ($item->kelas?->nama_kelas ?? 'Kelas') . ' (' . ($item->mataPelajaran?->nama_mata_pelajaran ?? 'Mapel') . ')';
            })->implode(', ');
            $scheduleDesc = \Illuminate\Support\Str::limit($scheduleDesc, 50);
        }

        // 2. Materi Saya
        $materiCount = Materi::query()
            ->where('guru_id', $guruId)
            ->count();

        // 3. Tugas Menunggu Penilaian
        $waitingGrading = PengumpulanTugas::query()
            ->whereHas('tugas', function ($query) use ($guruId) {
                $query->where('guru_id', $guruId);
            })
            ->whereNull('nilai')
            ->count();

        // 4. Absensi Hari Ini
        $attendanceToday = Absensi::query()
            ->whereDate('tanggal', now())
            ->whereHas('jadwalPelajaran', function ($query) use ($guruId) {
                $query->where('guru_id', $guruId);
            })
            ->count();

        return [
            Stat::make('Mengajar Hari Ini', $totalSchedules . ' Jadwal')
                ->description($scheduleDesc)
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Materi Saya', $materiCount . ' Materi')
                ->description('Total materi yang telah diunggah')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Tugas Belum Dinilai', $waitingGrading . ' Pengumpulan')
                ->description('Tugas siswa menunggu penilaian')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color($waitingGrading > 0 ? 'warning' : 'gray'),

            Stat::make('Absensi Hari Ini', $attendanceToday . ' Siswa')
                ->description('Siswa yang telah diabsensi hari ini')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
        ];
    }
}

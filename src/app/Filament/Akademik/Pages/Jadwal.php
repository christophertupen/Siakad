<?php

namespace App\Filament\Akademik\Pages;

use Filament\Pages\Page;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;

class Jadwal extends Page
{
    protected static ?string $title = 'Manajemen Jadwal';
    protected static string $view = 'filament.akademik.pages.jadwal';
    protected static string $layout = 'layouts.akademik';
    protected static bool $shouldRegisterNavigation = false;

    // Filters & States
    public $filterKelasId = 'all';
    public $filterGuruId = 'all';
    public $isEditMode = false;
    public $showCreateModal = false;
    public $showEditModal = false;

    // Form inputs
    public $editJadwalId;
    public $guru_id;
    public $mata_pelajaran_id;
    public $kelas_id;
    public $hari;
    public $jam_mulai;
    public $jam_selesai;
    public $tahun_ajaran = '2024/2025';
    public $semester = 'Ganjil';
    public $status = true;

    protected $rules = [
        'guru_id' => 'required|exists:gurus,id',
        'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
        'kelas_id' => 'required|exists:kelas,id',
        'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'tahun_ajaran' => 'required|string',
        'semester' => 'required|string',
        'status' => 'required|boolean',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->guru_id = '';
        $this->mata_pelajaran_id = '';
        $this->kelas_id = '';
        $this->hari = '';
        $this->jam_mulai = '';
        $this->jam_selesai = '';
        $this->tahun_ajaran = '2024/2025';
        $this->semester = 'Ganjil';
        $this->status = true;
        $this->editJadwalId = null;
    }

    public function toggleEditMode()
    {
        $this->isEditMode = !$this->isEditMode;
    }

    public function openCreateModal($day = null, $startTime = null, $endTime = null)
    {
        $this->resetForm();
        if ($day) $this->hari = $day;
        if ($startTime) $this->jam_mulai = $startTime;
        if ($endTime) $this->jam_selesai = $endTime;

        $this->showCreateModal = true;
    }

    public function createJadwal()
    {
        $this->validate();

        JadwalPelajaran::create([
            'guru_id' => $this->guru_id,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
            'kelas_id' => $this->kelas_id,
            'hari' => $this->hari,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'tahun_ajaran' => $this->tahun_ajaran,
            'semester' => $this->semester,
            'status' => $this->status,
        ]);

        $this->showCreateModal = false;
        $this->resetForm();

        session()->flash('message', 'Jadwal pelajaran berhasil ditambahkan.');
    }

    public function openEditModal($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $this->editJadwalId = $id;
        $this->guru_id = $jadwal->guru_id;
        $this->mata_pelajaran_id = $jadwal->mata_pelajaran_id;
        $this->kelas_id = $jadwal->kelas_id;
        $this->hari = $jadwal->hari;
        $this->jam_mulai = substr($jadwal->jam_mulai, 0, 5);
        $this->jam_selesai = substr($jadwal->jam_selesai, 0, 5);
        $this->tahun_ajaran = $jadwal->tahun_ajaran;
        $this->semester = $jadwal->semester;
        $this->status = $jadwal->status;

        $this->showEditModal = true;
    }

    public function updateJadwal()
    {
        $this->validate();

        $jadwal = JadwalPelajaran::findOrFail($this->editJadwalId);
        $jadwal->update([
            'guru_id' => $this->guru_id,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
            'kelas_id' => $this->kelas_id,
            'hari' => $this->hari,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'tahun_ajaran' => $this->tahun_ajaran,
            'semester' => $this->semester,
            'status' => $this->status,
        ]);

        $this->showEditModal = false;
        $this->resetForm();

        session()->flash('message', 'Jadwal pelajaran berhasil diperbarui.');
    }

    public function deleteJadwal($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        session()->flash('message', 'Jadwal pelajaran berhasil dihapus.');
    }

    public function getViewData(): array
    {
        // Query base schedules
        $query = JadwalPelajaran::with(['guru', 'kelas', 'mataPelajaran'])
            ->where('status', true);

        if ($this->filterKelasId !== 'all') {
            $query->where('kelas_id', $this->filterKelasId);
        }

        if ($this->filterGuruId !== 'all') {
            $query->where('guru_id', $this->filterGuruId);
        }

        $allSchedules = $query->get();

        // Map into grids (SENIN to JUMAT) and time slots
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $slots = [
            '07:30 - 09:00' => ['07:30:00', '09:00:00'],
            '09:00 - 10:30' => ['09:00:00', '10:30:00'],
            '11:00 - 12:30' => ['11:00:00', '12:30:00'],
        ];

        $scheduleGrid = [];
        $conflictsCount = 0;
        $conflictList = [];

        foreach ($slots as $slotName => $times) {
            foreach ($days as $day) {
                // filter schedules falling into this time range on this day
                $cellItems = $allSchedules->filter(function($item) use ($day, $times) {
                    return $item->hari === $day 
                        && $item->jam_mulai >= $times[0] 
                        && $item->jam_mulai < $times[1];
                });

                // Check for conflicts
                if ($cellItems->count() > 1) {
                    $conflictsCount += ($cellItems->count() - 1);
                    $conflictList[] = "Konflik di hari {$day} pukul {$slotName}";
                    foreach ($cellItems as $item) {
                        $item->is_conflict = true;
                    }
                }

                $scheduleGrid[$slotName][$day] = $cellItems;
            }
        }

        // Dropdowns for filters
        $kelasDropdown = Kelas::orderBy('nama_kelas')->get();
        $gurusDropdown = Guru::orderBy('nama')->get();
        $mapelsDropdown = MataPelajaran::orderBy('nama_mata_pelajaran')->get();

        // Stats
        $totalHours = $allSchedules->count() * 1.5; // each session is 1.5 hours

        return [
            'scheduleGrid' => $scheduleGrid,
            'days' => $days,
            'slots' => $slots,
            'kelasDropdown' => $kelasDropdown,
            'gurusDropdown' => $gurusDropdown,
            'mapelsDropdown' => $mapelsDropdown,
            'conflictsCount' => $conflictsCount,
            'conflictList' => $conflictList,
            'totalHours' => $totalHours,
        ];
    }
}

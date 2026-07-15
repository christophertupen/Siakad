<?php

namespace App\Filament\Akademik\Pages;

use Filament\Pages\Page;
use App\Models\Kelas as KelasModel;
use App\Models\Guru;
use App\Models\Siswa;

class Kelas extends Page
{
    protected static ?string $title = 'Manajemen Kelas';
    protected static string $view = 'filament.akademik.pages.kelas';
    protected static string $layout = 'layouts.akademik';
    protected static bool $shouldRegisterNavigation = false;

    // Filters, Search & States
    public $tingkatFilter = 'all';
    public $search = '';
    public $showCreateModal = false;
    public $showEditModal = false;

    // Form inputs
    public $editClassId;
    public $nama_kelas;
    public $tingkat;
    public $wali_kelas_id;
    public $status = true;

    protected $rules = [
        'nama_kelas' => 'required|string|max:255',
        'tingkat' => 'required|in:X,XI,XII',
        'wali_kelas_id' => 'nullable|exists:gurus,id',
        'status' => 'required|boolean',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->nama_kelas = '';
        $this->tingkat = '';
        $this->wali_kelas_id = null;
        $this->status = true;
        $this->editClassId = null;
    }

    public function setFilter($filter)
    {
        $this->tingkatFilter = $filter;
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function createClass()
    {
        $this->validate();

        KelasModel::create([
            'nama_kelas' => $this->nama_kelas,
            'tingkat' => $this->tingkat,
            'tahun_ajaran' => '2024/2025',
            'wali_kelas_id' => $this->wali_kelas_id ?: null,
            'status' => $this->status,
        ]);

        $this->showCreateModal = false;
        $this->resetForm();

        session()->flash('message', 'Kelas berhasil ditambahkan.');
    }

    public function openEditModal($id)
    {
        $kelas = KelasModel::findOrFail($id);
        $this->editClassId = $id;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->tingkat = $kelas->tingkat;
        $this->wali_kelas_id = $kelas->wali_kelas_id;
        $this->status = $kelas->status;

        $this->showEditModal = true;
    }

    public function updateClass()
    {
        $this->validate();

        $kelas = KelasModel::findOrFail($this->editClassId);
        $kelas->update([
            'nama_kelas' => $this->nama_kelas,
            'tingkat' => $this->tingkat,
            'wali_kelas_id' => $this->wali_kelas_id ?: null,
            'status' => $this->status,
        ]);

        $this->showEditModal = false;
        $this->resetForm();

        session()->flash('message', 'Kelas berhasil diubah.');
    }

    public function deleteClass($id)
    {
        $kelas = KelasModel::findOrFail($id);
        $kelas->delete();

        session()->flash('message', 'Kelas berhasil dihapus.');
    }

    public function getViewData(): array
    {
        $query = KelasModel::with(['waliKelas', 'kelasSiswas']);

        if ($this->tingkatFilter !== 'all') {
            $query->where('tingkat', $this->tingkatFilter);
        }

        if (!empty($this->search)) {
            $query->where('nama_kelas', 'like', '%' . $this->search . '%');
        }

        $classes = $query->get();
        $gurus = Guru::orderBy('nama')->get();

        $totalClassesCount = KelasModel::count();
        $activeClassesCount = KelasModel::where('status', true)->count();
        $totalSiswa = Siswa::where('status', true)->count();
        $averageStudents = $totalClassesCount > 0 ? round($totalSiswa / $totalClassesCount, 1) : 0;
        
        $availableRooms = max(50 - $totalClassesCount, 0);
        $occupancyRate = 92;

        return [
            'classes' => $classes,
            'gurus' => $gurus,
            'totalClassesCount' => $totalClassesCount,
            'activeClassesCount' => $activeClassesCount,
            'averageStudents' => $averageStudents,
            'availableRooms' => $availableRooms,
            'occupancyRate' => $occupancyRate,
        ];
    }
}

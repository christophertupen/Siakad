<?php

namespace App\Filament\Akademik\Pages;

use Filament\Pages\Page;
use App\Models\MataPelajaran as MapelModel;

class MataPelajaran extends Page
{
    protected static ?string $title = 'Manajemen Mata Pelajaran';
    protected static string $view = 'filament.akademik.pages.mata-pelajaran';
    protected static string $layout = 'layouts.akademik';
    protected static bool $shouldRegisterNavigation = false;

    // Filters, Search & States
    public $search = '';
    public $showCreateModal = false;
    public $showEditModal = false;

    // Form inputs
    public $editMapelId;
    public $kode_mata_pelajaran;
    public $nama_mata_pelajaran;
    public $deskripsi;
    public $kkm = 75;
    public $status = true;

    protected $rules = [
        'kode_mata_pelajaran' => 'required|string|max:50',
        'nama_mata_pelajaran' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'kkm' => 'required|integer|min:0|max:100',
        'status' => 'required|boolean',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->kode_mata_pelajaran = '';
        $this->nama_mata_pelajaran = '';
        $this->deskripsi = '';
        $this->kkm = 75;
        $this->status = true;
        $this->editMapelId = null;
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function createMapel()
    {
        $this->validate();

        // Check unique code
        $exists = MapelModel::where('kode_mata_pelajaran', $this->kode_mata_pelajaran)->exists();
        if ($exists) {
            $this->addError('kode_mata_pelajaran', 'Kode mata pelajaran sudah digunakan.');
            return;
        }

        MapelModel::create([
            'kode_mata_pelajaran' => $this->kode_mata_pelajaran,
            'nama_mata_pelajaran' => $this->nama_mata_pelajaran,
            'deskripsi' => $this->deskripsi,
            'kkm' => $this->kkm,
            'status' => $this->status,
        ]);

        $this->showCreateModal = false;
        $this->resetForm();

        session()->flash('message', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function openEditModal($id)
    {
        $mapel = MapelModel::findOrFail($id);
        $this->editMapelId = $id;
        $this->kode_mata_pelajaran = $mapel->kode_mata_pelajaran;
        $this->nama_mata_pelajaran = $mapel->nama_mata_pelajaran;
        $this->deskripsi = $mapel->deskripsi;
        $this->kkm = $mapel->kkm;
        $this->status = $mapel->status;

        $this->showEditModal = true;
    }

    public function updateMapel()
    {
        $this->validate();

        // Check unique code excluding current
        $exists = MapelModel::where('kode_mata_pelajaran', $this->kode_mata_pelajaran)
            ->where('id', '!=', $this->editMapelId)
            ->exists();
        if ($exists) {
            $this->addError('kode_mata_pelajaran', 'Kode mata pelajaran sudah digunakan.');
            return;
        }

        $mapel = MapelModel::findOrFail($this->editMapelId);
        $mapel->update([
            'kode_mata_pelajaran' => $this->kode_mata_pelajaran,
            'nama_mata_pelajaran' => $this->nama_mata_pelajaran,
            'deskripsi' => $this->deskripsi,
            'kkm' => $this->kkm,
            'status' => $this->status,
        ]);

        $this->showEditModal = false;
        $this->resetForm();

        session()->flash('message', 'Mata Pelajaran berhasil diubah.');
    }

    public function deleteMapel($id)
    {
        $mapel = MapelModel::findOrFail($id);
        $mapel->delete();

        session()->flash('message', 'Mata Pelajaran berhasil dihapus.');
    }

    public function getViewData(): array
    {
        $query = MapelModel::query();

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nama_mata_pelajaran', 'like', '%' . $this->search . '%')
                  ->orWhere('kode_mata_pelajaran', 'like', '%' . $this->search . '%');
            });
        }

        $mapels = $query->orderBy('nama_mata_pelajaran')->get();

        $totalMapels = MapelModel::count();
        $activeMapels = MapelModel::where('status', true)->count();
        $averageKKM = MapelModel::avg('kkm') ?: 75;

        return [
            'mapels' => $mapels,
            'totalMapels' => $totalMapels,
            'activeMapels' => $activeMapels,
            'averageKKM' => round($averageKKM, 1),
        ];
    }
}

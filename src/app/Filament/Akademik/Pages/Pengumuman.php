<?php

namespace App\Filament\Akademik\Pages;

use Filament\Pages\Page;
use App\Models\Berita;
use Illuminate\Support\Str;

class Pengumuman extends Page
{
    protected static ?string $title = 'Pengumuman & Informasi';
    protected static string $view = 'filament.akademik.pages.pengumuman';
    protected static string $layout = 'layouts.akademik';
    protected static bool $shouldRegisterNavigation = false;

    // States & Filters
    public $search = '';
    public $kategoriFilter = 'all';
    public $showCreateModal = false;
    public $showEditModal = false;

    // Form inputs
    public $editAnnId;
    public $annTitle;
    public $content;
    public $kategori = 'Akademik';
    public $featured = false;
    public $status_publish = true;

    protected $rules = [
        'annTitle' => 'required|string|max:255',
        'content' => 'required|string',
        'kategori' => 'required|string|in:Akademik,Event,Penting,Archive',
        'featured' => 'required|boolean',
        'status_publish' => 'required|boolean',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->annTitle = '';
        $this->content = '';
        $this->kategori = 'Akademik';
        $this->featured = false;
        $this->status_publish = true;
        $this->editAnnId = null;
    }

    public function setFilter($kategori)
    {
        $this->kategoriFilter = $kategori;
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function createAnn()
    {
        $this->validate();

        Berita::create([
            'title' => $this->annTitle,
            'slug' => Str::slug($this->annTitle),
            'content' => $this->content,
            'kategori' => $this->kategori,
            'tanggal' => now(),
            'author' => auth()->user()->name,
            'status_publish' => $this->status_publish,
            'featured' => $this->featured,
        ]);

        $this->showCreateModal = false;
        $this->resetForm();

        session()->flash('message', 'Pengumuman baru berhasil diterbitkan.');
    }

    public function openEditModal($id)
    {
        $ann = Berita::findOrFail($id);
        $this->editAnnId = $id;
        $this->annTitle = $ann->title;
        $this->content = $ann->content;
        $this->kategori = $ann->kategori;
        $this->featured = $ann->featured;
        $this->status_publish = $ann->status_publish;

        $this->showEditModal = true;
    }

    public function updateAnn()
    {
        $this->validate();

        $ann = Berita::findOrFail($this->editAnnId);
        $ann->update([
            'title' => $this->annTitle,
            'slug' => Str::slug($this->annTitle),
            'content' => $this->content,
            'kategori' => $this->kategori,
            'featured' => $this->featured,
            'status_publish' => $this->status_publish,
        ]);

        $this->showEditModal = false;
        $this->resetForm();

        session()->flash('message', 'Pengumuman berhasil diperbarui.');
    }

    public function deleteAnn($id)
    {
        $ann = Berita::findOrFail($id);
        $ann->delete();

        session()->flash('message', 'Pengumuman berhasil dihapus.');
    }

    public function getViewData(): array
    {
        $query = Berita::query();

        if ($this->kategoriFilter !== 'all') {
            $query->where('kategori', $this->kategoriFilter);
        }

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        $announcements = $query->latest('tanggal')->get();
        $totalActiveAnn = Berita::where('status_publish', true)->count();

        return [
            'announcements' => $announcements,
            'totalActiveAnn' => $totalActiveAnn,
        ];
    }
}

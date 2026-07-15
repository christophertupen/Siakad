<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;
use App\Models\Tugas as TugasModel;
use App\Models\PengumpulanTugas;
use Livewire\WithFileUploads;

class Tugas extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string $view = 'filament.siswa.pages.tugas';
    protected static ?string $title = 'Assignments Board';
    protected static string $layout = 'layouts.siswa';
    protected static bool $shouldRegisterNavigation = false;

    // Livewire states
    public $activeTab = 'kanban'; // kanban or detail
    public $selectedTugasId;
    public $fileJawaban;
    public $catatan;

    public function selectTugas($id)
    {
        $this->selectedTugasId = $id;
        $this->activeTab = 'detail';
        $this->fileJawaban = null;
        $this->catatan = '';
    }

    public function backToKanban()
    {
        $this->activeTab = 'kanban';
        $this->selectedTugasId = null;
    }

    public function submitTugas()
    {
        $this->validate([
            'fileJawaban' => 'required|file|max:25600|mimes:pdf,docx,zip',
            'catatan' => 'nullable|string',
        ]);

        $siswa = auth()->user()->siswa;
        if (!$siswa) return;

        $path = $this->fileJawaban->store('jawaban_tugas', 'public');

        PengumpulanTugas::updateOrCreate([
            'tugas_id' => $this->selectedTugasId,
            'siswa_id' => $siswa->id,
        ], [
            'file_jawaban' => $path,
            'catatan' => $this->catatan,
            'tanggal_pengumpulan' => now(),
        ]);

        session()->flash('success', 'Tugas berhasil diunggah!');
        $this->backToKanban();
    }

    public function getViewData(): array
    {
        $user = auth()->user();
        $siswa = $user->siswa;
        $activeKelasSiswa = $siswa ? $siswa->kelasSiswas()->where('status', true)->first() : null;
        $activeKelas = $activeKelasSiswa ? $activeKelasSiswa->kelas : null;

        $allTugas = collect();
        $todoTugas = collect();
        $inProgressTugas = collect();
        $doneTugas = collect();

        if ($siswa && $activeKelas) {
            $allTugas = TugasModel::where('kelas_id', $activeKelas->id)
                ->where('status', true)
                ->with(['mataPelajaran', 'guru'])
                ->get();

            $submissions = PengumpulanTugas::where('siswa_id', $siswa->id)
                ->get()
                ->keyBy('tugas_id');

            foreach ($allTugas as $t) {
                if (isset($submissions[$t->id])) {
                    $t->submission = $submissions[$t->id];
                    $doneTugas->push($t);
                } else {
                    if ($t->deadline && $t->deadline->diffInDays(now()) <= 3 && $t->deadline->isFuture()) {
                        $inProgressTugas->push($t);
                    } else {
                        $todoTugas->push($t);
                    }
                }
            }
        }

        $selectedTugas = $this->selectedTugasId ? TugasModel::with(['mataPelajaran', 'guru'])->find($this->selectedTugasId) : null;
        $selectedSubmission = null;
        if ($selectedTugas && $siswa) {
            $selectedSubmission = PengumpulanTugas::where('siswa_id', $siswa->id)
                ->where('tugas_id', $selectedTugas->id)
                ->first();
        }

        return [
            'todoTugas' => $todoTugas,
            'inProgressTugas' => $inProgressTugas,
            'doneTugas' => $doneTugas,
            'selectedTugas' => $selectedTugas,
            'selectedSubmission' => $selectedSubmission,
        ];
    }
}

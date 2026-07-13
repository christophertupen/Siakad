<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\GuruResource;
use App\Filament\Admin\Resources\JadwalPelajaranResource;
use App\Filament\Admin\Resources\KelasResource;
use App\Filament\Admin\Resources\MataPelajaranResource;
use App\Filament\Admin\Resources\PembayaranResource;
use App\Filament\Admin\Resources\SiswaResource;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Widgets\Widget;

class QuickAction extends Widget implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string $view = 'filament.admin.widgets.quick-action';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    /**
     * @return array<Action>
     */
    public function getQuickActions(): array
    {
        return [
            $this->getAction('createGuru'),
            $this->getAction('createSiswa'),
            $this->getAction('createKelas'),
            $this->getAction('createMataPelajaran'),
            $this->getAction('createJadwal'),
            $this->getAction('createPembayaran'),
        ];
    }

    public function createGuruAction(): Action
    {
        return $this->makeCreateAction(
            name: 'createGuru',
            label: 'Tambah Guru',
            icon: 'heroicon-m-user-plus',
            color: 'success',
            url: GuruResource::getUrl('create'),
        );
    }

    public function createSiswaAction(): Action
    {
        return $this->makeCreateAction(
            name: 'createSiswa',
            label: 'Tambah Siswa',
            icon: 'heroicon-m-academic-cap',
            color: 'primary',
            url: SiswaResource::getUrl('create'),
        );
    }

    public function createKelasAction(): Action
    {
        return $this->makeCreateAction(
            name: 'createKelas',
            label: 'Tambah Kelas',
            icon: 'heroicon-m-building-office-2',
            color: 'warning',
            url: KelasResource::getUrl('create'),
        );
    }

    public function createMataPelajaranAction(): Action
    {
        return $this->makeCreateAction(
            name: 'createMataPelajaran',
            label: 'Tambah Mata Pelajaran',
            icon: 'heroicon-m-book-open',
            color: 'info',
            url: MataPelajaranResource::getUrl('create'),
        );
    }

    public function createJadwalAction(): Action
    {
        return $this->makeCreateAction(
            name: 'createJadwal',
            label: 'Tambah Jadwal',
            icon: 'heroicon-m-calendar-days',
            color: 'gray',
            url: JadwalPelajaranResource::getUrl('create'),
        );
    }

    public function createPembayaranAction(): Action
    {
        return $this->makeCreateAction(
            name: 'createPembayaran',
            label: 'Tambah Pembayaran',
            icon: 'heroicon-m-banknotes',
            color: 'danger',
            url: PembayaranResource::getUrl('create'),
        );
    }

    private function makeCreateAction(
        string $name,
        string $label,
        string $icon,
        string $color,
        string $url,
    ): Action {
        return Action::make($name)
            ->label($label)
            ->icon($icon)
            ->color($color)
            ->url($url)
            ->button()
            ->size(ActionSize::Large)
            ->extraAttributes([
                'class' => 'w-full justify-center',
            ]);
    }
}

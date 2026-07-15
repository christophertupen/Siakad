<?php

namespace App\Filament\Admin\Pages;

use App\Models\PengaturanWeb;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ManageTentang extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Tentang Sekolah';
    protected static string $view = 'filament.admin.pages.manage-settings';
    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = PengaturanWeb::firstOrCreate([]);
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profil & Deskripsi')
                    ->schema([
                        RichEditor::make('deskripsi')
                            ->label('Deskripsi Sekolah / Sejarah Singkat')
                            ->required(),
                    ]),

                Section::make('Visi & Misi')
                    ->schema([
                        RichEditor::make('visi')
                            ->label('Visi Sekolah'),
                        RichEditor::make('misi')
                            ->label('Misi Sekolah'),
                    ]),

                Section::make('Pimpinan Sekolah')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('kepala_sekolah')
                                ->label('Nama Kepala Sekolah'),
                            TextInput::make('nip_kepala_sekolah')
                                ->label('NIP Kepala Sekolah'),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $settings = PengaturanWeb::firstOrCreate([]);
        $settings->update($this->form->getState());

        Notification::make()
            ->title('Profil Sekolah berhasil diperbarui')
            ->success()
            ->send();
    }
}

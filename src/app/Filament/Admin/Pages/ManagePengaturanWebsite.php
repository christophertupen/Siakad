<?php

namespace App\Filament\Admin\Pages;

use App\Models\PengaturanWeb;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ManagePengaturanWebsite extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static string $view = 'filament.admin.pages.manage-settings';
    protected static ?int $navigationSort = 12;

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
                Section::make('Identitas Sekolah')
                    ->schema([
                        TextInput::make('nama_sekolah')
                            ->label('Nama Sekolah')
                            ->required(),
                        TextInput::make('nama_aplikasi')
                            ->label('Nama Aplikasi')
                            ->default('SchonaNexa SMK')
                            ->required(),
                        Grid::make(3)->schema([
                            TextInput::make('npsn')->label('NPSN'),
                            Select::make('status_sekolah')
                                ->label('Status Sekolah')
                                ->options([
                                    'Negeri' => 'Negeri',
                                    'Swasta' => 'Swasta',
                                ]),
                            TextInput::make('akreditasi')->label('Akreditasi'),
                        ]),
                    ]),

                Section::make('Branding & Media')
                    ->schema([
                        Grid::make(3)->schema([
                            FileUpload::make('logo')
                                ->label('Logo Sekolah')
                                ->image()
                                ->disk('public')
                                ->directory('pengaturan'),
                            FileUpload::make('favicon')
                                ->label('Favicon')
                                ->image()
                                ->disk('public')
                                ->directory('pengaturan'),
                            FileUpload::make('background_login')
                                ->label('Background Login')
                                ->image()
                                ->disk('public')
                                ->directory('pengaturan'),
                        ]),
                    ]),

                Section::make('Sistem Warna Desain')
                    ->schema([
                        Grid::make(2)->schema([
                            ColorPicker::make('primary_color')
                                ->label('Warna Primer')
                                ->default('#2563EB'),
                            ColorPicker::make('secondary_color')
                                ->label('Warna Sekunder')
                                ->default('#0F172A'),
                        ]),
                    ]),

                Section::make('Pengaturan Tambahan')
                    ->schema([
                        Toggle::make('maintenance_mode')
                            ->label('Aktifkan Mode Pemeliharaan (Maintenance Mode)')
                            ->default(false),
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
            ->title('Pengaturan Website berhasil diperbarui')
            ->success()
            ->send();
    }
}

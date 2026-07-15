<?php

namespace App\Filament\Admin\Pages;

use App\Models\PengaturanWeb;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ManageFooter extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Footer';
    protected static string $view = 'filament.admin.pages.manage-settings';
    protected static ?int $navigationSort = 10;

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
                Section::make('Kontak & Alamat')
                    ->schema([
                        Textarea::make('alamat')
                            ->label('Alamat Sekolah')
                            ->rows(3),
                        Grid::make(2)->schema([
                            TextInput::make('email')->label('Email Sekolah')->email(),
                            TextInput::make('telepon')->label('Telepon Sekolah'),
                        ]),
                    ]),

                Section::make('Google Maps')
                    ->schema([
                        Textarea::make('google_maps')
                            ->label('Google Maps Embed HTML / URL')
                            ->rows(3),
                    ]),

                Section::make('Sosial Media')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('facebook')->label('Facebook Link'),
                            TextInput::make('instagram')->label('Instagram Link'),
                            TextInput::make('tiktok')->label('TikTok Link'),
                            TextInput::make('youtube')->label('YouTube Link'),
                            TextInput::make('whatsapp')->label('WhatsApp Link / Number'),
                        ]),
                    ]),

                Section::make('Copyright')
                    ->schema([
                        TextInput::make('copyright')
                            ->label('Copyright Text')
                            ->required(),
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
            ->title('Footer berhasil diperbarui')
            ->success()
            ->send();
    }
}

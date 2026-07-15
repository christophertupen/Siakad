<?php

namespace App\Filament\Admin\Pages;

use App\Models\PengaturanWeb;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ManageSeo extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'SEO';
    protected static string $view = 'filament.admin.pages.manage-settings';
    protected static ?int $navigationSort = 11;

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
                Section::make('Search Engine Optimization (SEO)')
                    ->schema([
                        TextInput::make('seo_meta_title')
                            ->label('Meta Title')
                            ->placeholder('Judul situs di hasil pencarian Google'),
                        Textarea::make('seo_meta_description')
                            ->label('Meta Description')
                            ->placeholder('Deskripsi singkat untuk hasil pencarian Google')
                            ->rows(3),
                        TextInput::make('seo_keywords')
                            ->label('Keywords')
                            ->placeholder('Kata kunci dipisah koma (contoh: siakad, sekolah, smk)'),
                        FileUpload::make('seo_og_image')
                            ->label('OG Image (Open Graph)')
                            ->image()
                            ->disk('public')
                            ->directory('website')
                            ->placeholder('Gambar preview saat link dibagikan di sosial media'),
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
            ->title('SEO berhasil diperbarui')
            ->success()
            ->send();
    }
}

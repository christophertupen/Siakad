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
use Filament\Forms\Components\Grid;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ManageCta extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'CTA';
    protected static string $view = 'filament.admin.pages.manage-settings';
    protected static ?int $navigationSort = 9;

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
                Section::make('Call To Action (CTA)')
                    ->schema([
                        TextInput::make('cta_heading')
                            ->label('Heading / Title')
                            ->required(),
                        Textarea::make('cta_description')
                            ->label('Description')
                            ->rows(3),
                    ]),

                Section::make('CTA Actions')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('cta_button_text')->label('Button Text'),
                            TextInput::make('cta_button_url')->label('Button URL'),
                        ]),
                    ]),

                Section::make('CTA Background')
                    ->schema([
                        FileUpload::make('cta_background')
                            ->label('Background Image')
                            ->image()
                            ->disk('public')
                            ->directory('website'),
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
            ->title('CTA berhasil diperbarui')
            ->success()
            ->send();
    }
}

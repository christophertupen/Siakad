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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class ManageHero extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static string $view = 'filament.admin.pages.manage-settings';
    protected static ?int $navigationSort = 1;

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
                Section::make('Hero Content')
                    ->schema([
                        TextInput::make('hero_headline')
                            ->label('Headline')
                            ->required(),
                        TextInput::make('hero_subheadline')
                            ->label('Subheadline'),
                        Textarea::make('hero_description')
                            ->label('Description')
                            ->rows(3),
                    ]),

                Section::make('Hero Buttons')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('hero_button1_text')->label('Button 1 Text'),
                            TextInput::make('hero_button1_url')->label('Button 1 URL'),
                            TextInput::make('hero_button2_text')->label('Button 2 Text'),
                            TextInput::make('hero_button2_url')->label('Button 2 URL'),
                        ]),
                    ]),

                Section::make('Hero Images')
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('hero_image')
                                ->label('Hero Image / Illustration')
                                ->image()
                                ->disk('public')
                                ->directory('website'),
                            FileUpload::make('hero_background_image')
                                ->label('Background Image / Mesh')
                                ->image()
                                ->disk('public')
                                ->directory('website'),
                        ]),
                    ]),

                Section::make('Floating Cards decoration')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('hero_floating_card1_title')->label('Floating Card 1 Title'),
                            TextInput::make('hero_floating_card1_desc')->label('Floating Card 1 Description'),
                            TextInput::make('hero_floating_card2_title')->label('Floating Card 2 Title'),
                            TextInput::make('hero_floating_card2_desc')->label('Floating Card 2 Description'),
                        ]),
                    ]),

                Section::make('Statistics Configuration')
                    ->schema([
                        Select::make('stats_mode')
                            ->label('Mode Statistik')
                            ->options([
                                'auto' => 'Auto Count Database (Mengambil data real siswa, guru, kelas)',
                                'manual' => 'Manual (Diinput manual)',
                            ])
                            ->required()
                            ->reactive(),
                        Grid::make(4)->schema([
                            TextInput::make('stats_siswa_manual')
                                ->label('Total Siswa')
                                ->numeric()
                                ->visible(fn ($get) => $get('stats_mode') === 'manual'),
                            TextInput::make('stats_guru_manual')
                                ->label('Total Guru')
                                ->numeric()
                                ->visible(fn ($get) => $get('stats_mode') === 'manual'),
                            TextInput::make('stats_kelas_manual')
                                ->label('Total Kelas')
                                ->numeric()
                                ->visible(fn ($get) => $get('stats_mode') === 'manual'),
                            TextInput::make('stats_alumni_manual')
                                ->label('Total Alumni/Lulusan')
                                ->numeric()
                                ->visible(fn ($get) => $get('stats_mode') === 'manual'),
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
            ->title('Hero Section berhasil diperbarui')
            ->success()
            ->send();
    }
}

<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.siswa.pages.settings';
    protected static ?string $title = 'Pengaturan';
    protected static string $layout = 'layouts.siswa';
    protected static bool $shouldRegisterNavigation = false;

    public $email_notification = true;
    public $whatsapp_notification = false;
    public $language = 'id';
    public $appearance = 'light';

    public function saveSettings()
    {
        session()->flash('success_settings', 'Pengaturan berhasil diperbarui!');
    }
}

<?php

namespace App\Filament\Siswa\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.siswa.pages.profile';
    protected static ?string $title = 'Profil Siswa';
    protected static string $layout = 'layouts.siswa';
    protected static bool $shouldRegisterNavigation = false;

    // Form inputs
    public $nama;
    public $nis;
    public $nisn;
    public $telepon;
    public $alamat;
    public $email;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        $this->nama = $siswa ? $siswa->nama : $user->name;
        $this->nis = $siswa ? $siswa->nis : '';
        $this->nisn = $siswa ? $siswa->nisn : '';
        $this->telepon = $siswa ? $siswa->telepon : '';
        $this->alamat = $siswa ? $siswa->alamat : '';
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        $this->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update(['email' => $this->email]);
        if ($siswa) {
            $siswa->update([
                'nama' => $this->nama,
                'telepon' => $this->telepon,
                'alamat' => $this->alamat,
            ]);
        }

        session()->flash('success_profile', 'Profil berhasil diperbarui!');
    }

    public function updatePassword()
    {
        $user = auth()->user();

        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($this->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Kata sandi saat ini salah.',
            ]);
        }

        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('success_password', 'Kata sandi berhasil diubah!');
    }
}

<?php

namespace App\Filament\OrangTua\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Profil extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.orangtua.pages.profil';
    protected static ?string $title = 'Profil Wali Murid';
    protected static string $layout = 'layouts.orangtua';
    protected static bool $shouldRegisterNavigation = false;

    // Form inputs
    public $nama;
    public $nik;
    public $hubungan;
    public $pekerjaan;
    public $nomor_telepon;
    public $alamat;
    public $email;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = auth()->user();
        $parent = $user->orangTua;

        $this->nama = $parent ? $parent->nama : $user->name;
        $this->nik = $parent ? $parent->nik : '';
        $this->hubungan = $parent ? $parent->hubungan : '';
        $this->pekerjaan = $parent ? $parent->pekerjaan : '';
        $this->nomor_telepon = $parent ? $parent->nomor_telepon : '';
        $this->alamat = $parent ? $parent->alamat : '';
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $user = auth()->user();
        $parent = $user->orangTua;

        $this->validate([
            'nama' => 'required|string|max:255',
            'hubungan' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update(['email' => $this->email]);
        if ($parent) {
            $parent->update([
                'nama' => $this->nama,
                'hubungan' => $this->hubungan,
                'pekerjaan' => $this->pekerjaan,
                'nomor_telepon' => $this->nomor_telepon,
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

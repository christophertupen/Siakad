<?php

namespace App\Filament\Akademik\Pages;

use Filament\Pages\Page;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Profil extends Page
{
    protected static ?string $title = 'Profil Akun';
    protected static string $view = 'filament.akademik.pages.profil';
    protected static string $layout = 'layouts.akademik';
    protected static bool $shouldRegisterNavigation = false;

    // Form inputs
    public $name;
    public $email;
    public $password;
    public $nip;
    public $nomor_telepon;
    public $alamat;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8',
            'nip' => 'nullable|string|max:50',
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ];
    }

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nip = $user->nip;
        $this->nomor_telepon = $user->nomor_telepon;
        $this->alamat = $user->alamat;
    }

    public function updateProfil()
    {
        $this->validate();

        $user = User::findOrFail(auth()->id());
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'nip' => $this->nip,
            'nomor_telepon' => $this->nomor_telepon,
            'alamat' => $this->alamat,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        // Clear password input
        $this->password = '';

        session()->flash('message', 'Profil berhasil diperbarui.');
    }
}

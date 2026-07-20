<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['super_admin', 'admin'])) {
            return redirect()->to('/admin');
        } elseif ($user->hasRole('guru')) {
            return redirect()->to('/guru');
        } elseif ($user->hasRole('siswa')) {
            return redirect()->to('/siswa');
        } elseif ($user->hasRole('orang_tua')) {
            return redirect()->to('/orangtua');
        } elseif ($user->hasRole('akademik')) {
            return redirect()->to('/akademik');
        }

        return redirect()->to('/admin');
    }
}

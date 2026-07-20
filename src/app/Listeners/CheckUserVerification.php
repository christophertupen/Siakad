<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class CheckUserVerification
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        // SEMENTARA DIMATIKAN UNTUK TESTING RAPOR
        // Cek apakah user belum verifikasi email ATAU statusnya masih tidak aktif (false)
        /*
        if (!$user->status || !$user->hasVerifiedEmail()) {
            
            // Logout user karena proses attempt sebelumnya berhasil
            Auth::logout();
            
            // Set flash session agar kita bisa menampilkan tombol "Kirim Ulang" di halaman login
            session()->flash('show_resend', true);
            session()->flash('resend_email', $user->email);
            
            // Lempar error validasi agar otomatis kembali ke form login dengan pesan
            throw ValidationException::withMessages([
                'email' => 'Silakan verifikasi email Anda terlebih dahulu.',
            ]);
        }
        */
    }
}

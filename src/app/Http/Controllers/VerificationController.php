<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Redirect;

class VerificationController extends Controller
{
    /**
     * Memproses link verifikasi yang diklik oleh user dari email.
     */
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Validasi hash dari URL
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            // Jika token invalid/berbeda, kita redirect ke halaman utama dengan error
            return redirect('/')->with('error', 'Link verifikasi tidak valid atau telah dimanipulasi.');
        }

        // Cek apakah URL valid (termasuk belum expired dan tidak dimanipulasi)
        if (! $request->hasValidSignature()) {
            return redirect('/')->with('error', 'Link verifikasi telah kedaluwarsa atau tidak valid.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('success', 'Email sudah diverifikasi.');
        }

        if ($user->markEmailAsVerified()) {
            // Update status menjadi aktif setelah verifikasi berhasil
            $user->update(['status' => true]);
            event(new Verified($user));
        }

        // Tampilkan pesan: "Akun berhasil diverifikasi. Silakan login."
        return redirect('/')->with('success', 'Akun berhasil diverifikasi. Silakan login.');
    }

    /**
     * Mengirim ulang email verifikasi.
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        if ($user->hasVerifiedEmail()) {
            return back()->with('success', 'Email Anda sudah terverifikasi.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Link verifikasi telah dikirim ulang ke email Anda.')->withInput(['email' => $request->email]);
    }
}

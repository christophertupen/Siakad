<?php

use App\Http\Controllers\MidtransController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\RegistrasiController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\Response;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    $settings = \App\Models\PengaturanWeb::firstOrCreate([]);

    $keunggulans = \App\Models\Keunggulan::where('status', true)->orderBy('order', 'asc')->get();
    $fiturAkademiks = \App\Models\FiturAkademik::where('status', true)->orderBy('order', 'asc')->get();
    $news = \App\Models\Berita::where('status_publish', true)->orderBy('tanggal', 'desc')->take(3)->get();
    $galleries = \App\Models\GalleryPhoto::where('is_active', true)
        ->whereHas('gallery', function ($query) {
            $query->where('is_active', true);
        })
        ->latest()
        ->take(8)
        ->get();
    $testimonials = \App\Models\Testimoni::where('status', true)->latest()->get();
    $faqs = \App\Models\Faq::where('status', true)->orderBy('order', 'asc')->get();

    $stats = [
        'siswa' => $settings->stats_mode === 'auto' ? \App\Models\Siswa::count() : ($settings->stats_siswa_manual ?? 0),
        'guru' => $settings->stats_mode === 'auto' ? \App\Models\Guru::count() : ($settings->stats_guru_manual ?? 0),
        'kelas' => $settings->stats_mode === 'auto' ? \App\Models\Kelas::count() : ($settings->stats_kelas_manual ?? 0),
        'alumni' => $settings->stats_alumni_manual ?? 0,
        'pendaftar' => \App\Models\Pendaftaran::count(),
    ];

    return view('landing.home', compact('settings', 'keunggulans', 'fiturAkademiks', 'news', 'galleries', 'testimonials', 'faqs', 'stats'));
});

Route::get('/midtrans/pay/{pembayaran}', [MidtransController::class, 'pay'])->name('midtrans.pay');

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/ppdb/daftar', [PPDBController::class, 'store'])->name('ppdb.store');

Route::post('/registrasi/akun', [RegistrasiController::class, 'register'])->name('registrasi.store');

// Email Verification Routes
Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\VerificationController::class, 'verify'])
    ->name('verification.verify');

Route::post('/email/resend', [\App\Http\Controllers\VerificationController::class, 'resend'])
    ->name('verification.send');

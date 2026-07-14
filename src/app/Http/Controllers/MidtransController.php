<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MidtransController extends Controller
{
    /**
     * Menampilkan halaman pembayaran Midtrans Snap.
     */
    protected \App\Services\MidtransService $midtransService;

    public function __construct(\App\Services\MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Menampilkan halaman pembayaran Midtrans Snap.
     */
    public function pay(Pembayaran $pembayaran): RedirectResponse
    {
        // Jika sudah lunas
        if ($pembayaran->status === 'Lunas') {
            return redirect()
                ->back()
                ->with('success', 'Pembayaran ini sudah lunas.');
        }

        try {
            $transaction = $this->midtransService->getOrCreateSnapTransaction($pembayaran);
            
            // Refresh model instance agar mendapatkan token baru
            $pembayaran->refresh();
        } catch (\Throwable $exception) {
            report($exception);
            return redirect()
                ->back()
                ->with('error', 'Gagal generate snap token: ' . $exception->getMessage());
        }

        $isProduction = (bool) config('midtrans.is_production');
        $baseUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v2/vtweb/' 
            : 'https://app.sandbox.midtrans.com/snap/v2/vtweb/';
            
        $paymentUrl = $baseUrl . $pembayaran->midtrans_token;

        return redirect()->away($paymentUrl);
    }
}
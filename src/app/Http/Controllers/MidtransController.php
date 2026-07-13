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
    public function pay(Pembayaran $pembayaran): View|RedirectResponse
    {
        // Jika belum generate token
        if (blank($pembayaran->midtrans_token)) {
            return redirect()
                ->back()
                ->with('error', 'Snap Token belum dibuat.');
        }

        // Jika sudah lunas
        if ($pembayaran->status === 'Lunas') {
            return redirect()
                ->back()
                ->with('success', 'Pembayaran ini sudah lunas.');
        }

        return view('midtrans.pay', [
            'pembayaran' => $pembayaran,
            'snapToken'  => $pembayaran->midtrans_token,
            'clientKey'  => config('midtrans.client_key'),
        ]);
    }
}
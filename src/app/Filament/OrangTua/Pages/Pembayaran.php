<?php

namespace App\Filament\OrangTua\Pages;

use Filament\Pages\Page;
use App\Models\Pembayaran as PembayaranModel;

class Pembayaran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static string $view = 'filament.orangtua.pages.pembayaran';
    protected static ?string $title = 'Informasi Pembayaran';
    protected static string $layout = 'layouts.orangtua';
    protected static bool $shouldRegisterNavigation = false;

    public function getViewData(): array
    {
        $user = auth()->user();
        $parent = $user->orangTua;
        $child = $parent ? $parent->siswa : null;

        $pembayarans = collect();
        $totalTagihan = 0;
        $totalTerbayar = 0;

        if ($child) {
            $pembayarans = PembayaranModel::where('siswa_id', $child->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $midtransService = app(\App\Services\MidtransService::class);
            $hasUpdates = false;

            foreach ($pembayarans->where('status', 'Pending')->whereNotNull('midtrans_order_id') as $p) {
                $oldStatus = $p->status;
                $newStatus = $midtransService->checkStatus($p);
                if ($oldStatus !== $newStatus) {
                    $hasUpdates = true;
                }
            }

            if ($hasUpdates) {
                $pembayarans = PembayaranModel::where('siswa_id', $child->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            $totalTagihan = $pembayarans->where('status', 'Pending')->sum('total');
            $totalTerbayar = $pembayarans->where('status', 'Lunas')->sum('total');
        }

        return [
            'pembayarans' => $pembayarans,
            'totalTagihan' => $totalTagihan,
            'totalTerbayar' => $totalTerbayar,
        ];
    }
}

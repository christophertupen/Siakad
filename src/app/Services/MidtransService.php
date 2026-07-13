<?php

namespace App\Services;

use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use RuntimeException;

class MidtransService
{
    public function __construct()
    {
        $this->configure();
    }

    public function configure(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = (bool) config('midtrans.is_production');
        Config::$isSanitized = (bool) config('midtrans.is_sanitized');
        Config::$is3ds = (bool) config('midtrans.is_3ds');

        $this->ensureConfigured();
    }

    public function isConfigured(): bool
    {
        return filled(config('midtrans.server_key')) && filled(config('midtrans.client_key'));
    }

    public function generateOrderId(Pembayaran $pembayaran): string
    {
        return sprintf(
            'SIAKAD-%s-%s-%s',
            $pembayaran->getKey(),
            now()->format('YmdHis'),
            Str::upper(Str::random(6)),
        );
    }

    private function ensureConfigured(): void
    {
        if ($this->isConfigured()) {
            return;
        }

        throw new RuntimeException('MIDTRANS_SERVER_KEY dan MIDTRANS_CLIENT_KEY belum diisi di file .env.');
    }

    /**
     * @return array{order_id: string, snap_token: string, params: array<string, mixed>}
     */
    public function createSnapTransaction(Pembayaran $pembayaran): array
    {
        $orderId = $this->generateOrderId($pembayaran);
        $params = $this->buildTransactionParams($pembayaran, $orderId);

        return [
            'order_id' => $orderId,
            'snap_token' => $this->generateSnapToken($params),
            'params' => $params,
        ];
    }

    /**
     * @param  array<string, mixed>  $params
     */
    public function generateSnapToken(array $params): string
    {
        return Snap::getSnapToken($params);
    }

    /**
     * @return array<string, mixed>
     */
    private function buildTransactionParams(Pembayaran $pembayaran, string $orderId): array
    {
        $pembayaran->loadMissing('siswa');

        $itemName = trim(collect([
            $pembayaran->kategori,
            $pembayaran->bulan,
            $pembayaran->jenis_item,
            $pembayaran->ukuran,
        ])->filter()->implode(' - '));

        return [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) round((float) $pembayaran->total),
            ],
            'item_details' => [
                [
                    'id' => (string) $pembayaran->getKey(),
                    'price' => (int) round((float) $pembayaran->total),
                    'quantity' => 1,
                    'name' => $itemName !== '' ? $itemName : 'Tagihan SIAKAD',
                ],
            ],
            'customer_details' => [
                'first_name' => $pembayaran->siswa?->nama ?? 'Siswa',
                'phone' => $pembayaran->siswa?->nomor_hp,
            ],
        ];
    }
}

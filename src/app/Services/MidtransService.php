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
    }

    public function isConfigured(): bool
    {
        return filled(config('midtrans.server_key')) && filled(config('midtrans.client_key'));
    }

    public function generateOrderId(Pembayaran $pembayaran): string
    {
        return sprintf(
            'SchonaNexa-%s-%s-%s',
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
    public function getOrCreateSnapTransaction(Pembayaran $pembayaran): array
    {
        if (filled($pembayaran->midtrans_token)) {
            return [
                'order_id' => $pembayaran->midtrans_order_id,
                'snap_token' => $pembayaran->midtrans_token,
            ];
        }

        return \Illuminate\Support\Facades\DB::transaction(function () use ($pembayaran) {
            $transaction = $this->createSnapTransaction($pembayaran);

            $pembayaran->update([
                'midtrans_order_id' => $transaction['order_id'],
                'midtrans_token' => $transaction['snap_token'],
                'status' => 'Pending',
            ]);

            return $transaction;
        });
    }

    /**
     * @return array{order_id: string, snap_token: string, params: array<string, mixed>}
     */
    public function createSnapTransaction(Pembayaran $pembayaran): array
    {
        $this->ensureConfigured();

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
                    'name' => $itemName !== '' ? $itemName : 'Tagihan SchonaNexa',
                ],
            ],
            'customer_details' => [
                'first_name' => $pembayaran->siswa?->nama ?? 'Siswa',
                'phone' => $pembayaran->siswa?->nomor_hp,
            ],
        ];
    }

    public function checkStatus(Pembayaran $pembayaran): string
    {
        $this->configure();

        if (blank($pembayaran->midtrans_order_id)) {
            return $pembayaran->status;
        }

        try {
            $statusResponse = \Midtrans\Transaction::status($pembayaran->midtrans_order_id);
            // Convert Midtrans response object/array to standard array
            $statusResponseArray = json_decode(json_encode($statusResponse), true);

            $transactionStatus = $statusResponseArray['transaction_status'] ?? null;
            $fraudStatus = $statusResponseArray['fraud_status'] ?? null;

            // Resolve status
            $status = $pembayaran->status;
            if ($transactionStatus === 'capture') {
                $status = $fraudStatus === 'accept' ? 'Lunas' : 'Pending';
            } else {
                $status = match ($transactionStatus) {
                    'settlement' => 'Lunas',
                    'pending' => 'Pending',
                    'deny', 'cancel', 'expire', 'failure' => 'Gagal',
                    default => $pembayaran->status,
                };
            }

            \Illuminate\Support\Facades\DB::transaction(function () use ($pembayaran, $status, $statusResponseArray) {
                $pembayaran->update([
                    'status' => $status,
                    'metode_pembayaran' => $statusResponseArray['payment_type'] ?? $pembayaran->metode_pembayaran,
                    'midtrans_transaction_id' => $statusResponseArray['transaction_id'] ?? $pembayaran->midtrans_transaction_id,
                    'midtrans_payment_type' => $statusResponseArray['payment_type'] ?? $pembayaran->midtrans_payment_type,
                    'midtrans_transaction_status' => $statusResponseArray['transaction_status'] ?? $pembayaran->midtrans_transaction_status,
                    'midtrans_response' => json_encode($statusResponseArray),
                    'tanggal_bayar' => $status === 'Lunas' ? now() : $pembayaran->tanggal_bayar,
                ]);
            });

            return $status;
        } catch (\Throwable $e) {
            report($e);
            return $pembayaran->status;
        }
    }
}

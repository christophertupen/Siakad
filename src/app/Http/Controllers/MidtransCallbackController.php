<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MidtransCallbackController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $payload = $request->all();

        if (! $this->isValidSignature($payload)) {
            return response()->json([
                'message' => 'Invalid signature',
            ], 403);
        }

        $orderId = $payload['order_id'] ?? null;

        if (! $orderId) {
            return response()->json([
                'message' => 'Order ID not found',
            ], 422);
        }

        $pembayaran = Pembayaran::query()
            ->where('midtrans_order_id', $orderId)
            ->first();

        if (! $pembayaran) {
            return response()->json([
                'message' => 'Pembayaran not found',
            ], 404);
        }

        DB::transaction(function () use ($pembayaran, $payload): void {
            $transactionStatus = $payload['transaction_status'] ?? null;
            $fraudStatus = $payload['fraud_status'] ?? null;
            $status = $this->resolvePaymentStatus($transactionStatus, $fraudStatus);

            $pembayaran->update([
                'status' => $status,
                'metode_pembayaran' => $payload['payment_type'] ?? $pembayaran->metode_pembayaran,
                'midtrans_transaction_id' => $payload['transaction_id'] ?? $pembayaran->midtrans_transaction_id,
                'midtrans_payment_type' => $payload['payment_type'] ?? $pembayaran->midtrans_payment_type,
                'midtrans_transaction_status' => $transactionStatus ?? $pembayaran->midtrans_transaction_status,
                'midtrans_response' => json_encode($payload),
                'tanggal_bayar' => $status === 'Lunas'
                    ? now()
                    : $pembayaran->tanggal_bayar,
            ]);
        });

        return response()->json([
            'message' => 'Callback processed',
        ]);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function isValidSignature(array $payload): bool
    {
        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;

        if (! $orderId || ! $statusCode || ! $grossAmount || ! $signatureKey) {
            return false;
        }

        $serverKey = config('midtrans.server_key');

        if (! $serverKey) {
            return false;
        }

        $validSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return hash_equals($validSignature, $signatureKey);
    }

    private function resolvePaymentStatus(?string $transactionStatus, ?string $fraudStatus): string
    {
        if ($transactionStatus === 'capture') {
            return $fraudStatus === 'accept' ? 'Lunas' : 'Pending';
        }

        return match ($transactionStatus) {
            'settlement' => 'Lunas',
            'pending' => 'Pending',
            'deny', 'cancel', 'expire', 'failure' => 'Gagal',
            default => 'Pending',
        };
    }
}

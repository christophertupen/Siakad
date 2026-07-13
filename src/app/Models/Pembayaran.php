<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'tahun_ajaran',
        'kategori',
        'bulan',
        'jenis_item',
        'ukuran',
        'jumlah',
        'harga',
        'total',
        'status',
        'metode_pembayaran',
        'midtrans_order_id',
        'midtrans_token',
        'midtrans_transaction_id',
        'midtrans_payment_type',
        'midtrans_transaction_status',
        'bukti_pembayaran',
        'catatan',
        'tanggal_bayar',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'total' => 'decimal:2',
        'tanggal_bayar' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'Lunas' => 'success',
            'Pending' => 'warning',
            'Gagal' => 'danger',
            default => 'gray',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    */

    public function isLunas(): bool
    {
        return $this->status === 'Lunas';
    }

    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }

    public function isGagal(): bool
    {
        return $this->status === 'Gagal';
    }
}

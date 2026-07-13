<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'orang_tua_id',
        'siswa_id',
        'kelas_id',
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

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'orang_tua_id');
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
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
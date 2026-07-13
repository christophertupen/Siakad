<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            // Orang Tua
            $table->foreignId('orang_tua_id')
                ->constrained('orang_tuas')
                ->cascadeOnDelete();

            // Siswa
            $table->foreignId('siswa_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Data Pembayaran
            |--------------------------------------------------------------------------
            */

            $table->string('tahun_ajaran');

            $table->enum('kategori', [
                'SPP',
                'Buku',
                'Seragam',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Khusus SPP
            |--------------------------------------------------------------------------
            */

            $table->enum('bulan', [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ])->nullable();

            /*
            |--------------------------------------------------------------------------
            | Khusus Buku / Seragam
            |--------------------------------------------------------------------------
            */

            $table->string('jenis_item')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Khusus Seragam
            |--------------------------------------------------------------------------
            */

            $table->enum('ukuran', [
                'S',
                'M',
                'L',
                'XL',
                'XXL',
            ])->nullable();

            /*
            |--------------------------------------------------------------------------
            | Nominal
            |--------------------------------------------------------------------------
            */

            $table->integer('jumlah')->default(1);

            $table->decimal('harga', 12, 2);

            $table->decimal('total', 12, 2);

            /*
            |--------------------------------------------------------------------------
            | Status Pembayaran
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'Pending',
                'Lunas',
                'Gagal',
            ])->default('Pending');

            /*
            |--------------------------------------------------------------------------
            | Midtrans
            |--------------------------------------------------------------------------
            */

            // Contoh:
            // bank_transfer
            // qris
            // gopay
            // shopeepay
            // cstore
            $table->string('metode_pembayaran')->nullable();

            $table->string('midtrans_order_id')->nullable();

            $table->string('midtrans_token')->nullable();

            $table->string('midtrans_transaction_id')->nullable();

            $table->string('midtrans_payment_type')->nullable();

            $table->string('midtrans_transaction_status')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Manual Payment (Optional)
            |--------------------------------------------------------------------------
            */

            $table->string('bukti_pembayaran')->nullable();

            $table->text('catatan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Waktu Pembayaran
            |--------------------------------------------------------------------------
            */

            $table->timestamp('tanggal_bayar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
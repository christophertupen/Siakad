<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            // Siswa
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            // Jadwal Pelajaran
            $table->foreignId('jadwal_pelajaran_id')
                ->constrained('jadwal_pelajarans')
                ->cascadeOnDelete();

            // Mata Pelajaran
            $table->foreignId('mata_pelajaran_id')
                ->constrained('mata_pelajarans')
                ->cascadeOnDelete();

            // Tanggal Absensi
            $table->date('tanggal');

            // Status Kehadiran
            $table->enum('status', [
                'Hadir',
                'Izin',
                'Sakit',
                'Alpha',
            ]);

            // Catatan Guru
            $table->text('keterangan')->nullable();

            // Mencegah absensi ganda
            $table->unique([
                'siswa_id',
                'jadwal_pelajaran_id',
                'tanggal',
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};

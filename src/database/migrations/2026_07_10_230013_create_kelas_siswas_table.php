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
        Schema::create('kelas_siswa', function (Blueprint $table) {

            $table->id();

            // Data Siswa
            $table->string('nama_siswa');
            $table->string('nis')->unique();

            // Kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnDelete();

            // Orang Tua (Opsional)
            $table->foreignId('orang_tua_id')
                ->nullable()
                ->constrained('orang_tuas')
                ->nullOnDelete();

            // Akademik
            $table->string('no_absen')->nullable();

            $table->string('tahun_ajaran');

            $table->enum('semester', [
                'Ganjil',
                'Genap',
            ]);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_siswa');
    }
};
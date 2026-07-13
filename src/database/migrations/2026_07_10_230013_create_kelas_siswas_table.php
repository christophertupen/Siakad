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

            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();

            // Kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnDelete();

            // Akademik
            $table->string('no_absen')->nullable();

            $table->string('tahun_ajaran');

            $table->enum('semester', [
                'Ganjil',
                'Genap',
            ]);

            $table->boolean('status')->default(true);

            $table->unique(['siswa_id', 'kelas_id', 'tahun_ajaran', 'semester']);

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

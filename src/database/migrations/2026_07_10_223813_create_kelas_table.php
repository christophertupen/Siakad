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
        Schema::create('kelas', function (Blueprint $table) {

            $table->id();

            // Nama kelas
            $table->string('nama_kelas');

            // Tingkat
            $table->enum('tingkat', [
                'X',
                'XI',
                'XII',
            ]);

            // Tahun ajaran
            $table->string('tahun_ajaran');

            // Wali kelas
            $table->foreignId('wali_kelas_id')
                ->nullable()
                ->constrained('gurus')
                ->nullOnDelete();

            // Status
            $table->boolean('status')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
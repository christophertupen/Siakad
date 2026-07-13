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
        Schema::create('rapors', function (Blueprint $table) {
            $table->id();

            // Siswa
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            // Wali Kelas
            $table->foreignId('guru_id')
                ->constrained('gurus')
                ->cascadeOnDelete();

            // Tahun Ajaran
            $table->string('tahun_ajaran');

            // Semester
            $table->enum('semester', [
                'Ganjil',
                'Genap',
            ]);

            // Hasil Perhitungan
            $table->decimal('total_nilai', 8, 2)->default(0);

            $table->decimal('rata_rata', 5, 2)->default(0);

            // Ranking
            $table->integer('peringkat')->nullable();

            // Catatan Wali Kelas
            $table->text('catatan_wali_kelas')->nullable();

            // Status
            $table->enum('status', [
                'Naik',
                'Tidak Naik',
                'Lulus',
            ])->default('Naik');

            // File PDF
            $table->string('file_pdf')->nullable();

            // Satu siswa hanya boleh memiliki satu rapor
            // pada semester dan tahun ajaran yang sama
            $table->unique([
                'siswa_id',
                'tahun_ajaran',
                'semester',
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapors');
    }
};

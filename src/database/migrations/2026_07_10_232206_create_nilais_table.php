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
            Schema::create('nilais', function (Blueprint $table) {
                $table->id();
                $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
                $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
                $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
                $table->decimal("nilai_tugas", 5, 2);
                $table->decimal("nilai_uts", 5, 2);
                $table->decimal("nilai_uas", 5, 2);
                $table->decimal("nilai_akhir", 5, 2);
                $table->string('predikat')->nullable();
                $table->text('catatan')->nullable();   
                $table->string('tahun_ajaran');
                $table->enum('semester', [
                    'Ganjil',
                    'Genap',
                ]);
                
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('nilais');
        }
    };

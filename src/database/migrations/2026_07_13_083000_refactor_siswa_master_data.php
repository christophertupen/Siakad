<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas_siswa', function (Blueprint $table) {
            $table->foreignId('siswa_id')->nullable()->after('id');
        });

        DB::table('kelas_siswa')->orderBy('id')->each(function (object $kelasSiswa): void {
            $siswaId = DB::table('siswas')->insertGetId([
                'nis' => $kelasSiswa->nis,
                'nama' => $kelasSiswa->nama_siswa,
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_masuk' => now()->toDateString(),
                'status' => $kelasSiswa->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('kelas_siswa')->where('id', $kelasSiswa->id)->update(['siswa_id' => $siswaId]);
        });

        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->foreignId('siswa_id')->nullable()->after('id')->constrained('siswas')->cascadeOnDelete();
        });

        DB::statement('UPDATE orang_tuas INNER JOIN kelas_siswa ON kelas_siswa.orang_tua_id = orang_tuas.id SET orang_tuas.siswa_id = kelas_siswa.siswa_id');

        Schema::table('kelas_siswa', function (Blueprint $table) {
            $table->dropForeign(['orang_tua_id']);
            $table->dropUnique(['nis']);
            $table->dropColumn(['nama_siswa', 'nis', 'orang_tua_id']);
            $table->foreign('siswa_id')->references('id')->on('siswas')->cascadeOnDelete();
        });

        foreach (['pengumpulan_tugas', 'nilais', 'rapors', 'absensis', 'pembayarans'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['siswa_id']);
                $table->foreign('siswa_id')->references('id')->on('siswas')->cascadeOnDelete();
            });
        }

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });

        Schema::table('rapors', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropForeign(['orang_tua_id']);
            $table->dropForeign(['kelas_id']);
            $table->dropColumn(['orang_tua_id', 'kelas_id']);
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->foreignId('guru_id')->nullable()->after('id')->constrained('gurus')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tugas', fn (Blueprint $table) => $table->dropConstrainedForeignId('guru_id'));
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->foreignId('orang_tua_id')->nullable()->constrained('orang_tuas')->nullOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
        });
        Schema::table('rapors', fn (Blueprint $table) => $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete());
        Schema::table('nilais', fn (Blueprint $table) => $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete());
    }
};

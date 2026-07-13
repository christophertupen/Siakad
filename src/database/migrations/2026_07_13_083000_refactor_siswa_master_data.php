<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('kelas_siswa', 'siswa_id')) {
            Schema::table('kelas_siswa', function (Blueprint $table) {
                $table->foreignId('siswa_id')->nullable()->after('id');
            });
        }

        if (
            Schema::hasColumn('kelas_siswa', 'nama_siswa')
            && Schema::hasColumn('kelas_siswa', 'nis')
        ) {
            DB::table('kelas_siswa')
                ->whereNull('siswa_id')
                ->orderBy('id')
                ->each(function (object $kelasSiswa): void {
                    $siswaId = DB::table('siswas')->where('nis', $kelasSiswa->nis)->value('id');

                    if (! $siswaId) {
                        $siswaId = DB::table('siswas')->insertGetId([
                            'nis' => $kelasSiswa->nis,
                            'nama' => $kelasSiswa->nama_siswa,
                            'jenis_kelamin' => 'Laki-laki',
                            'tanggal_masuk' => now()->toDateString(),
                            'status' => $kelasSiswa->status,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    DB::table('kelas_siswa')
                        ->where('id', $kelasSiswa->id)
                        ->update(['siswa_id' => $siswaId]);
                });
        }

        if (! Schema::hasColumn('orang_tuas', 'siswa_id')) {
            Schema::table('orang_tuas', function (Blueprint $table) {
                $table->foreignId('siswa_id')->nullable()->after('id')->constrained('siswas')->cascadeOnDelete();
            });
        }

        if (Schema::hasColumn('kelas_siswa', 'orang_tua_id')) {
            DB::statement('
                UPDATE orang_tuas
                INNER JOIN kelas_siswa ON kelas_siswa.orang_tua_id = orang_tuas.id
                SET orang_tuas.siswa_id = kelas_siswa.siswa_id
            ');
        }

        if (Schema::hasColumn('kelas_siswa', 'orang_tua_id')) {
            $this->dropForeignKey('kelas_siswa', 'orang_tua_id');
        }

        if (Schema::hasColumn('kelas_siswa', 'nis')) {
            $this->dropUniqueIndex('kelas_siswa', 'nis');
        }

        $kelasSiswaLegacyColumns = array_values(array_filter([
            Schema::hasColumn('kelas_siswa', 'nama_siswa') ? 'nama_siswa' : null,
            Schema::hasColumn('kelas_siswa', 'nis') ? 'nis' : null,
            Schema::hasColumn('kelas_siswa', 'orang_tua_id') ? 'orang_tua_id' : null,
        ]));

        if ($kelasSiswaLegacyColumns !== []) {
            Schema::table('kelas_siswa', function (Blueprint $table) use ($kelasSiswaLegacyColumns) {
                $table->dropColumn($kelasSiswaLegacyColumns);
            });
        }

        if (! $this->foreignKeyReferences('kelas_siswa', 'siswa_id', 'siswas')) {
            $this->dropForeignKey('kelas_siswa', 'siswa_id');

            Schema::table('kelas_siswa', function (Blueprint $table) {
                $table->foreign('siswa_id')->references('id')->on('siswas')->cascadeOnDelete();
            });
        }

        foreach (['pengumpulan_tugas', 'nilais', 'rapors', 'absensis', 'pembayarans'] as $tableName) {
            if (! Schema::hasColumn($tableName, 'siswa_id')) {
                continue;
            }

            if ($this->foreignKeyReferences($tableName, 'siswa_id', 'siswas')) {
                continue;
            }

            $this->dropForeignKey($tableName, 'siswa_id');

            Schema::table($tableName, function (Blueprint $table) {
                $table->foreign('siswa_id')->references('id')->on('siswas')->cascadeOnDelete();
            });
        }

        $this->dropColumnIfExists('nilais', 'kelas_id');
        $this->dropColumnIfExists('rapors', 'kelas_id');
        $this->dropColumnIfExists('pembayarans', 'orang_tua_id');
        $this->dropColumnIfExists('pembayarans', 'kelas_id');

        if (! Schema::hasColumn('tugas', 'guru_id')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->foreignId('guru_id')->nullable()->after('id')->constrained('gurus')->nullOnDelete();
            });
        } elseif (! $this->foreignKeyReferences('tugas', 'guru_id', 'gurus')) {
            $this->dropForeignKey('tugas', 'guru_id');

            Schema::table('tugas', function (Blueprint $table) {
                $table->foreign('guru_id')->references('id')->on('gurus')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        //
    }

    private function dropColumnIfExists(string $tableName, string $columnName): void
    {
        if (! Schema::hasColumn($tableName, $columnName)) {
            return;
        }

        $this->dropForeignKey($tableName, $columnName);

        Schema::table($tableName, function (Blueprint $table) use ($columnName) {
            $table->dropColumn($columnName);
        });
    }

    private function dropForeignKey(string $tableName, string $columnName): void
    {
        $constraintName = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', $tableName)
            ->where('COLUMN_NAME', $columnName)
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');

        if (! $constraintName) {
            return;
        }

        DB::statement(sprintf(
            'ALTER TABLE `%s` DROP FOREIGN KEY `%s`',
            str_replace('`', '``', $tableName),
            str_replace('`', '``', $constraintName)
        ));
    }

    private function dropUniqueIndex(string $tableName, string $columnName): void
    {
        $indexName = DB::table('information_schema.STATISTICS')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', $tableName)
            ->where('COLUMN_NAME', $columnName)
            ->where('NON_UNIQUE', 0)
            ->where('INDEX_NAME', '!=', 'PRIMARY')
            ->value('INDEX_NAME');

        if (! $indexName) {
            return;
        }

        DB::statement(sprintf(
            'ALTER TABLE `%s` DROP INDEX `%s`',
            str_replace('`', '``', $tableName),
            str_replace('`', '``', $indexName)
        ));
    }

    private function foreignKeyReferences(string $tableName, string $columnName, string $referencedTableName): bool
    {
        return DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::getDatabaseName())
            ->where('TABLE_NAME', $tableName)
            ->where('COLUMN_NAME', $columnName)
            ->where('REFERENCED_TABLE_NAME', $referencedTableName)
            ->exists();
    }
};

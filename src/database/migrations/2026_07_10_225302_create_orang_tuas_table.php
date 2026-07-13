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
        Schema::create('orang_tuas', function (Blueprint $table) {

            $table->id();

            // Relasi ke akun user
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Data Orang Tua
            $table->string('nik')->unique();

            $table->string('nama');

            $table->enum('hubungan', [
                'Ayah',
                'Ibu',
                'Wali',
            ]);

            $table->string('pekerjaan')->nullable();

            $table->string('nomor_telepon', 20);

            $table->text('alamat')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tuas');
    }
};
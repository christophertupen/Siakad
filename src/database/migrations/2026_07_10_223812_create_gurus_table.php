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
        Schema::create('gurus', function (Blueprint $table) {

            $table->id();

            // Relasi ke akun login
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Identitas Guru
            $table->string('nip')->unique();

            $table->string('nama');

            $table->string('gelar')->nullable();

            $table->string('pendidikan_terakhir')->nullable();

            $table->string('bidang_keahlian')->nullable();

            // Status Guru
            $table->boolean('confirmed')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
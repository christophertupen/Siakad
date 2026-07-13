<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konten_webs', function (Blueprint $table) {

            $table->id();

            $table->string('nama_sekolah');

            $table->string('logo')->nullable();

            $table->string('email')->nullable();

            $table->string('telepon')->nullable();

            $table->text('alamat')->nullable();

            $table->text('visi')->nullable();

            $table->text('misi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konten_webs');
    }
};
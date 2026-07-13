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
        Schema::create('pengaturan_webs', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Identitas Sekolah
            |--------------------------------------------------------------------------
            */

            $table->string('nama_sekolah');

            $table->string('nama_aplikasi')->default('SIAKAD SMK');

            $table->string('npsn')->nullable();

            $table->enum('jenjang', [
                'SMK',
            ])->default('SMK');

            $table->enum('status_sekolah', [
                'Negeri',
                'Swasta',
            ])->nullable();

            $table->string('akreditasi')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Kepala Sekolah
            |--------------------------------------------------------------------------
            */

            $table->string('kepala_sekolah')->nullable();

            $table->string('nip_kepala_sekolah')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Branding Website
            |--------------------------------------------------------------------------
            */

            $table->string('logo')->nullable();

            $table->string('favicon')->nullable();

            $table->string('background_login')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Kontak
            |--------------------------------------------------------------------------
            */

            $table->string('email')->nullable();

            $table->string('telepon')->nullable();

            $table->string('website')->nullable();

            $table->text('alamat')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Profil Sekolah
            |--------------------------------------------------------------------------
            */

            $table->longText('visi')->nullable();

            $table->longText('misi')->nullable();

            $table->longText('deskripsi')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Sosial Media
            |--------------------------------------------------------------------------
            */

            $table->string('facebook')->nullable();

            $table->string('instagram')->nullable();

            $table->string('youtube')->nullable();

            $table->string('tiktok')->nullable();

            $table->string('whatsapp')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Lokasi
            |--------------------------------------------------------------------------
            */

            $table->text('google_maps')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Website
            |--------------------------------------------------------------------------
            */

            $table->string('copyright')
                ->default('© SIAKAD SMK');

            $table->boolean('maintenance_mode')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_webs');
    }
};
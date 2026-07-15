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
        Schema::table('pengaturan_webs', function (Blueprint $table) {
            // Hero Section
            $table->string('hero_headline')->nullable();
            $table->string('hero_subheadline')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_button1_text')->nullable();
            $table->string('hero_button1_url')->nullable();
            $table->string('hero_button2_text')->nullable();
            $table->string('hero_button2_url')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_background_image')->nullable();
            $table->string('hero_floating_card1_title')->nullable();
            $table->string('hero_floating_card1_desc')->nullable();
            $table->string('hero_floating_card2_title')->nullable();
            $table->string('hero_floating_card2_desc')->nullable();

            // Statistics Settings
            $table->string('stats_mode')->default('manual'); // 'auto' or 'manual'
            $table->integer('stats_siswa_manual')->default(0);
            $table->integer('stats_guru_manual')->default(0);
            $table->integer('stats_kelas_manual')->default(0);
            $table->integer('stats_alumni_manual')->default(0);

            // CTA Section
            $table->string('cta_heading')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_background')->nullable();

            // SEO Settings
            $table->string('seo_meta_title')->nullable();
            $table->text('seo_meta_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_og_image')->nullable();

            // Themes/Colors
            $table->string('primary_color')->default('#2563EB');
            $table->string('secondary_color')->default('#0F172A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_webs', function (Blueprint $table) {
            $table->dropColumn([
                'hero_headline',
                'hero_subheadline',
                'hero_description',
                'hero_button1_text',
                'hero_button1_url',
                'hero_button2_text',
                'hero_button2_url',
                'hero_image',
                'hero_background_image',
                'hero_floating_card1_title',
                'hero_floating_card1_desc',
                'hero_floating_card2_title',
                'hero_floating_card2_desc',
                'stats_mode',
                'stats_siswa_manual',
                'stats_guru_manual',
                'stats_kelas_manual',
                'stats_alumni_manual',
                'cta_heading',
                'cta_description',
                'cta_button_text',
                'cta_button_url',
                'cta_background',
                'seo_meta_title',
                'seo_meta_description',
                'seo_keywords',
                'seo_og_image',
                'primary_color',
                'secondary_color',
            ]);
        });
    }
};

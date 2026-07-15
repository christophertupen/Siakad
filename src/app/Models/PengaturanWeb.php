<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanWeb extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'nama_aplikasi',
        'npsn',
        'jenjang',
        'status_sekolah',
        'akreditasi',

        'kepala_sekolah',
        'nip_kepala_sekolah',

        'logo',
        'favicon',
        'background_login',

        'email',
        'telepon',
        'website',
        'alamat',

        'visi',
        'misi',
        'deskripsi',

        'facebook',
        'instagram',
        'youtube',
        'tiktok',
        'whatsapp',

        'google_maps',

        'copyright',
        'maintenance_mode',

        // Hero Section
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

        // Statistics Settings
        'stats_mode',
        'stats_siswa_manual',
        'stats_guru_manual',
        'stats_kelas_manual',
        'stats_alumni_manual',

        // CTA Section
        'cta_heading',
        'cta_description',
        'cta_button_text',
        'cta_button_url',
        'cta_background',

        // SEO Settings
        'seo_meta_title',
        'seo_meta_description',
        'seo_keywords',
        'seo_og_image',

        // Themes/Colors
        'primary_color',
        'secondary_color',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
        'stats_siswa_manual' => 'integer',
        'stats_guru_manual' => 'integer',
        'stats_kelas_manual' => 'integer',
        'stats_alumni_manual' => 'integer',
    ];
}
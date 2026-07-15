<?php

namespace Database\Seeders;

use App\Models\PengaturanWeb;
use App\Models\Keunggulan;
use App\Models\FiturAkademik;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Testimoni;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class PengaturanWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed PengaturanWeb
        PengaturanWeb::updateOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'SIAKAD SMK Unggul',
                'nama_aplikasi' => 'SIAKAD Premium',
                'npsn' => '10293847',
                'jenjang' => 'SMK',
                'status_sekolah' => 'Negeri',
                'akreditasi' => 'A (Amat Baik)',
                'kepala_sekolah' => 'Drs. H. Mulyadi, M.Pd',
                'nip_kepala_sekolah' => '197205121998031002',
                'logo' => null,
                'favicon' => null,
                'background_login' => null,
                'email' => 'info@siakad.sch.id',
                'telepon' => '(021) 1234-5678',
                'website' => 'https://siakad.test',
                'alamat' => 'Jl. Pendidikan Raya No. 45, Jakarta, Indonesia',
                'google_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.71966530669!2d106.827153!3d-6.175392" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'facebook' => 'https://facebook.com/siakad.sch',
                'instagram' => 'https://instagram.com/siakad.sch',
                'youtube' => 'https://youtube.com/c/siakad.sch',
                'tiktok' => 'https://tiktok.com/@siakad.sch',
                'whatsapp' => 'https://wa.me/628123456789',
                'copyright' => '© 2026 SIAKAD.test. Seluruh hak cipta dilindungi undang-undang.',
                'maintenance_mode' => false,

                // Hero Section
                'hero_headline' => 'Masa Depan Akademik Digital yang Terintegrasi',
                'hero_subheadline' => 'SIAKAD 2.0 Premium',
                'hero_description' => 'Transformasi pengelolaan sekolah Anda dengan platform digital modern terpadu. Hubungkan administrasi, guru, siswa, dan orang tua dalam satu ekosistem yang pintar dan efisien.',
                'hero_button1_text' => 'Mulai Sekarang',
                'hero_button1_url' => '/login',
                'hero_button2_text' => 'Pelajari Lebih Lanjut',
                'hero_button2_url' => '#school-profile',
                'hero_image' => null,
                'hero_background_image' => null,
                'hero_floating_card1_title' => 'Prestasi Akademik',
                'hero_floating_card1_desc' => 'Juara 1 Lomba Sains',
                'hero_floating_card2_title' => 'Status Kehadiran',
                'hero_floating_card2_desc' => 'Siswa Hadir: 99.1%',

                // Statistics
                'stats_mode' => 'manual',
                'stats_siswa_manual' => 1500,
                'stats_guru_manual' => 80,
                'stats_kelas_manual' => 45,
                'stats_alumni_manual' => 2500,

                // CTA Section
                'cta_heading' => 'Siap Memulai Digitalisasi Pendidikan Sekarang?',
                'cta_description' => 'Masuk ke dalam ekosistem sistem informasi akademik pintar. Mari tingkatkan kinerja administrasi sekolah Anda agar lebih produktif, transparan, dan terukur.',
                'cta_button_text' => 'Masuk ke Dashboard',
                'cta_button_url' => '/login',
                'cta_background' => null,

                // SEO
                'seo_meta_title' => 'SIAKAD - Sistem Informasi Akademik Modern',
                'seo_meta_description' => 'Sistem Informasi Akademik SIAKAD - Platform digitalisasi pendidikan terintegrasi untuk guru, siswa, dan orang tua.',
                'seo_keywords' => 'siakad, sekolah, akademik, lms, spp online',
                'seo_og_image' => null,

                // Theme
                'primary_color' => '#2563EB',
                'secondary_color' => '#0F172A',
            ]
        );

        // 2. Seed Keunggulans
        $keunggulans = [
            [
                'title' => 'Kurikulum Adaptif',
                'description' => 'Penyusunan kurikulum dan jadwal mata pelajaran interaktif yang fleksibel.',
                'icon' => 'fa-graduation-cap',
                'order' => 1,
            ],
            [
                'title' => 'Laporan Real-Time',
                'description' => 'Nilai ujian, rapor berkala, dan rekap absensi harian dapat langsung diakses.',
                'icon' => 'fa-chart-line',
                'order' => 2,
            ],
            [
                'title' => 'Platform Terpadu',
                'description' => 'Satu database tunggal yang menyatukan panel Admin, Guru, Siswa, hingga Wali Murid.',
                'icon' => 'fa-users',
                'order' => 3,
            ],
            [
                'title' => 'Keamanan Enkripsi',
                'description' => 'Perlindungan data sensitif dan personal menggunakan protokol enkripsi standar industri.',
                'icon' => 'fa-shield-halved',
                'order' => 4,
            ],
        ];

        foreach ($keunggulans as $k) {
            Keunggulan::updateOrCreate(['title' => $k['title']], $k);
        }

        // 3. Seed Fitur Akademiks
        $fitur = [
            [
                'title' => 'Grade & Performance Analytics',
                'description' => 'Pantau riwayat perkembangan prestasi belajar siswa dari awal semester hingga kelulusan secara presisi.',
                'icon' => 'fa-chart-simple',
                'order' => 1,
            ],
            [
                'title' => 'Notification Alerts',
                'description' => 'Dapatkan pemberitahuan seketika untuk tugas baru, tagihan sekolah, hingga rekap kehadiran langsung ke perangkat.',
                'icon' => 'fa-bell',
                'order' => 2,
            ],
            [
                'title' => 'Parent Messaging Channel',
                'description' => 'Saluran komunikasi tertutup dan aman antara wali murid dengan guru kelas untuk memantau perilaku belajar.',
                'icon' => 'fa-comments',
                'order' => 3,
            ],
        ];

        foreach ($fitur as $f) {
            FiturAkademik::updateOrCreate(['title' => $f['title']], $f);
        }

        // 4. Seed Beritas
        $beritas = [
            [
                'title' => 'Penerimaan Siswa Baru (PPDB) Tahun Ajaran 2026/2027 Resmi Dibuka',
                'slug' => 'ppdb-2026-2027-dibuka',
                'kategori' => 'Event',
                'tanggal' => '2026-07-14',
                'author' => 'Admin',
                'content' => 'Sekolah kami secara resmi membuka jalur pendaftaran siswa baru secara online menggunakan portal SIAKAD terintegrasi.',
                'status_publish' => true,
                'featured' => true,
            ],
            [
                'title' => 'Siswa Perwakilan Sekolah Raih Medali Emas Olimpiade Sains Nasional',
                'slug' => 'medali-emas-olimpiade-sains',
                'kategori' => 'Prestasi',
                'tanggal' => '2026-07-08',
                'author' => 'Admin',
                'content' => 'Selamat atas prestasi gemilang Ananda Budi Santoso yang berhasil memboyong medali emas di bidang Fisika Terapan.',
                'status_publish' => true,
                'featured' => false,
            ],
            [
                'title' => 'Implementasi Kartu Absensi Pintar dengan Enkripsi Digital RFID',
                'slug' => 'kartu-absensi-rfid-digital',
                'kategori' => 'Teknologi',
                'tanggal' => '2026-07-01',
                'author' => 'Admin',
                'content' => 'Sekolah resmi meluncurkan pembaruan perangkat absensi elektronik menggunakan sistem enkripsi nirkabel.',
                'status_publish' => true,
                'featured' => false,
            ],
        ];

        foreach ($beritas as $b) {
            Berita::updateOrCreate(['slug' => $b['slug']], $b);
        }

        // 5. Seed Galeris
        $galeris = [
            ['image' => 'gallery/pramuka.jpg', 'caption' => 'Kegiatan Pramuka', 'kategori' => 'Kegiatan'],
            ['image' => 'gallery/lab.jpg', 'caption' => 'Praktikum Lab Sains', 'kategori' => 'Fasilitas'],
            ['image' => 'gallery/wisuda.jpg', 'caption' => 'Wisuda Angkatan', 'kategori' => 'Event'],
            ['image' => 'gallery/olahraga.jpg', 'caption' => 'Pekan Olahraga', 'kategori' => 'Kegiatan'],
        ];

        foreach ($galeris as $g) {
            Galeri::updateOrCreate(['caption' => $g['caption']], $g);
        }

        // 6. Seed Testimonis
        $testimonis = [
            [
                'nama' => 'Bpk. Hidayat Raharjo',
                'role' => 'Orang Tua Budi (Kelas XI)',
                'isi' => 'Sebagai wali murid, saya merasa sangat terbantu sejak sekolah menggunakan SIAKAD. Saya bisa memantau kehadiran harian Budi dan langsung membayar SPP via bank transfer dengan sangat praktis.',
                'rating' => 5,
            ],
            [
                'nama' => 'Ibu Sarah Herawati, S.Pd',
                'role' => 'Guru Matematika & Wali Kelas XI-IPA',
                'isi' => 'Merekap absen dan menginput nilai ulangan harian siswa kini memakan waktu jauh lebih sedikit. Platform ini intuitif dan sangat memudahkan pelaporan wali kelas.',
                'rating' => 5,
            ],
            [
                'nama' => 'Adi Wijaya',
                'role' => 'Siswa Kelas XII',
                'isi' => 'Saya bisa langsung melihat jadwal pelajaran harian, mengirim tugas yang diberikan guru secara daring, dan memantau status pembayaran saya sendiri.',
                'rating' => 5,
            ],
        ];

        foreach ($testimonis as $t) {
            Testimoni::updateOrCreate(['nama' => $t['nama']], $t);
        }

        // 7. Seed Faqs
        $faqs = [
            [
                'question' => 'Apakah SIAKAD mendukung pembayaran uang sekolah secara online?',
                'answer' => 'Ya. Melalui integrasi dengan payment gateway Midtrans, wali murid dapat membayar biaya SPP bulanan atau uang pangkal lainnya menggunakan E-Wallet, transfer Virtual Account, atau kartu kredit dengan konfirmasi pembayaran real-time.',
                'order' => 1,
            ],
            [
                'question' => 'Bagaimana cara orang tua mengakses laporan kehadiran anak?',
                'answer' => 'Setiap orang tua atau wali murid diberikan akun khusus di panel Orang Tua. Setelah login, wali murid dapat memantau status absensi harian, nilai tugas, ujian, hingga modul Rapor Digital anak secara langsung.',
                'order' => 2,
            ],
            [
                'question' => 'Apakah sistem ini memiliki hak akses keamanan tersendiri?',
                'answer' => 'Tentu saja. SIAKAD menggunakan otorisasi berbasis peran (Role-Based Access Control) yang didukung oleh Spatie Permission dan Filament Shield untuk memastikan data akademik penting hanya bisa diakses dan diedit oleh pihak yang memiliki izin sah.',
                'order' => 3,
            ],
        ];

        foreach ($faqs as $f) {
            Faq::updateOrCreate(['question' => $f['question']], $f);
        }
    }
}

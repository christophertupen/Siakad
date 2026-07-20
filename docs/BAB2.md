# BAB II
## TINJAUAN PUSTAKA

### 2.1 Kajian Penelitian Terdahulu

Beberapa penelitian telah dilakukan terkait pengembangan sistem informasi akademik berbasis web. Tabel 2.1 menyajikan ringkasan penelitian terdahulu yang relevan dengan pengembangan ScholaNexa.

**Tabel 2.1 Penelitian Terdahulu**

| No | Peneliti dan Tahun | Judul | Relevansi |
|----|---------------------|-------|-----------|
| 1 | Ramadhan, Senubekti, dan Amalia (2025) | Penerapan Metodologi Agile dalam Pengembangan Perangkat Lunak | Membahas pengembangan perangkat lunak secara iteratif dan fleksibel. Menjadi dasar penggunaan pendekatan Agile dalam pembagian iterasi pengembangan sistem. |
| 2 | Subecz (2021) | Web-development with Laravel Framework | Menjelaskan penggunaan Laravel dan pola MVC dalam pembangunan aplikasi web. Mendukung pemilihan Laravel sebagai framework utama sistem. |
| 3 | Apriani, Kurniawan, dan Rahman (2025) | Optimalisasi Website Pemerintahan Desa Menggunakan Laravel dan MySQL | Menunjukkan penerapan Laravel dan basis data MySQL dalam pembangunan serta optimalisasi sistem informasi berbasis web. |
| 4 | Spasova dan Raiu (2022) | Comparison of Template Engines of PHP Frameworks | Membandingkan mesin template pada framework PHP. Relevan dengan pemilihan Blade sebagai template engine pada sistem. |
| 5 | Djuwitaningrum dan Jati (2025) | Implementasi Payment Gateway Midtrans pada Website Ecommerce Toko Buah dan Sayur | Membahas integrasi Midtrans sebagai payment gateway. Relevan dengan implementasi pembayaran online pada sistem. |
| 6 | Putro dan Supono (2022) | Comparison Analysis of Apache and Nginx Webserver Load Balancing | Membahas penggunaan dan pengujian Nginx sebagai web server. Relevan dengan penggunaan Nginx pada tahap deployment. |

### 2.2 Sistem Informasi Akademik

Sistem informasi akademik adalah sistem berbasis komputer yang dirancang untuk mengelola data dan proses akademik di lingkungan pendidikan. Sistem ini mencakup pengelolaan data siswa, guru, kelas, mata pelajaran, jadwal pelajaran, nilai, absensi, dan rapor. Tujuan utama sistem informasi akademik adalah meningkatkan efisiensi operasional sekolah, mempercepat akses informasi, menyediakan data yang akurat, dan mendukung pengambilan keputusan berbasis data.

ScholaNexa dikembangkan sebagai sistem informasi akademik yang tidak hanya mencakup pengelolaan data akademik, tetapi juga menyediakan fitur pembelajaran daring, pembayaran online, dan bank soal. Sistem ini dirancang untuk memenuhi kebutuhan sekolah menengah atas dan kejuruan yang memerlukan platform terintegrasi.

### 2.3 Teknologi yang Digunakan

#### 2.3.1 Laravel

Laravel adalah framework aplikasi web berbasis PHP yang menggunakan arsitektur Model-View-Controller (MVC). Laravel menyediakan fitur-fitur seperti routing, autentikasi, migrasi basis data, ORM Eloquent, dan Blade template engine. Laravel versi 12 digunakan sebagai fondasi backend sistem ScholaNexa karena mendukung pengembangan yang cepat, terstruktur, dan memiliki fitur keamanan yang baik.

#### 2.3.2 PHP

PHP (Hypertext Preprocessor) adalah bahasa pemrograman sisi server yang banyak digunakan untuk pengembangan aplikasi web. PHP 8.3 digunakan pada sistem ini karena menghadirkan peningkatan performa, tipe yang lebih ketat, dan fitur-fitur modern seperti named arguments dan readonly classes.

#### 2.3.3 MariaDB

MariaDB adalah sistem manajemen basis data relasional yang merupakan fork dari MySQL. MariaDB dipilih karena bersifat open-source, stabil, dan kompatibel penuh dengan Laravel. Basis data ini digunakan untuk menyimpan seluruh data sistem, termasuk data pengguna, data akademik, jadwal, nilai, pembayaran, dan konten website.

#### 2.3.4 Filament

Filament adalah framework admin panel untuk Laravel yang dibangun dengan Livewire dan Alpine.js. Filament v3 digunakan untuk membangun antarmuka dashboard setiap role pengguna. Filament menyediakan komponen-komponen siap pakai seperti form builder, table builder, widget, dan halaman yang dapat dikustomisasi. Sistem ScholaNexa memiliki lima panel Filament yang terpisah sesuai dengan masing-masing role.

#### 2.3.5 Blade, Tailwind CSS, dan Livewire

Blade adalah template engine bawaan Laravel yang ringan dan mendukung inheritance serta komponen. Tailwind CSS adalah framework CSS utility-first yang digunakan untuk membangun antarmuka yang responsif. Livewire adalah framework full-stack untuk Laravel yang memungkinkan pembuatan antarmuka dinamis tanpa menulis JavaScript secara eksplisit. Ketiga teknologi ini digunakan bersama untuk membangun halaman publik dan komponen interaktif pada sistem.

#### 2.3.6 Midtrans

Midtrans adalah payment gateway yang menyediakan layanan pemrosesan pembayaran online. Midtrans mendukung berbagai metode pembayaran seperti transfer bank, kartu kredit, QRIS, GoPay, dan ShopeePay. Integrasi dilakukan melalui Snap API yang menampilkan halaman pembayaran kepada pengguna. Webhook digunakan untuk menerima notifikasi status pembayaran secara otomatis. Sistem ScholaNexa terintegrasi dengan Midtrans untuk pembayaran SPP, buku, dan seragam.

#### 2.3.7 Spatie Permission

Spatie Permission adalah paket Laravel untuk manajemen role dan permission. Paket ini digunakan untuk mengatur hak akses setiap pengguna berdasarkan role yang dimiliki. Setiap role memiliki permission yang berbeda sesuai dengan kebutuhan masing-masing. Sistem secara otomatis menyelaraskan role pada tabel users dengan Spatie roles melalui event booted pada model User.

#### 2.3.8 Docker dan Nginx

Docker digunakan untuk mengelola lingkungan pengembangan dan produksi melalui container. Setiap layanan aplikasi dijalankan dalam container terpisah, yaitu container Laravel untuk logika bisnis, container Nginx sebagai web server, dan container MariaDB untuk basis data. Nginx berfungsi sebagai web server yang menerima permintaan HTTP dan meneruskannya ke aplikasi Laravel. Nginx dipilih karena memiliki performa tinggi dalam menangani koneksi konkuren.

#### 2.3.9 Git dan GitHub

Git digunakan sebagai version control system untuk melacak perubahan source code selama pengembangan. GitHub digunakan sebagai platform penyimpanan repository dan kolaborasi tim. Seluruh riwayat pengembangan sistem dicatat melalui commit yang terdokumentasi.

### 2.4 Perbandingan dengan Penelitian Sejenis

Beberapa penelitian sebelumnya telah mengembangkan sistem informasi akademik dengan pendekatan yang berbeda. Sahara, Hartawan, dan Zain (2024) mengembangkan layanan print online berbasis website yang berfokus pada pemesanan jasa cetak. Penelitian tersebut memiliki kesamaan dalam penggunaan Laravel dan Midtrans, tetapi objek dan fitur yang dikembangkan berbeda secara fundamental.

Apriani, Kurniawan, dan Rahman (2025) mengoptimalkan website pemerintahan desa menggunakan Laravel dan MySQL. Penelitian ini relevan dalam aspek penggunaan teknologi, tetapi domain yang dilayani berbeda dengan sistem informasi akademik.

Perbedaan utama ScholaNexa dengan penelitian sejenis terletak pada cakupan fitur yang lebih luas, yaitu mencakup pengelolaan data akademik, pembelajaran daring, pembayaran online, rapor digital, dan bank soal dalam satu platform terintegrasi. Selain itu, penggunaan Filament sebagai admin panel dengan lima panel role yang terpisah menjadi pembeda signifikan.

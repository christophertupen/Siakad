# BAB III
## METODOLOGI PENELITIAN

### 3.1 Metode Pengembangan Sistem

Pengembangan sistem ScholaNexa menggunakan metode Agile dengan pendekatan iteratif. Agile dipilih karena fleksibilitasnya dalam menyesuaikan kebutuhan yang berubah selama proses pengembangan. Setiap iterasi menghasilkan produk yang dapat diuji dan dievaluasi sebelum melanjutkan ke iterasi berikutnya.

Tahapan Agile yang diterapkan dalam pengembangan sistem meliputi Plan, Design, Develop, Test, Review, Deploy, dan Launch. Seluruh tahapan dijalankan secara berulang dalam setiap iterasi pengembangan.

### 3.2 Tahapan Penelitian

#### 3.2.1 Plan (Perencanaan)

Tahap perencanaan dimulai dengan identifikasi kebutuhan pengguna melalui observasi proses akademik yang berjalan di sekolah menengah atas dan kejuruan. Kebutuhan yang teridentifikasi kemudian dituangkan ke dalam Business Requirement Document (BRD) dan Product Requirement Document (PRD). BRD berisi kebutuhan bisnis, ruang lingkup, dan acceptance criteria, sedangkan PRD berisi persona pengguna, user story, product backlog, dan rencana iterasi pengembangan.

Product backlog disusun berdasarkan prioritas dan dikelompokkan ke dalam empat iterasi.

**Tabel 3.1 Rencana Iterasi Pengembangan**

| Iterasi | Fokus | Fitur yang Dikembangkan |
|---------|-------|-------------------------|
| Iterasi 1 | Autentikasi dan Master Data | Registrasi akun, verifikasi email, login multi-role, lupa password, manajemen user, manajemen siswa, manajemen kelas, manajemen mata pelajaran |
| Iterasi 2 | Manajemen Akademik dan Pembelajaran | Manajemen biaya per kelas, manajemen materi, manajemen tugas, manajemen nilai dengan riwayat perubahan |
| Iterasi 3 | Dashboard dan Pembayaran Online | Dashboard setiap role, manajemen pembayaran, integrasi Midtrans dan webhook |
| Iterasi 4 | Rapor, Bank Soal, dan Penyempurnaan | Rapor online, bank soal, log aktivitas, pengaturan website, manajemen absensi |

#### 3.2.2 Design (Perancangan)

Tahap perancangan meliputi pembuatan sitemap untuk menggambarkan struktur halaman, use case diagram untuk menjelaskan interaksi pengguna dengan sistem, activity diagram untuk menggambarkan alur proses, sequence diagram untuk menjelaskan komunikasi antar objek, entity relationship diagram untuk merancang struktur basis data, class diagram untuk menggambarkan struktur kelas, deployment diagram untuk menggambarkan arsitektur deployment, dan wireframe untuk merancang antarmuka pengguna.

#### 3.2.3 Develop (Pengembangan)

Tahap pengembangan dilakukan dengan menulis kode program menggunakan framework Laravel 12. Lingkungan pengembangan disiapkan menggunakan Docker dengan container untuk aplikasi Laravel, Nginx, dan MariaDB. Setiap fitur dikembangkan sesuai dengan prioritas yang telah ditentukan dalam product backlog. Pengembangan dimulai dari fitur autentikasi, kemudian dilanjutkan dengan fitur master data, manajemen akademik, dashboard, pembayaran, dan fitur pendukung lainnya.

#### 3.2.4 Test (Pengujian)

Pengujian dilakukan menggunakan metode black-box testing dan user acceptance testing. Black-box testing menguji fungsionalitas sistem berdasarkan skenario yang telah ditentukan tanpa melihat struktur kode internal. User acceptance testing dilakukan dengan melibatkan calon pengguna untuk menilai tingkat penerimaan terhadap sistem.

#### 3.2.5 Review (Evaluasi)

Hasil pengujian dievaluasi untuk mengidentifikasi kekurangan atau kesalahan pada sistem. Perbaikan dilakukan dan pengujian ulang dijalankan untuk memastikan setiap fitur berfungsi sesuai kebutuhan.

#### 3.2.6 Deploy (Penyebaran)

Sistem di-deploy ke server produksi menggunakan Docker. Container aplikasi Laravel, Nginx, dan MariaDB dijalankan pada server. Domain dihubungkan dengan web server dan koneksi diamankan menggunakan HTTPS.

#### 3.2.7 Launch (Peluncuran)

Sistem diluncurkan dan dapat digunakan oleh pengguna sesuai dengan role masing-masing. Monitoring awal dilakukan untuk memastikan seluruh fungsi utama berjalan dengan baik.

### 3.3 Teknik Pengumpulan Data

Teknik pengumpulan data yang digunakan dalam penelitian ini adalah sebagai berikut.

1. **Observasi**: melakukan pengamatan terhadap proses pengelolaan data akademik yang berjalan di sekolah untuk mengidentifikasi masalah dan kebutuhan sistem.
2. **Studi pustaka**: mempelajari literatur, jurnal, dan dokumentasi teknologi yang relevan dengan pengembangan sistem informasi akademik.
3. **Dokumentasi**: mengumpulkan dokumen-dokumen terkait kebutuhan bisnis dan kebutuhan pengguna yang digunakan sebagai acuan pengembangan.

### 3.4 Metode Pengujian Sistem

#### 3.4.1 Black-box Testing

Black-box testing dilakukan dengan menguji setiap fitur sistem berdasarkan skenario yang telah ditentukan. Pengujian berfokus pada input dan output sistem tanpa memeriksa kode internal. Setiap skenario pengujian dirancang untuk memverifikasi bahwa fitur menghasilkan keluaran yang sesuai dengan kebutuhan.

Skenario pengujian mencakup fitur-fitur utama sistem seperti registrasi, login, manajemen data akademik, pengelolaan jadwal, materi, tugas, nilai, pembayaran, rapor, dan bank soal. Hasil pengujian dicatat dalam tabel yang memuat kode pengujian, fitur, skenario, data masukan, hasil yang diharapkan, hasil aktual, dan status.

#### 3.4.2 User Acceptance Testing (UAT)

User acceptance testing dilakukan untuk mengukur tingkat penerimaan pengguna terhadap sistem. Instrumen UAT disusun dalam bentuk kuesioner dengan skala Likert 1 sampai 5. Responden diminta menggunakan sistem terlebih dahulu, kemudian memberikan penilaian terhadap setiap pernyataan.

Pernyataan dalam kuesioner mencakup aspek kemudahan penggunaan, kejelasan informasi, proses pembelajaran, pembayaran, dan kelayakan sistem. Hasil penilaian dihitung menggunakan rumus persentase dan diinterpretasikan ke dalam kategori Sangat Baik, Baik, Cukup, Kurang, atau Sangat Kurang.

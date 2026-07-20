# BAB IV
## ANALISIS DAN PERANCANGAN

### 4.1 Analisis Kebutuhan

#### 4.1.1 Analisis Kebutuhan Fungsional

Analisis kebutuhan fungsional dilakukan untuk mengidentifikasi fitur-fitur yang harus tersedia pada sistem ScholaNexa. Kebutuhan fungsional diperoleh dari user story dan product backlog yang telah disusun pada tahap perencanaan. Tabel 4.1 menyajikan kebutuhan fungsional sistem berdasarkan masing-masing role pengguna.

**Tabel 4.1 Kebutuhan Fungsional Sistem**

| Kode | Kebutuhan Fungsional | Role |
|------|---------------------|------|
| KF-01 | Sistem menyediakan registrasi akun mandiri untuk Siswa, Guru, dan Orang Tua | Publik |
| KF-02 | Sistem mengirimkan tautan verifikasi email dan mengaktifkan akun setelah verifikasi | Publik |
| KF-03 | Sistem menyediakan login dan logout dengan pengarahan ke dashboard sesuai role | Publik |
| KF-04 | Sistem menyediakan fitur lupa password melalui email | Publik |
| KF-05 | Admin dapat mengelola seluruh data user (tambah, ubah, hapus, atur role, aktif/nonaktifkan) | Admin |
| KF-06 | Admin dapat memonitor log aktivitas pengguna | Admin |
| KF-07 | Admin dapat mengelola pengaturan website (logo, kontak, hero, jam operasional) | Admin |
| KF-08 | Akademik/TU dapat mengelola data siswa, guru, orang tua, kelas, dan mata pelajaran | Akademik |
| KF-09 | Akademik/TU dapat mengelola jadwal pelajaran dengan validasi bentrok otomatis | Akademik |
| KF-10 | Akademik/TU dapat mengelola biaya sekolah per kelas (SPP, buku, seragam) | Akademik |
| KF-11 | Akademik/TU dapat mengelola pembayaran siswa dan melakukan override status | Akademik |
| KF-12 | Guru dapat melihat jadwal mengajar | Guru |
| KF-13 | Guru dapat mengelola materi pembelajaran (upload, edit, hapus) | Guru |
| KF-14 | Guru dapat mengelola tugas siswa dengan deadline | Guru |
| KF-15 | Guru dapat mengelola nilai siswa dengan riwayat perubahan | Guru |
| KF-16 | Guru dapat mengelola absensi siswa | Guru |
| KF-17 | Guru dapat mengelola bank soal | Guru |
| KF-18 | Siswa dapat melihat jadwal pelajaran berdasarkan kelas | Siswa |
| KF-19 | Siswa dapat melihat dan mengunduh materi pembelajaran | Siswa |
| KF-20 | Siswa dapat melihat dan mengerjakan tugas | Siswa |
| KF-21 | Siswa dapat melihat nilai dan progres belajar | Siswa |
| KF-22 | Siswa dapat mengakses dan mengunduh rapor | Siswa |
| KF-23 | Siswa dapat mengakses bank soal | Siswa |
| KF-24 | Orang Tua dapat memantau progres belajar anak | Orang Tua |
| KF-25 | Orang Tua dapat melihat jadwal pelajaran anak | Orang Tua |
| KF-26 | Orang Tua dapat melihat tagihan dan melakukan pembayaran online | Orang Tua |
| KF-27 | Orang Tua dapat mengakses dan mengunduh rapor anak | Orang Tua |
| KF-28 | Sistem terintegrasi dengan Midtrans untuk pembayaran online | Sistem |
| KF-29 | Sistem memperbarui status pembayaran secara otomatis melalui webhook Midtrans | Sistem |
| KF-30 | Sistem mencatat log aktivitas pengguna | Sistem |

#### 4.1.2 Analisis Kebutuhan Non-Fungsional

Kebutuhan non-fungsional sistem meliputi aspek-aspek kualitas yang harus dipenuhi.

**Tabel 4.2 Kebutuhan Non-Fungsional Sistem**

| Aspek | Kebutuhan |
|-------|-----------|
| Keamanan | Sistem menggunakan autentikasi, role, dan permission untuk mengatur hak akses setiap pengguna |
| Reliabilitas | Data akademik, jadwal, dan nilai tersimpan dengan baik pada basis data dan dapat diakses kembali |
| Kemudahan Penggunaan | Tampilan sistem dibuat sederhana dan intuitif agar mudah digunakan oleh semua pengguna |
| Kinerja | Sistem mampu menampilkan informasi dengan waktu akses yang wajar |
| Pemeliharaan | Data akademik, informasi website, dan pengaturan sistem dapat diperbarui oleh admin tanpa mengubah kode |
| Kompatibilitas | Sistem dapat diakses melalui browser modern pada perangkat komputer maupun smartphone |

### 4.2 Perancangan Basis Data

Perancangan basis data dilakukan dengan merancang struktur tabel dan hubungan antar entitas. Basis data ScholaNexa terdiri dari tabel-tabel yang dikelompokkan ke dalam beberapa kategori, yaitu tabel pengguna dan autentikasi, tabel master data, tabel akademik, tabel keuangan, dan tabel konten website.

#### 4.2.1 Struktur Tabel

**Tabel Pengguna dan Autentikasi**

Tabel `users` menyimpan data seluruh pengguna sistem dengan kolom id, name, email, password, role (enum: admin, akademik, guru, siswa, orang_tua), email_verified_at, status, dan timestamps. Tabel ini menjadi induk dari tabel profil setiap role.

**Tabel Master Data**

Tabel `siswas` menyimpan data siswa dengan kolom id, user_id (foreign key), nis (unique), nisn (unique), nama, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, alamat, nomor_hp, tanggal_masuk, dan status.

Tabel `gurus` menyimpan data guru dengan kolom id, user_id (foreign key), nip (unique), nama, gelar, pendidikan_terakhir, bidang_keahlian, dan confirmed.

Tabel `orang_tuas` menyimpan data orang tua dengan kolom id, user_id (foreign key), siswa_id (foreign key), nik (unique), nama, hubungan, pekerjaan, nomor_telepon, dan alamat. Relasi dengan siswa bersifat many-to-one dimana satu orang tua dapat terhubung dengan satu siswa.

Tabel `kelas` menyimpan data kelas dengan kolom id, nama_kelas, tingkat (X, XI, XII), tahun_ajaran, wali_kelas_id (foreign key ke gurus), dan status.

Tabel `mata_pelajarans` menyimpan data mata pelajaran dengan kolom id, kode_mata_pelajaran (unique), nama_mata_pelajaran, deskripsi, KKM (default 75), dan status.

Tabel `kelas_siswa` menyimpan relasi siswa dengan kelas dengan kolom id, siswa_id, kelas_id, no_absen, tahun_ajaran, semester, dan status. Relasi ini bersifat many-to-many dengan tambahan atribut.

**Tabel Akademik**

Tabel `jadwal_pelajarans` menyimpan jadwal pelajaran dengan kolom id, guru_id, mata_pelajaran_id, kelas_id, hari, jam_mulai, jam_selesai, tahun_ajaran, dan semester.

Tabel `materis` menyimpan materi pembelajaran dengan kolom id, mata_pelajaran_id, guru_id, kelas_id, judul, deskripsi, file, dan tanggal_dibuat.

Tabel `tugas` menyimpan tugas dengan kolom id, guru_id, mata_pelajaran_id, kelas_id, judul, deskripsi, file_tugas, nilai_maksimal, dan deadline.

Tabel `pengumpulan_tugas` menyimpan pengumpulan tugas oleh siswa dengan kolom id, tugas_id, siswa_id, file_jawaban, tanggal_pengumpulan, nilai, dan catatan.

Tabel `nilais` menyimpan nilai siswa dengan kolom id, siswa_id, guru_id, mata_pelajaran_id, nilai_tugas, nilai_uts, nilai_uas, nilai_akhir, predikat, catatan, tahun_ajaran, dan semester.

Tabel `absensis` menyimpan absensi siswa dengan kolom id, siswa_id, jadwal_pelajaran_id, mata_pelajaran_id, tanggal, status (Hadir, Izin, Sakit, Alpha), dan keterangan.

Tabel `rapors` menyimpan data rapor dengan kolom id, siswa_id, guru_id, tahun_ajaran, semester, total_nilai, rata_rata, peringkat, catatan_wali_kelas, status (Naik, Tidak Naik, Lulus), dan file_pdf.

Tabel `bank_soals` menyimpan bank soal dengan kolom id, guru_id, mata_pelajaran_id, kelas_id, judul, deskripsi, file, semester, dan is_publish.

**Tabel Keuangan**

Tabel `pembayarans` menyimpan data pembayaran dengan kolom id, siswa_id, tahun_ajaran, kategori (SPP, Buku, Seragam), bulan, jenis_item, ukuran, jumlah, harga, total, status (Pending, Lunas, Gagal), metode_pembayaran, midtrans_order_id, midtrans_token, midtrans_transaction_id, midtrans_payment_type, midtrans_transaction_status, midtrans_response, bukti_pembayaran, catatan, dan tanggal_bayar.

**Tabel Konten Website**

Tabel `pengaturan_webs` menyimpan pengaturan website dengan kolom yang mencakup identitas sekolah, logo, favicon, pengaturan hero section, statistik, CTA, SEO, dan warna tema.

Tabel pendukung konten website meliputi `keunggulans`, `fitur_akademiks`, `beritas`, `galleries`, `gallery_photos`, `testimonis`, dan `faqs`.

**Tabel Sistem**

Tabel `activity_log` dari paket Spatie Activitylog menyimpan seluruh aktivitas pengguna. Tabel `permissions` dan `roles` dari paket Spatie Permission menyimpan pengaturan hak akses.

#### 4.2.2 Entity Relationship Diagram

Entity Relationship Diagram (ERD) menggunakan notasi Chen atau Crow's Foot yang menggambarkan hubungan antar tabel dalam basis data ScholaNexa. ERD mencakup seluruh entitas utama beserta relasi dan kardinalitasnya.

### 4.3 Perancangan Arsitektur Sistem

Sistem ScholaNexa menggunakan arsitektur client-server dengan model MVC (Model-View-Controller). Pengguna mengakses sistem melalui browser yang terhubung ke server Nginx. Nginx meneruskan permintaan ke aplikasi Laravel yang berjalan di container terpisah. Aplikasi Laravel memproses logika bisnis, berkomunikasi dengan basis data MariaDB, dan mengelola penyimpanan file. Pembayaran diproses melalui API Midtrans dengan notifikasi webhook untuk pembaruan status.

### 4.4 Perancangan Antarmuka

Perancangan antarmuka pengguna didasarkan pada struktur halaman yang telah ditentukan dalam sitemap. Setiap role memiliki dashboard dengan navigasi yang sesuai dengan kebutuhan masing-masing.

Halaman publik meliputi beranda, informasi sekolah, login, registrasi, dan lupa password. Dashboard Admin mencakup statistik, manajemen user, log aktivitas, dan pengaturan website. Dashboard Akademik/TU mencakup manajemen siswa, guru, kelas, mata pelajaran, jadwal, biaya, dan pembayaran. Dashboard Guru mencakup jadwal mengajar, materi, tugas, nilai, absensi, dan bank soal. Dashboard Siswa mencakup jadwal pelajaran, materi, tugas, nilai, rapor, dan bank soal. Dashboard Orang Tua mencakup progres anak, jadwal, pembayaran, dan rapor.

### 4.5 Diagram Perancangan

==================================================

📌 **Diagram yang harus saya upload:**

1. **Use Case Diagram** — menggambarkan interaksi antara aktor (Admin, Akademik/TU, Guru, Siswa, Orang Tua, Midtrans) dengan use case yang tersedia pada sistem.

2. **Activity Diagram Login** — menggambarkan alur proses login pengguna mulai dari memasukkan email dan password hingga diarahkan ke dashboard sesuai role.

3. **Activity Diagram Pembayaran** — menggambarkan alur pembayaran online mulai dari orang tua memilih tagihan, mengklik bayar, diarahkan ke Midtrans, hingga webhook memperbarui status.

4. **Activity Diagram Registrasi** — menggambarkan alur registrasi akun mandiri mulai dari pengisian data, verifikasi email, hingga aktivasi akun.

5. **Sequence Diagram** — menggambarkan interaksi antar objek dalam sistem untuk skenario tertentu, seperti pembayaran atau pengelolaan nilai.

6. **Entity Relationship Diagram (ERD)** — menggambarkan hubungan antar tabel dalam basis data ScholaNexa.

7. **Class Diagram** — menggambarkan struktur kelas pada sistem, termasuk model, atribut, dan relasi antar kelas.

8. **Deployment Diagram** — menggambarkan konfigurasi deployment sistem menggunakan Docker dengan container Nginx, Laravel, MariaDB, dan integrasi Midtrans.

9. **Sitemap** — menggambarkan struktur halaman dan navigasi sistem untuk setiap role pengguna.

10. **Wireframe** — menggambarkan rancangan antarmuka pengguna untuk halaman-halaman utama sistem.

==================================================

Silakan upload diagram-diagram tersebut. Setelah semua diagram tersedia, saya akan melanjutkan ke BAB V.

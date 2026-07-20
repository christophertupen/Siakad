# BAB I
## PENDAHULUAN

### 1.1 Latar Belakang

Proses pengelolaan data akademik di lingkungan sekolah menengah atas dan kejuruan masih menghadapi berbagai kendala operasional. Pencatatan data siswa, guru, kelas, dan mata pelajaran yang tersebar di dokumen terpisah menyulitkan pihak sekolah dalam mengakses informasi secara cepat dan akurat. Penyusunan jadwal pelajaran yang dilakukan tanpa sistem validasi sering menimbulkan bentrok jadwal, terutama ketika seorang guru dijadwalkan mengajar di dua kelas berbeda pada jam yang sama. Distribusi materi dan tugas melalui grup percakapan menyebabkan file mudah tertimbun dan menyulitkan siswa dalam mengaksesnya kembali.

Pengambilan rapor yang dilakukan secara offline menjadi kendala bagi orang tua yang tidak dapat hadir ke sekolah karena keterbatasan waktu. Proses pembayaran SPP, buku, dan seragam yang dilakukan secara manual memperlambat administrasi keuangan sekolah dan menyulitkan pemantauan status pembayaran secara transparan. Persiapan siswa kelas dua belas menghadapi Seleksi Nasional Berbasis Tes (SNBT) belum didukung oleh bank soal terpusat yang dapat diakses secara mandiri.

Berdasarkan permasalahan tersebut, dibutuhkan sebuah sistem informasi akademik berbasis web yang mengintegrasikan kebutuhan sekolah dalam satu platform. Sistem ini dirancang untuk mengelola data akademik secara terstruktur, memfasilitasi kegiatan pembelajaran daring, menyediakan akses rapor secara online, mendukung pembayaran melalui payment gateway, serta menyediakan bank soal untuk persiapan SNBT.

### 1.2 Identifikasi Masalah

Berdasarkan latar belakang yang telah diuraikan, identifikasi masalah dalam pengembangan sistem ini adalah sebagai berikut.

1. Data akademik, jadwal pelajaran, dan administrasi siswa dikelola secara terpisah sehingga menyulitkan pencarian dan pemutakhiran informasi.
2. Penyusunan jadwal pelajaran dilakukan tanpa validasi otomatis sehingga rawan terjadi bentrok jadwal guru.
3. Distribusi materi pembelajaran dan tugas melalui grup percakapan tidak terstruktur dan menyulitkan siswa dalam mengaksesnya kembali.
4. Proses input dan pemantauan nilai siswa masih dilakukan secara manual sehingga rawan kesalahan pencatatan dan tidak memiliki riwayat perubahan.
5. Pengambilan rapor dilakukan secara offline sehingga menyulitkan orang tua yang tidak dapat hadir ke sekolah.
6. Pembayaran SPP, buku, dan seragam dilakukan secara manual sehingga memperlambat administrasi dan menyulitkan pemantauan status.
7. Bank soal untuk persiapan SNBT belum tersedia secara terpusat dan belum dapat diakses oleh siswa kelas dua belas secara mandiri.

### 1.3 Rumusan Masalah

Rumusan masalah dalam pengembangan sistem ini adalah sebagai berikut.

1. Bagaimana merancang dan membangun sistem informasi akademik berbasis web yang mengintegrasikan pengelolaan data siswa, guru, kelas, mata pelajaran, dan jadwal dalam satu platform?
2. Bagaimana menerapkan validasi bentrok jadwal secara otomatis pada sistem penjadwalan pelajaran?
3. Bagaimana merancang sistem yang memungkinkan guru mengelola materi, tugas, dan nilai secara digital dengan riwayat perubahan?
4. Bagaimana mengimplementasikan akses rapor secara online dengan metode unggah file PDF oleh guru?
5. Bagaimana mengintegrasikan payment gateway Midtrans untuk pembayaran SPP, buku, dan seragam secara online?
6. Bagaimana menyediakan bank soal terpusat yang dapat diakses oleh siswa kelas dua belas sebagai persiapan SNBT?

### 1.4 Batasan Masalah

Batasan masalah dalam pengembangan sistem ini adalah sebagai berikut.

1. Sistem dikembangkan menggunakan framework Laravel 12 dengan bahasa pemrograman PHP 8.3, basis data MariaDB, serta antarmuka pengguna menggunakan Blade, Tailwind CSS, Livewire v3, dan Filament v3.
2. Sistem melayani lima peran pengguna, yaitu Admin, Akademik/TU, Guru, Siswa, dan Orang Tua.
3. Registrasi akun tersedia untuk peran Guru, Siswa, dan Orang Tua melalui verifikasi email, sedangkan akun Admin dan Akademik/TU merupakan akun bawaan sistem yang tidak dapat didaftarkan secara publik.
4. Rapor diunggah dalam format PDF oleh Guru atau Admin, bukan dihasilkan secara otomatis oleh sistem.
5. Pembayaran online menggunakan Midtrans sebagai payment gateway dengan pembaruan status melalui webhook.
6. Sistem tidak mencakup integrasi dengan sistem pemerintah seperti Dapodik, aplikasi mobile native, atau fitur komunikasi real-time.

### 1.5 Tujuan Penelitian

Tujuan dari pengembangan sistem ini adalah sebagai berikut.

1. Menghasilkan sistem informasi akademik berbasis web yang mengintegrasikan pengelolaan data akademik, jadwal pelajaran, materi pembelajaran, tugas, nilai, pembayaran, rapor, dan bank soal dalam satu platform.
2. Menerapkan validasi bentrok jadwal otomatis pada fitur penjadwalan pelajaran.
3. Menyediakan fitur pengelolaan materi, tugas, dan nilai digital yang dilengkapi dengan riwayat perubahan.
4. Menyediakan akses rapor secara online melalui unggah file PDF oleh Guru.
5. Mengintegrasikan payment gateway Midtrans untuk pembayaran SPP, buku, dan seragam secara online.
6. Menyediakan bank soal terpusat yang dapat diakses oleh siswa kelas dua belas.

### 1.6 Manfaat Penelitian

Manfaat yang diharapkan dari pengembangan sistem ini adalah sebagai berikut.

1. **Bagi sekolah**: menyediakan sistem informasi akademik terpusat yang memudahkan pengelolaan data dan pengambilan keputusan berbasis informasi yang akurat.
2. **Bagi Akademik/TU**: mempermudah pengelolaan data master akademik, penyusunan jadwal dengan validasi bentrok otomatis, serta administrasi pembayaran siswa.
3. **Bagi Guru**: memudahkan distribusi materi dan tugas, pencatatan nilai dengan riwayat perubahan, serta pengelolaan bank soal.
4. **Bagi Siswa**: menyediakan akses terhadap jadwal, materi, tugas, nilai, rapor, dan bank soal secara mandiri.
5. **Bagi Orang Tua**: memungkinkan pemantauan perkembangan akademik anak, akses rapor, dan pembayaran secara online.
6. **Bagi peneliti**: menambah pengalaman dalam pengembangan sistem informasi akademik berbasis web menggunakan Laravel, Filament, dan Midtrans.

### 1.7 Sistematika Penulisan

Laporan capstone ini disusun dalam enam bab dengan sistematika sebagai berikut.

**Bab I Pendahuluan.** Bab ini berisi latar belakang, identifikasi masalah, rumusan masalah, batasan masalah, tujuan penelitian, manfaat penelitian, dan sistematika penulisan.

**Bab II Tinjauan Pustaka.** Bab ini membahas teori-teori pendukung yang digunakan dalam pengembangan sistem, meliputi kajian penelitian terdahulu, konsep sistem informasi akademik, teknologi yang digunakan, dan perbandingan dengan penelitian sejenis.

**Bab III Metodologi Penelitian.** Bab ini menguraikan metode pengembangan sistem yang digunakan, tahapan penelitian, teknik pengumpulan data, dan metode pengujian sistem.

**Bab IV Analisis dan Perancangan.** Bab ini menyajikan analisis kebutuhan sistem, perancangan basis data, perancangan antarmuka, serta diagram-diagram perancangan sistem.

**Bab V Implementasi dan Pengujian.** Bab ini menjelaskan implementasi dari perancangan ke dalam kode program, lingkungan pengembangan, serta hasil pengujian sistem menggunakan metode black-box dan user acceptance testing.

**Bab VI Kesimpulan dan Saran.** Bab ini berisi kesimpulan dari hasil pengembangan sistem dan saran untuk pengembangan selanjutnya.

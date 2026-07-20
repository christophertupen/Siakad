# ABSTRAK

**ScholaNexa: Sistem Informasi Akademik Berbasis Web Untuk SMA/SMK**

Sekolah menengah atas dan kejuruan masih mengelola data akademik secara manual atau menggunakan media terpisah, menyebabkan data tersebar, jadwal bentrok, distribusi materi tidak terstruktur, pembayaran manual, dan akses rapor terbatas. Penelitian ini bertujuan membangun sistem informasi akademik berbasis web yang mengintegrasikan pengelolaan data siswa, guru, kelas, mata pelajaran, jadwal, materi, tugas, nilai, pembayaran, rapor, dan bank soal dalam satu platform.

Sistem dikembangkan menggunakan framework Laravel 12, PHP 8.3, basis data MariaDB, serta antarmuka pengguna menggunakan Blade, Tailwind CSS, Livewire v3, dan Filament v3. Sistem menerapkan arsitektur multi-role dengan lima panel terpisah untuk Admin, Akademik/TU, Guru, Siswa, dan Orang Tua menggunakan Spatie Permission. Pembayaran online diintegrasikan dengan Midtrans melalui Snap API dan webhook. Pengembangan menggunakan metode Agile dengan empat iterasi.

Hasil implementasi menunjukkan bahwa sistem berhasil menyediakan registrasi mandiri dengan verifikasi email, login multi-role, manajemen data akademik terpusat, validasi bentrok jadwal otomatis, pengelolaan materi dan tugas daring, input nilai dengan riwayat perubahan, akses rapor online melalui unggah PDF, pembayaran online terintegrasi Midtrans, serta bank soal untuk persiapan SNBT. Sistem diuji menggunakan black-box testing dan user acceptance testing.

**Kata Kunci:** sistem informasi akademik, Laravel, Filament, Midtrans, manajemen sekolah

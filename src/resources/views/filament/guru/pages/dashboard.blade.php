<div class="w-full max-w-[1440px] mx-auto my-4 px-4 flex flex-col gap-6" x-data="{ timeRemaining: 2700 }">

    <!-- Topbar -->
    <header class="sticky top-4 z-40 flex items-center justify-between bg-glass-fill dark:bg-slate-900/80 backdrop-blur-xl border border-glass-stroke dark:border-white/10 p-4 rounded-bento shadow-md mx-auto w-full max-w-[1440px]">
        <div class="flex items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center">
                    <span class="material-symbols-rounded text-white">school</span>
                </div>
                <span class="font-extrabold text-xl text-primary whitespace-nowrap">EduPremium</span>
            </div>
            <nav class="hidden lg:flex items-center gap-1">
                <a class="flex items-center gap-2 px-4 py-2 rounded-xl bg-primary/10 text-primary font-semibold transition-all" href="/guru">
                    <span class="material-symbols-rounded text-xl">dashboard</span>Dashboard
                </a>
                <a class="flex items-center gap-2 px-4 py-2 rounded-xl text-on-surface-variant dark:text-slate-350 hover:bg-surface-container dark:hover:bg-slate-800 font-semibold transition-all" href="/guru/jadwal-pelajarans">
                    <span class="material-symbols-rounded text-xl">calendar_month</span>Akademik
                </a>
                <a class="flex items-center gap-2 px-4 py-2 rounded-xl text-on-surface-variant dark:text-slate-350 hover:bg-surface-container dark:hover:bg-slate-800 font-semibold transition-all" href="/guru/profile">
                    <span class="material-symbols-rounded text-xl">person</span>Profil
                </a>
            </nav>
        </div>

        <div class="flex items-center gap-6 flex-1 justify-center max-w-xl mx-8 relative" x-data="{ openSuggestions: false, searchVal: '' }">
            <div class="relative w-full">
                <span class="material-symbols-rounded absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant dark:text-slate-400">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low dark:bg-slate-800 border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-sm dark:text-white" 
                    placeholder="Cari mahasiswa, kelas, atau materi..." 
                    type="text" 
                    x-model="searchVal"
                    @focus="openSuggestions = true"
                    @click.away="openSuggestions = false" />
            </div>
            
            <!-- Autocomplete suggestions drop-down -->
            <div x-show="openSuggestions && searchVal.length > 0" 
                 class="absolute top-12 left-0 w-full bg-white dark:bg-slate-900 rounded-xl border border-slate-200/50 dark:border-slate-800 shadow-2xl p-4 space-y-2 z-50"
                 style="display: none;"
                 x-transition>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wide">Hasil Pencarian Cepat</div>
                <div class="space-y-1 text-sm text-slate-800 dark:text-slate-200">
                    <a href="#" class="block p-2 rounded hover:bg-primary/5">👨‍🎓 Bambang Pamungkas - Siswa</a>
                    <a href="#" class="block p-2 rounded hover:bg-primary/5">📚 Algoritma & Pemrograman - RPP</a>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <!-- Theme Switcher -->
            <button @click="darkMode = !darkMode" class="p-2 rounded-xl hover:bg-surface-container-high dark:hover:bg-slate-800 text-on-surface-variant dark:text-slate-350 transition-colors">
                <span class="material-symbols-rounded" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
            </button>

            <div class="hidden xl:flex items-center gap-2 px-3 py-1.5 bg-primary/5 dark:bg-slate-800 rounded-xl border border-primary/10 dark:border-slate-700">
                <span class="material-symbols-rounded text-primary text-lg">partly_cloudy_day</span>
                <span class="text-xs font-semibold text-on-surface dark:text-slate-200">28°C</span>
            </div>
            
            <button class="p-2 rounded-xl hover:bg-surface-container-high dark:hover:bg-slate-800 transition-colors relative text-on-surface-variant dark:text-slate-355">
                <span class="material-symbols-rounded">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full ring-2 ring-white dark:ring-slate-900"></span>
            </button>
            
            <div class="h-8 w-px bg-outline-variant dark:bg-slate-800 mx-1"></div>
            
            <!-- Profile Dropdown (AlpineJS) -->
            <div class="relative" x-data="{ profileOpen: false }">
                <div @click="profileOpen = !profileOpen" class="flex items-center gap-3 pl-2 cursor-pointer group">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold leading-tight dark:text-white">{{ $teacherName }}</p>
                        <p class="text-[10px] text-on-surface-variant dark:text-slate-400">{{ $teacherTitle ?: 'Guru Akademik' }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-primary/20 p-0.5 overflow-hidden group-hover:border-primary transition-colors">
                        <img alt="Teacher" class="w-full h-full rounded-full bg-primary-fixed" src="https://lh3.googleusercontent.com/aida-public/AB6AXuApx9rzIA7LkWm3yvAdm3dBBL7vHMW3LSbpFa1JqmuErTMInSGdJhLGzVMWLOU-81YO6RyWto54Y3hjzh4HvhDEqzFwMwjR6_Cl1aocYgKAqXssjLqRLbMnmjPg7-BBsSZIzZDN0XQt-0AV79d-irJzYRjofnsJgRjTedOJG-xl8gn3JwCisanmx2D-YdqH2I5e0dGU9oG9UvI4VLrfiDi2mYuvfOjAfXyeVQS4DR2rnH7CNurDkUgY"/>
                    </div>
                </div>
                <!-- Profile dropdown contents -->
                <div x-show="profileOpen" @click.away="profileOpen = false" 
                     class="absolute right-0 top-12 w-48 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-xl shadow-2xl p-2 space-y-1 z-50 text-left"
                     style="display: none;"
                     x-transition>
                    <a href="/guru/profile" class="flex items-center gap-2 p-2 rounded-lg text-sm text-slate-700 dark:text-slate-300 hover:bg-primary/5 transition-all">
                        <span class="material-symbols-rounded text-lg">settings</span> Pengaturan Akun
                    </a>
                    
                    <form action="{{ route('filament.guru.auth.logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 p-2 rounded-lg text-sm text-slate-700 dark:text-slate-300 hover:bg-primary/5 transition-all">
                            <span class="material-symbols-rounded text-lg">logout</span> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-6">
        
        <!-- Hero Welcome Section (Large 4x2) -->
        <section class="lg:col-span-4 xl:col-span-4 bento-card p-8 bg-gradient-to-br from-white via-white to-primary/5 dark:from-slate-900 dark:to-slate-850 relative overflow-hidden group">
            <div class="absolute -right-10 -top-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-colors"></div>
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 text-primary dark:bg-primary/20 dark:text-blue-300 rounded-full text-xs font-bold mb-4 uppercase tracking-wider">
                            Semester Ganjil 2026/2027
                        </div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-on-surface dark:text-white mb-2">Selamat Pagi, {{ $teacherName }}! 👋</h1>
                        <p class="text-on-surface-variant dark:text-slate-300 text-lg mb-6">"Pendidikan adalah senjata paling ampuh untuk mengubah dunia."</p>
                        
                        <div class="max-w-md">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-semibold">Progres Pengajaran Semester</span>
                                <span class="text-sm font-bold text-primary">65%</span>
                            </div>
                            <div class="w-full h-3 bg-surface-container dark:bg-slate-800 rounded-full overflow-hidden p-0.5 border border-white dark:border-slate-700">
                                <div class="h-full bg-primary rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        <a href="/guru/materis/create" class="flex items-center justify-center gap-2 bg-primary text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <span class="material-symbols-rounded">add</span>
                            Buat Materi Baru
                        </a>
                        <a href="/guru/nilais/create" class="flex items-center justify-center gap-2 bg-white dark:bg-slate-800 text-on-surface dark:text-slate-200 border border-outline-variant dark:border-slate-700 px-6 py-3 rounded-2xl font-bold hover:bg-surface-container dark:hover:bg-slate-700 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <span class="material-symbols-rounded">edit_square</span>
                            Input Nilai
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Circular Progress Bento (Medium 2x2) -->
        <section class="lg:col-span-2 xl:col-span-2 bento-card p-6 flex flex-col justify-between">
            <h3 class="font-bold text-on-surface dark:text-white mb-6 flex items-center gap-2">
                <span class="material-symbols-rounded text-primary">analytics</span>
                Ringkasan Akademik
            </h3>
            <div class="grid grid-cols-2 gap-4 flex-1 items-center">
                <div class="flex flex-col items-center">
                    <div class="relative w-24 h-24 mb-2">
                        <svg class="w-full h-full" viewbox="0 0 100 100">
                            <circle class="text-surface-container dark:text-slate-800 stroke-current" cx="50" cy="50" fill="transparent" r="40" stroke-width="8"></circle>
                            <circle class="text-primary stroke-current progress-ring__circle" cx="50" cy="50" fill="transparent" r="40" stroke-linecap="round" stroke-width="8" style="stroke-dasharray: 251.2; stroke-dashoffset: 62.8;"></circle>
                        </svg>
                        <span class="absolute inset-0 flex items-center justify-center font-bold text-on-surface dark:text-white">75%</span>
                    </div>
                    <span class="text-xs font-bold text-on-surface-variant dark:text-slate-400">Materi</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="relative w-24 h-24 mb-2">
                        <svg class="w-full h-full" viewbox="0 0 100 100">
                            <circle class="text-surface-container dark:text-slate-800 stroke-current" cx="50" cy="50" fill="transparent" r="40" stroke-width="8"></circle>
                            <circle class="text-success stroke-current progress-ring__circle" cx="50" cy="50" fill="transparent" r="40" stroke-linecap="round" stroke-width="8" style="stroke-dasharray: 251.2; stroke-dashoffset: 25.12;"></circle>
                        </svg>
                        <span class="absolute inset-0 flex items-center justify-center font-bold text-on-surface dark:text-white">90%</span>
                    </div>
                    <span class="text-xs font-bold text-on-surface-variant dark:text-slate-400">Kehadiran</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="relative w-24 h-24 mb-2">
                        <svg class="w-full h-full" viewbox="0 0 100 100">
                            <circle class="text-surface-container dark:text-slate-800 stroke-current" cx="50" cy="50" fill="transparent" r="40" stroke-width="8"></circle>
                            <circle class="text-tertiary stroke-current progress-ring__circle" cx="50" cy="50" fill="transparent" r="40" stroke-linecap="round" stroke-width="8" style="stroke-dasharray: 251.2; stroke-dashoffset: 130.6;"></circle>
                        </svg>
                        <span class="absolute inset-0 flex items-center justify-center font-bold text-on-surface dark:text-white">48%</span>
                    </div>
                    <span class="text-xs font-bold text-on-surface-variant dark:text-slate-400">Penilaian</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="relative w-24 h-24 mb-2">
                        <svg class="w-full h-full" viewbox="0 0 100 100">
                            <circle class="text-surface-container dark:text-slate-800 stroke-current" cx="50" cy="50" fill="transparent" r="40" stroke-width="8"></circle>
                            <circle class="text-primary stroke-current progress-ring__circle" cx="50" cy="50" fill="transparent" r="40" stroke-linecap="round" stroke-width="8" style="stroke-dasharray: 251.2; stroke-dashoffset: 87.9;"></circle>
                        </svg>
                        <span class="absolute inset-0 flex items-center justify-center font-bold text-on-surface dark:text-white">65%</span>
                    </div>
                    <span class="text-xs font-bold text-on-surface-variant dark:text-slate-400">Semester</span>
                </div>
            </div>
        </section>

        <!-- Premium KPI Widgets (Small Cards 1x1) -->
        
        <!-- KPI 1 -->
        <div class="bento-card p-5 border-l-4 border-primary bg-primary/5 dark:bg-primary/10 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-3">
                <div class="p-2 bg-primary/10 rounded-lg text-primary">
                    <span class="material-symbols-rounded">calendar_today</span>
                </div>
                <span class="text-[10px] font-extrabold text-success bg-success/10 px-1.5 py-0.5 rounded">+2 Hari ini</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant dark:text-slate-400 uppercase tracking-wide">Sesi Hari Ini</p>
                <h4 class="text-2xl font-extrabold text-on-surface dark:text-white">{{ $todayClassesCount }} Sesi</h4>
            </div>
            <div class="mt-2 h-1 w-full bg-surface-container dark:bg-slate-700 rounded-full">
                <div class="h-full bg-primary rounded-full" style="width: 60%"></div>
            </div>
        </div>

        <!-- KPI 2 -->
        <div class="bento-card p-5 border-l-4 border-tertiary flex flex-col justify-between">
            <div class="flex justify-between items-start mb-3">
                <div class="p-2 bg-tertiary/10 rounded-lg text-tertiary">
                    <span class="material-symbols-rounded">schedule</span>
                </div>
                <span class="text-[10px] font-extrabold text-tertiary bg-tertiary/10 px-1.5 py-0.5 rounded">82% Target</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant dark:text-slate-400 uppercase tracking-wide">Jam Mengajar</p>
                <h4 class="text-2xl font-extrabold text-on-surface dark:text-white">{{ $teachingHours }} Jam</h4>
            </div>
            <div class="mt-2 flex items-center gap-1">
                <svg class="text-tertiary/40" height="20" width="60">
                    <polyline class="sparkline" fill="none" points="0,15 10,12 20,18 30,5 40,10 50,2 60,8" stroke="currentColor" stroke-width="2"></polyline>
                </svg>
            </div>
        </div>

        <!-- KPI 3 -->
        <div class="bento-card p-5 border-l-4 border-error bg-error/5 dark:bg-error/10 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-3">
                <div class="p-2 bg-error/10 rounded-lg text-error">
                    <span class="material-symbols-rounded">pending_actions</span>
                </div>
                <span class="text-[10px] font-extrabold text-error bg-error/10 px-1.5 py-0.5 rounded animate-pulse">PENTING</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant dark:text-slate-400 uppercase tracking-wide">Belum Dinilai</p>
                <h4 class="text-2xl font-extrabold text-on-surface dark:text-white">{{ $waitingGradingCount }} Tugas</h4>
            </div>
            <p class="text-[10px] text-on-surface-variant dark:text-slate-400 mt-2 italic">*Koreksi segera</p>
        </div>

        <!-- KPI 4 -->
        <div class="bento-card p-5 border-l-4 border-success flex flex-col justify-between">
            <div class="flex justify-between items-start mb-3">
                <div class="p-2 bg-success/10 rounded-lg text-success">
                    <span class="material-symbols-rounded">person_alert</span>
                </div>
                <span class="text-[10px] font-extrabold text-error bg-error/10 px-1.5 py-0.5 rounded">Segera</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant dark:text-slate-400 uppercase tracking-wide">Belum Absensi</p>
                <h4 class="text-2xl font-extrabold text-on-surface dark:text-white">2 Kelas</h4>
            </div>
            <div class="mt-3">
                <a href="/guru/absensis" class="text-[10px] font-bold text-primary hover:underline">Selesaikan Sekarang →</a>
            </div>
        </div>

        <!-- KPI 5 -->
        <div class="bento-card p-5 border-l-4 border-primary/40 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-3">
                <div class="p-2 bg-primary/5 rounded-lg text-primary">
                    <span class="material-symbols-rounded">grade</span>
                </div>
                <span class="text-[10px] font-extrabold text-success bg-success/10 px-1.5 py-0.5 rounded">↑ 4%</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant dark:text-slate-400 uppercase tracking-wide">Rerata Nilai</p>
                <h4 class="text-2xl font-extrabold text-on-surface dark:text-white">84.5</h4>
            </div>
            <div class="mt-2 flex items-center gap-1">
                <svg class="text-success/40" height="20" width="60">
                    <polyline class="sparkline" fill="none" points="0,18 10,15 20,12 30,10 40,5 50,8 60,2" stroke="currentColor" stroke-width="2"></polyline>
                </svg>
            </div>
        </div>

        <!-- KPI 6 -->
        <div class="bento-card p-5 border-l-4 border-indigo-500 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-3">
                <div class="p-2 bg-indigo-50 dark:bg-indigo-900/10 rounded-lg text-indigo-500">
                    <span class="material-symbols-rounded">menu_book</span>
                </div>
                <span class="text-[10px] font-extrabold text-indigo-500 bg-indigo-50 dark:bg-indigo-900/15 px-1.5 py-0.5 rounded">+3 Baru</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant dark:text-slate-400 uppercase tracking-wide">Modul Aktif</p>
                <h4 class="text-2xl font-extrabold text-on-surface dark:text-white">{{ $materialsCount }} Modul</h4>
            </div>
            <p class="text-[10px] text-indigo-500 mt-2">Materi Aktif</p>
        </div>

        <!-- Today's Teaching Schedule (Large Bento) -->
        <section class="lg:col-span-4 xl:col-span-4 bento-card p-8 flex flex-col justify-between">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-on-surface dark:text-white">Jadwal Mengajar Hari Ini</h2>
                    <p class="text-sm text-on-surface-variant dark:text-slate-400">Kamis, 24 Oktober 2026</p>
                </div>
                <a href="/guru/jadwal-pelajarans" class="px-4 py-2 bg-surface-container dark:bg-slate-800 hover:bg-surface-container-high dark:hover:bg-slate-700 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                    Lihat Kalender Lengkap
                    <span class="material-symbols-rounded text-sm">open_in_new</span>
                </a>
            </div>
            
            <div class="relative space-y-6 before:content-[''] before:absolute before:left-[19px] before:top-2 before:bottom-2 before:w-[2px] before:bg-outline-variant/30">
                @if($todaySchedule->count() > 0)
                    @foreach($todaySchedule as $index => $item)
                        <!-- Dynamic Class Card -->
                        <div class="relative pl-14 group">
                            @if($index === 0)
                                <div class="absolute left-0 top-1.5 w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white z-10 shadow-lg shadow-primary/30 outline outline-4 outline-background dark:outline-slate-900 ring-2 ring-primary/20 animate-pulse">
                                    <span class="material-symbols-rounded text-lg">play_arrow</span>
                                </div>
                            @else
                                <div class="absolute left-0 top-1.5 w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 z-10 border-2 border-white dark:border-slate-950 flex items-center justify-center">
                                    <span class="material-symbols-rounded text-lg">event</span>
                                </div>
                            @endif

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 rounded-2xl {{ $index === 0 ? 'bg-primary/5 border-2 border-primary/20' : 'bg-slate-50/50 dark:bg-slate-800/40 border border-transparent' }} hover:border-primary/20 transition-all">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-bold text-lg text-on-surface dark:text-white">{{ $item->mataPelajaran?->nama }}</h4>
                                        <span class="text-[10px] font-bold bg-primary/10 text-primary dark:bg-primary/20 dark:text-blue-300 px-2 py-0.5 rounded-full uppercase">
                                            {{ $item->kelas?->nama_kelas }}
                                        </span>
                                    </div>
                                    <p class="text-on-surface-variant dark:text-slate-400 text-sm flex items-center gap-2">
                                        <span class="material-symbols-rounded text-sm">schedule</span> {{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }}
                                        <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                                        <span class="material-symbols-rounded text-sm">location_on</span> Ruang {{ $item->kelas?->ruangan ?? 'Lab' }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if($index === 0)
                                        <span class="text-xs font-bold text-slate-505 mr-2" x-text="'Sisa: ' + Math.floor(timeRemaining / 60) + 'm ' + (timeRemaining % 60) + 's'"></span>
                                        <a href="/guru/absensis" class="bg-primary text-white px-6 py-2.5 rounded-xl font-bold hover:opacity-90 shadow-md shadow-primary/20 transition-all">Absensi</a>
                                    @else
                                        <span class="text-xs font-semibold text-slate-400">Menunggu</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback: Static HTML items matching user template -->
                    <div class="relative pl-14 group">
                        <div class="absolute left-0 top-1 w-10 h-10 rounded-full bg-success flex items-center justify-center text-white z-10 shadow-lg shadow-success/20">
                            <span class="material-symbols-rounded">check</span>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-5 rounded-2xl bg-surface-container-low/50 border border-transparent hover:border-outline-variant transition-all">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-lg text-on-surface">Matematika Diskrit (IF-201)</h4>
                                    <span class="text-[10px] font-bold bg-success/10 text-success px-2 py-0.5 rounded-full uppercase">Selesai</span>
                                </div>
                                <p class="text-on-surface-variant text-sm flex items-center gap-2">
                                    <span class="material-symbols-rounded text-sm">schedule</span> 08:00 - 09:40 
                                    <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                                    <span class="material-symbols-rounded text-sm">location_on</span> Ruang Lab Komputer 1
                                </p>
                            </div>
                            <button class="text-primary font-bold text-sm hover:underline">Lihat Ringkasan</button>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Insights & Activity (Medium Bento 2x2) -->
        <section class="lg:col-span-2 xl:col-span-2 bento-card p-6 flex flex-col justify-between gap-6">
            <div>
                <h3 class="font-bold text-on-surface dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-rounded text-primary">person_search</span>
                    Wawasan Mahasiswa
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-success/5 border border-success/10 dark:bg-success/10 dark:border-success/20">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-success/20 text-success flex items-center justify-center font-bold">BP</div>
                            <div>
                                <p class="text-sm font-bold">Bambang Pamungkas</p>
                                <p class="text-[10px] text-on-surface-variant dark:text-slate-400">Performa Tertinggi (98.5)</p>
                            </div>
                        </div>
                        <span class="material-symbols-rounded text-success">trending_up</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-error/5 border border-error/10 dark:bg-error/10 dark:border-error/20">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-error/20 text-error flex items-center justify-center font-bold">AW</div>
                            <div>
                                <p class="text-sm font-bold">Agus Wijaya</p>
                                <p class="text-[10px] text-on-surface-variant dark:text-slate-400">Butuh Perhatian (Absensi &lt; 75%)</p>
                            </div>
                        </div>
                        <span class="material-symbols-rounded text-error">priority_high</span>
                    </div>
                </div>
            </div>
            
            <div class="flex-1 mt-4">
                <h3 class="font-bold text-on-surface dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-rounded text-primary">timeline</span>
                    Aktivitas Terbaru
                </h3>
                <div class="space-y-4">
                    <div class="flex gap-3 text-xs">
                        <div class="w-2 h-2 rounded-full bg-primary mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p><span class="font-bold">Siti Lestari</span> mengunggah tugas Implementasi Linked List</p>
                            <p class="text-[10px] text-on-surface-variant dark:text-slate-400">Baru saja • Struktur Data</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modern Table Section (Full Width) -->
        <section class="lg:col-span-6 bento-card overflow-hidden flex flex-col justify-between">
            <div class="p-6 border-b border-glass-stroke dark:border-slate-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white/50 dark:bg-slate-900/50">
                <div>
                    <h2 class="text-xl font-extrabold text-on-surface dark:text-white">Pengumpulan Tugas Terbaru</h2>
                    <p class="text-sm text-on-surface-variant dark:text-slate-400 font-medium">Kelola pengiriman dari semua kelas Anda</p>
                </div>
                <div class="flex gap-3 w-full md:w-auto">
                    <select class="bg-surface dark:bg-slate-800 border-outline-variant dark:border-slate-700 rounded-xl text-sm font-semibold focus:ring-primary dark:text-white">
                        <option>Semua Kelas</option>
                        <option>Algoritma</option>
                        <option>Struktur Data</option>
                    </select>
                    <a href="/guru/pengumpulan-tugas" class="bg-primary/10 text-primary px-4 py-2 rounded-xl text-sm font-bold hover:bg-primary/20 transition-all flex items-center gap-2">
                        <span class="material-symbols-rounded text-base">filter_list</span> Filter
                    </a>
                </div>
            </div>
            
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low/50 dark:bg-slate-850/50 sticky top-0 backdrop-blur-sm z-20">
                        <tr>
                            <th class="px-6 py-4 text-xs font-black text-on-surface-variant dark:text-slate-300 uppercase tracking-widest">Mahasiswa</th>
                            <th class="px-6 py-4 text-xs font-black text-on-surface-variant dark:text-slate-300 uppercase tracking-widest">Mata Kuliah</th>
                            <th class="px-6 py-4 text-xs font-black text-on-surface-variant dark:text-slate-300 uppercase tracking-widest">Judul Tugas</th>
                            <th class="px-6 py-4 text-xs font-black text-on-surface-variant dark:text-slate-300 uppercase tracking-widest">Waktu</th>
                            <th class="px-6 py-4 text-xs font-black text-on-surface-variant dark:text-slate-300 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/30 dark:divide-slate-800 text-sm">
                        @if($recentSubmissions->count() > 0)
                            @foreach($recentSubmissions as $sub)
                                <tr class="hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                                {{ substr($sub->siswa?->nama ?? 'S', 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-on-surface dark:text-white">{{ $sub->siswa?->nama }}</p>
                                                <p class="text-[10px] text-on-surface-variant dark:text-slate-400">NISN: {{ $sub->siswa?->nisn }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-slate-700 dark:text-slate-300">
                                        {{ $sub->tugas?->mataPelajaran?->nama }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                        {{ $sub->tugas?->judul }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-400">
                                        {{ $sub->tanggal_pengumpulan?->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($sub->nilai)
                                            <span class="px-3 py-1 bg-success/10 text-success rounded-full text-[10px] font-black uppercase tracking-tight">DINILAI: {{ $sub->nilai }}</span>
                                        @else
                                            <span class="px-3 py-1 bg-error/10 text-error rounded-full text-[10px] font-black uppercase tracking-tight">BELUM DINILAI</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="/guru/pengumpulan-tugas/{{ $sub->id }}" class="p-2 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all shadow-sm group-hover:scale-110 flex items-center justify-center inline-block">
                                            <span class="material-symbols-rounded text-lg">rate_review</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="hover:bg-primary/5 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-fixed text-primary flex items-center justify-center font-bold text-sm">BP</div>
                                        <div>
                                            <p class="font-bold text-on-surface text-sm">Bambang Pamungkas</p>
                                            <p class="text-[10px] text-on-surface-variant">NIM: 2024001</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">Algoritma &amp; Pemprog.</td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">Laporan Praktikum 5</td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">08:45 AM</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-error/10 text-error rounded-full text-[10px] font-black uppercase tracking-tight">BELUM DINILAI</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="p-2 rounded-lg hover:bg-primary text-primary hover:text-white transition-all shadow-sm group-hover:scale-110">
                                        <span class="material-symbols-rounded text-lg">rate_review</span>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-surface-container-lowest dark:bg-slate-900 text-center border-t border-slate-100 dark:border-slate-800">
                <a class="text-sm font-bold text-primary hover:underline" href="/guru/pengumpulan-tugas">Lihat Semua Pengumpulan (45)</a>
            </div>
        </section>

        <!-- Attendance Stats (2/3 width) -->
        <section class="lg:col-span-4 bento-card p-6 flex flex-col justify-between">
            <h3 class="font-bold text-on-surface dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-rounded text-primary">bar_chart</span>
                Kehadiran Siswa Bulan Ini
            </h3>
            
            @php
                $totalAttendance = array_sum($attendanceStats);
                $hadirH = $totalAttendance > 0 ? ($attendanceStats['hadir'] / $totalAttendance) * 100 : 75;
                $izinH = $totalAttendance > 0 ? ($attendanceStats['izin'] / $totalAttendance) * 100 : 12;
                $sakitH = $totalAttendance > 0 ? ($attendanceStats['sakit'] / $totalAttendance) * 100 : 5;
                $alfaH = $totalAttendance > 0 ? ($attendanceStats['alfa'] / $totalAttendance) * 100 : 2;
            @endphp
            <div class="flex items-end justify-between gap-6 h-56 pt-6 text-center">
                <!-- Hadir -->
                <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $attendanceStats['hadir'] }}</span>
                    <div class="w-full bg-gradient-to-t from-primary to-blue-400 rounded-t-lg shadow-lg" style="height: {{ max($hadirH, 15) }}%;"></div>
                    <span class="text-xs font-bold text-slate-500">Hadir</span>
                </div>
                <!-- Izin -->
                <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $attendanceStats['izin'] }}</span>
                    <div class="w-full bg-gradient-to-t from-warning to-amber-300 rounded-t-lg shadow-lg" style="height: {{ max($izinH, 15) }}%;"></div>
                    <span class="text-xs font-bold text-slate-500">Izin</span>
                </div>
                <!-- Sakit -->
                <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $attendanceStats['sakit'] }}</span>
                    <div class="w-full bg-gradient-to-t from-success to-emerald-300 rounded-t-lg shadow-lg" style="height: {{ max($sakitH, 15) }}%;"></div>
                    <span class="text-xs font-bold text-slate-500">Sakit</span>
                </div>
                <!-- Alfa -->
                <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end">
                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $attendanceStats['alfa'] }}</span>
                    <div class="w-full bg-gradient-to-t from-error to-red-400 rounded-t-lg shadow-lg" style="height: {{ max($alfaH, 15) }}%;"></div>
                    <span class="text-xs font-bold text-slate-500">Alpha</span>
                </div>
            </div>
        </section>

        <!-- Announcements (1/3 width) -->
        <section class="lg:col-span-2 bento-card p-6 flex flex-col justify-between">
            <h3 class="font-bold text-on-surface dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-rounded text-primary">campaign</span>
                Pengumuman Sekolah
            </h3>
            
            <div class="space-y-4 flex-1">
                @foreach($announcements as $ann)
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 space-y-1.5 hover:border-primary/20 transition-all text-left">
                        <span class="text-[9px] font-bold text-primary dark:text-blue-300 uppercase tracking-widest">{{ $ann->kategori }}</span>
                        <h4 class="text-xs font-bold text-slate-800 dark:text-white leading-snug">{{ $ann->title }}</h4>
                        <p class="text-[10px] text-slate-450">{{ $ann->tanggal ? $ann->tanggal->format('d M Y') : '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="mt-4 p-8 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-6 opacity-60">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center">
                <span class="material-symbols-rounded text-primary text-sm">school</span>
            </div>
            <span class="font-bold text-primary">EduPremium Academic</span>
        </div>
        <p class="text-xs font-medium">© 2026 Integrated Academic Information System. Designed for Excellence.</p>
        <div class="flex gap-6 text-xs font-bold uppercase tracking-widest">
            <a class="hover:text-primary transition-colors" href="#">Dukungan</a>
            <a class="hover:text-primary transition-colors" href="#">Kebijakan</a>
            <a class="hover:text-primary transition-colors" href="#">Panduan</a>
        </div>
    </footer>
    
    <!-- Quick Action Menu -->
    <div class="fixed bottom-6 right-6 z-40" x-data="{ fabOpen: false }">
        <div x-show="fabOpen" x-transition.scale.origin.bottom.right class="flex flex-col gap-3 mb-4 items-end" style="display: none;">
            <a href="/guru/nilais/create" class="flex items-center gap-2 bg-white dark:bg-slate-800 text-slate-800 dark:text-white px-4 py-2 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 hover:scale-105 transition-all text-xs font-bold">
                <span class="material-symbols-rounded text-base text-primary">edit_square</span> Input Nilai
            </a>
            <a href="/guru/materis/create" class="flex items-center gap-2 bg-white dark:bg-slate-800 text-slate-800 dark:text-white px-4 py-2 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 hover:scale-105 transition-all text-xs font-bold">
                <span class="material-symbols-rounded text-base text-primary">upload_file</span> Upload Materi
            </a>
            <a href="/guru/absensis" class="flex items-center gap-2 bg-white dark:bg-slate-800 text-slate-800 dark:text-white px-4 py-2 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 hover:scale-105 transition-all text-xs font-bold">
                <span class="material-symbols-rounded text-base text-success">fact_check</span> Absensi
            </a>
        </div>
        <button @click="fabOpen = !fabOpen" class="w-14 h-14 bg-primary text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-105 hover:bg-blue-600 active:scale-95 transition-all">
            <span class="material-symbols-rounded text-2xl transition-transform duration-300" :class="fabOpen ? 'rotate-45' : ''">add</span>
        </button>
    </div>

</div>

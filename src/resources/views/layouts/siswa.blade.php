<!DOCTYPE html>
<html class="light" lang="id" x-data="{ darkMode: false }" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>SchonaNexa - Student Learning Portal</title>
    
    <!-- AlpineJS for UI States -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS with Forms and Container Queries -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "error-container": "#ffdad6",
                    "on-primary-fixed": "#00174b",
                    "background": "#f7f9fb",
                    "glass-stroke": "rgba(255, 255, 255, 0.4)",
                    "surface-container": "#eceef0",
                    "secondary-fixed": "#dae2fd",
                    "surface-variant": "#e0e3e5",
                    "on-primary-fixed-variant": "#003ea8",
                    "tertiary-fixed-dim": "#ffb95f",
                    "on-primary-container": "#eeefff",
                    "on-secondary-fixed-variant": "#3f465c",
                    "primary-fixed": "#dbe1ff",
                    "primary-container": "#2563eb",
                    "outline": "#737686",
                    "surface-dim": "#d8dadc",
                    "on-surface": "#191c1e",
                    "on-surface-variant": "#434655",
                    "primary": "#004ac6",
                    "on-tertiary-container": "#ffeedd",
                    "secondary-fixed-dim": "#bec6e0",
                    "on-tertiary": "#ffffff",
                    "outline-variant": "#c3c6d7",
                    "on-secondary-container": "#5c647a",
                    "tertiary": "#784b00",
                    "inverse-surface": "#2d3133",
                    "on-error": "#ffffff",
                    "on-error-container": "#93000a",
                    "surface-tint": "#0053db",
                    "surface-container-low": "#f2f4f6",
                    "primary-fixed-dim": "#b4c5ff",
                    "surface-container-highest": "#e0e3e5",
                    "surface-container-high": "#e6e8ea",
                    "on-primary": "#ffffff",
                    "inverse-on-surface": "#eff1f3",
                    "on-secondary": "#ffffff",
                    "tertiary-fixed": "#ffddb8",
                    "secondary": "#565e74",
                    "surface": "#FFFFFF",
                    "error": "#ba1a1a",
                    "glass-fill": "rgba(255, 255, 255, 0.7)",
                    "surface-container-lowest": "#ffffff",
                    "surface-bright": "#f7f9fb",
                    "tertiary-container": "#996100",
                    "on-secondary-fixed": "#131b2e",
                    "secondary-container": "#dae2fd",
                    "on-background": "#191c1e",
                    "inverse-primary": "#b4c5ff",
                    "on-tertiary-fixed-variant": "#653e00",
                    "success": "#22C55E",
                    "on-tertiary-fixed": "#2a1700"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "2xl": "1rem",
                    "3xl": "1.5rem",
                    "full": "9999px"
            },
            "spacing": {
                    "stack-xl": "80px",
                    "margin-tablet": "32px",
                    "gutter": "32px",
                    "margin-mobile": "20px",
                    "margin-desktop": "64px",
                    "stack-md": "24px",
                    "stack-lg": "48px",
                    "container-max": "1440px"
            },
            "fontFamily": {
                    "sans": ["Plus Jakarta Sans", "sans-serif"]
            }
          },
        },
      }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f7f9fb;
            background-image: radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.05) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(120, 75, 0, 0.05) 0px, transparent 50%);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0px 10px 30px rgba(15, 23, 42, 0.04);
            border-radius: 24px;
            transition: transform 0.3s ease;
        }
        .glass-card:hover {
            transform: translateY(-4px);
        }
        .floating-anim {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c3c6d7;
            border-radius: 10px;
        }
        .floating-3d {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
    </style>
</head>
<body class="min-h-screen text-on-surface overflow-x-hidden">

    @php
        $user = auth()->user();
        $siswa = $user->siswa;
        $activeKelasSiswa = $siswa ? $siswa->kelasSiswas()->where('status', true)->first() : null;
        $activeKelasName = $activeKelasSiswa && $activeKelasSiswa->kelas ? $activeKelasSiswa->kelas->nama_kelas : 'Umum';

        $isDashboard = request()->is('siswa');
        $isMateri = request()->is('siswa/materi*');
        $isTugas = request()->is('siswa/tugas*');
        $isNilai = request()->is('siswa/nilai*');
        $isAbsensi = request()->is('siswa/absensi*');
        $isRapor = request()->is('siswa/rapor*');
        $isPembayaran = request()->is('siswa/pembayaran*');
        $isPengumuman = request()->is('siswa/pengumuman*');
        $isProfile = request()->is('siswa/profile*');
        $isSettings = request()->is('siswa/settings*');
    @endphp

    <!-- SideNavBar -->
    <aside class="fixed left-0 top-0 h-full w-[280px] rounded-r-3xl backdrop-blur-xl bg-glass-fill dark:bg-inverse-surface/80 border-r border-glass-stroke dark:border-outline-variant shadow-lg flex flex-col py-8 px-6 gap-2 z-50">
        <div class="mb-8 flex items-center gap-3 px-3">
            <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1;">school</span>
            <div class="flex flex-col">
                <span class="text-xl font-bold text-primary dark:text-primary-fixed">SchonaNexa</span>
                <span class="text-xs text-on-surface-variant/70">Education System</span>
            </div>
        </div>
        <nav class="flex-1 flex flex-col gap-1 overflow-y-auto custom-scrollbar">
            <!-- Dashboard -->
            <a class="{{ $isDashboard ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>

            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-3 mt-4 mb-2">Akademik</div>

            <!-- Materi -->
            <a class="{{ $isMateri ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/materi">
                <span class="material-symbols-outlined">auto_stories</span>
                <span>Materi</span>
            </a>
            <!-- Bank Soal -->
            @if ($activeKelasName && (str_contains($activeKelasName, '12') || $activeKelasSiswa?->kelas?->tingkat === 'XII'))
            <a class="{{ request()->is('siswa/bank-soal*') ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/bank-soal">
                <span class="material-symbols-outlined">quiz</span>
                <span>Bank Soal</span>
            </a>
            @endif
            <!-- Tugas -->
            <a class="{{ $isTugas ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/tugas">
                <span class="material-symbols-outlined">assignment</span>
                <span>Tugas</span>
            </a>
            <!-- Nilai -->
            <a class="{{ $isNilai ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/nilai">
                <span class="material-symbols-outlined">grade</span>
                <span>Nilai</span>
            </a>
            <!-- Absensi -->
            <a class="{{ $isAbsensi ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/absensi">
                <span class="material-symbols-outlined">how_to_reg</span>
                <span>Absensi</span>
            </a>
            <!-- Rapor -->
            <a class="{{ $isRapor ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/rapor">
                <span class="material-symbols-outlined">workspace_premium</span>
                <span>Rapor</span>
            </a>

            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-3 mt-4 mb-2">Keuangan</div>

            <!-- Pembayaran -->
            <a class="{{ $isPembayaran ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/pembayaran">
                <span class="material-symbols-outlined">payments</span>
                <span>Pembayaran</span>
            </a>

            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-3 mt-4 mb-2">Informasi</div>

            <!-- Pengumuman -->
            <a class="{{ $isPengumuman ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/pengumuman">
                <span class="material-symbols-outlined">campaign</span>
                <span>Pengumuman</span>
            </a>

            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-3 mt-4 mb-2">Akun</div>

            <!-- Profile -->
            <a class="{{ $isProfile ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/profile">
                <span class="material-symbols-outlined">person</span>
                <span>Profil</span>
            </a>
            <!-- Settings -->
            <a class="{{ $isSettings ? 'bg-primary-container text-on-primary-container dark:bg-primary-fixed dark:text-on-primary-fixed' : 'text-on-surface-variant hover:text-primary dark:text-outline-variant hover:bg-surface-variant/50 dark:hover:bg-surface-container-highest/50' }} p-3 flex items-center gap-3 transition-all rounded-xl font-semibold" href="/siswa/settings">
                <span class="material-symbols-outlined">settings</span>
                <span>Pengaturan</span>
            </a>
        </nav>
    </aside>

    <!-- TopNavBar -->
    <header class="fixed top-4 right-4 left-[300px] h-20 rounded-2xl backdrop-blur-2xl bg-glass-fill/70 border border-glass-stroke shadow-md flex items-center justify-between px-6 z-40 transition-all duration-300">
        <div class="flex items-center flex-1 max-w-xl">
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input class="w-full bg-surface-container-low border-none rounded-full py-3 pl-12 pr-4 font-semibold text-sm focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Cari materi, tugas, atau nilai..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <button class="relative p-2 rounded-full hover:bg-surface-variant/30 transition-all">
                <span class="material-symbols-outlined text-on-surface-variant">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
            </button>
            
            <div class="flex items-center gap-3 border-l border-glass-stroke pl-6" x-data="{ profileDropdown: false }">
                <div class="text-right cursor-pointer" @click="profileDropdown = !profileDropdown">
                    <p class="font-bold text-sm leading-tight text-on-surface">{{ $siswa ? $siswa->nama : $user->name }}</p>
                    <p class="text-[10px] text-on-surface-variant/70 leading-tight uppercase font-black">Siswa • {{ $activeKelasName }}</p>
                </div>
                
                <div class="relative">
                    <div class="w-10 h-10 rounded-full border-2 border-primary overflow-hidden shadow-sm cursor-pointer" @click="profileDropdown = !profileDropdown">
                        <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAu-FPKn4wnoSucxhcyk60ZHaNM66ViXGwgKD9kz7xSHeg89W-wUHgXV30Es5ZH_LI7WIKEe-v5okET0g-soziCb9fz51_kXpRiEWe7m35jy7CZPPillBzyGFSVntelBuamMiUMEsbyRSLbvHfzVmM-ashQKJPk1L_vHSpPR98hnnaBmaumt3KbexsYiipFk18_Jpfb7jmwXSlTgKf45K9I700sr1302E7rTXfKmbRKmvbCjMqDJlBI" alt="Avatar"/>
                    </div>
                    
                    <!-- Dropdown -->
                    <div x-show="profileDropdown" @click.away="profileDropdown = false" 
                         class="absolute right-0 top-12 w-48 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-xl shadow-2xl p-2 space-y-1 z-50 text-left"
                         style="display: none;"
                         x-transition>
                        <a href="/siswa/profile" class="flex items-center gap-2 p-2 rounded-lg text-sm text-slate-700 dark:text-slate-300 hover:bg-primary/5 transition-all font-semibold">
                            <span class="material-symbols-outlined text-lg">person</span> Profil Saya
                        </a>
                        <a href="/siswa/settings" class="flex items-center gap-2 p-2 rounded-lg text-sm text-slate-700 dark:text-slate-300 hover:bg-primary/5 transition-all font-semibold">
                            <span class="material-symbols-outlined text-lg">settings</span> Pengaturan
                        </a>
                        <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>
                        <form action="{{ route('filament.siswa.auth.logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2 p-2 rounded-lg text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all font-semibold">
                                <span class="material-symbols-outlined text-lg text-red-600">logout</span> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="ml-[280px] pt-32 px-8 pb-12 min-h-screen relative overflow-hidden">
        @if (session('success'))
            <div class="mb-4 rounded-xl bg-success/10 border border-success/20 p-4 text-success flex items-center gap-3 relative z-50">
                <span class="material-symbols-outlined">check_circle</span>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif
        
        @if (session('error'))
            <div class="mb-4 rounded-xl bg-error/10 border border-error/20 p-4 text-error flex items-center gap-3 relative z-50">
                <span class="material-symbols-outlined">error</span>
                <p class="font-bold text-sm">{{ session('error') }}</p>
            </div>
        @endif

        {{ $slot }}
    </main>

    <script>
        // Micro-interactions for smooth hovering on cards
        document.querySelectorAll('.glass-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0px)';
            });
        });
    </script>
</body>
</html>

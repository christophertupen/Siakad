<!DOCTYPE html>
<html class="light" lang="id" x-data="{ darkMode: false }" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>SIAKAD - Parent Portal</title>
    
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
                    "primary": "#004ac6", // Premium Blue
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
                    "margin-tablet": "32px",
                    "stack-xl": "80px",
                    "stack-md": "24px",
                    "margin-mobile": "20px",
                    "stack-lg": "48px",
                    "margin-desktop": "64px",
                    "gutter": "32px",
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
            background-image: radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.04) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(0, 74, 198, 0.04) 0px, transparent 50%);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0px 10px 30px rgba(15, 23, 42, 0.03);
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
    </style>
</head>
<body class="min-h-screen text-on-surface overflow-x-hidden pb-12">

    @php
        $user = auth()->user();
        $parent = $user->orangTua;
        $child = $parent ? $parent->siswa : null;
        $childKelasSiswa = $child ? $child->kelasSiswas()->where('status', true)->first() : null;
        $childKelasName = $childKelasSiswa && $childKelasSiswa->kelas ? $childKelasSiswa->kelas->nama_kelas : 'Tidak Terdaftar';

        $isDashboard = request()->is('orangtua');
        $isPerkembangan = request()->is('orangtua/perkembangan*');
        $isNilai = request()->is('orangtua/nilai*');
        $isAbsensi = request()->is('orangtua/absensi*');
        $isJadwal = request()->is('orangtua/jadwal*');
        $isPembayaran = request()->is('orangtua/pembayaran*');
        $isPengumuman = request()->is('orangtua/pengumuman*');
        $isProfil = request()->is('orangtua/profil*');
    @endphp

    <!-- TopNavBar Header Wrapper -->
    <header class="fixed top-4 left-1/2 -translate-x-1/2 w-[calc(100%-40px)] max-w-container-max z-50">
        <nav class="flex items-center justify-between px-6 h-20 glass-card bg-white/80 border border-glass-stroke shadow-md backdrop-blur-2xl">
            <!-- Left Side Logo & Navigation Links -->
            <div class="flex items-center gap-8">
                <span class="text-xl font-extrabold text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
                    SIAKAD
                </span>
                
                <!-- Links (Top Navigation) -->
                <div class="hidden lg:flex items-center gap-6">
                    <a href="/orangtua" class="{{ $isDashboard ? 'text-primary font-extrabold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} text-sm font-semibold py-1.5 transition-all">Dashboard</a>
                    <a href="/orangtua/perkembangan" class="{{ $isPerkembangan ? 'text-primary font-extrabold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} text-sm font-semibold py-1.5 transition-all">Perkembangan Anak</a>
                    <a href="/orangtua/nilai" class="{{ $isNilai ? 'text-primary font-extrabold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} text-sm font-semibold py-1.5 transition-all">Nilai</a>
                    <a href="/orangtua/absensi" class="{{ $isAbsensi ? 'text-primary font-extrabold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} text-sm font-semibold py-1.5 transition-all">Absensi</a>
                    <a href="/orangtua/jadwal" class="{{ $isJadwal ? 'text-primary font-extrabold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} text-sm font-semibold py-1.5 transition-all">Jadwal</a>
                    <a href="/orangtua/pembayaran" class="{{ $isPembayaran ? 'text-primary font-extrabold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} text-sm font-semibold py-1.5 transition-all">Pembayaran</a>
                    <a href="/orangtua/pengumuman" class="{{ $isPengumuman ? 'text-primary font-extrabold border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary' }} text-sm font-semibold py-1.5 transition-all">Pengumuman</a>
                </div>
            </div>

            <!-- Right Side Profile Info & Dropdown -->
            <div class="flex items-center gap-4">
                <!-- Child Quick Status Indicator -->
                @if($child)
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/5 text-primary border border-primary/10">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">face</span>
                        <span class="text-xs font-bold">Anak: {{ $child->nama }} ({{ $childKelasName }})</span>
                    </div>
                @endif

                <div class="flex items-center gap-3 pl-4 border-l border-outline-variant/30" x-data="{ profileDropdown: false }">
                    <div class="text-right cursor-pointer hidden md:block" @click="profileDropdown = !profileDropdown">
                        <p class="font-bold text-sm leading-tight text-on-surface">{{ $parent ? $parent->nama : $user->name }}</p>
                        <p class="text-[10px] text-on-surface-variant/70 leading-tight uppercase font-black">Wali Murid</p>
                    </div>
                    
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full border-2 border-primary overflow-hidden shadow-sm cursor-pointer" @click="profileDropdown = !profileDropdown">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAuiWzCG33pYH6vjuqsQJFUUqhSNyBi5UA-Iur4YUIKHNivJCtxAosBwSyJFMrWGkiJnzPevMqT2mNWOW4qoE-imXvL8Fgb7UZzJmWxhMJ6jdEtUuxDRYKzaa4SadHk6kXUIFR_Tv3kQEDFoZExhVw7LMLhvynNp50Wp9wDW_1ZYA4jIAq1AzC0e7bOnzDORNg3kAoCRmfwP_w1ZHvBOR4SyeWRWkwURZluvJh3pBorPsiQ3_7zcbOx" alt="Avatar"/>
                        </div>
                        
                        <!-- Dropdown -->
                        <div x-show="profileDropdown" @click.away="profileDropdown = false" 
                             class="absolute right-0 top-12 w-48 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-xl shadow-2xl p-2 space-y-1 z-50 text-left"
                             style="display: none;"
                             x-transition>
                            <a href="/orangtua/profil" class="flex items-center gap-2 p-2 rounded-lg text-sm text-slate-700 dark:text-slate-300 hover:bg-primary/5 transition-all font-semibold">
                                <span class="material-symbols-outlined text-lg">person</span> Profil Saya
                            </a>
                            <div class="h-px bg-slate-100 dark:bg-slate-800 my-1"></div>
                            <form action="{{ route('filament.orangtua.auth.logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 p-2 rounded-lg text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all font-semibold">
                                    <span class="material-symbols-outlined text-lg text-red-600">logout</span> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Canvas -->
    <main class="pt-32 px-4 md:px-8 max-w-container-max mx-auto space-y-8 min-h-screen">
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

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings->seo_meta_description ?? 'Sistem Informasi Akademik SIAKAD - Platform digitalisasi pendidikan terintegrasi untuk guru, siswa, dan orang tua.' }}">
    <meta name="keywords" content="{{ $settings->seo_keywords ?? 'siakad, sekolah, portal akademik' }}">
    
    <title>{{ $settings->seo_meta_title ?? 'SIAKAD - Sistem Informasi Akademik Modern' }}</title>

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $settings->seo_meta_title ?? 'SIAKAD - Sistem Informasi Akademik Modern' }}">
    <meta property="og:description" content="{{ $settings->seo_meta_description ?? 'Sistem Informasi Akademik SIAKAD' }}">
    @if($settings->seo_og_image)
        <meta property="og:image" content="{{ asset('storage/' . $settings->seo_og_image) }}">
    @endif

    <!-- Favicon -->
    @if($settings->favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $settings->favicon) }}">
    @endif

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- FontAwesome for Premium Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS Dynamic Themes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#2563EB' }};
            --secondary-color: {{ $settings->secondary_color ?? '#0F172A' }};
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: 'var(--primary-color)',
                        secondary: 'var(--secondary-color)',
                        accent: '#F59E0B',
                        success: '#22C55E',
                        background: '#F8FAFC',
                        surface: '#FFFFFF',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    borderRadius: {
                        'premium': '16px',
                    }
                }
            }
        }
    </script>

    <!-- AlpineJS & Intersect Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Local compiled assets from Vite (Tailwind / CSS & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
            color: #0F172A;
            overflow-x: hidden;
        }

        /* Glassmorphism utility */
        .glass-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .glass-panel-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Ambient Glow decoration */
        .glow-sphere {
            filter: blur(120px);
            opacity: 0.45;
            pointer-events: none;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
    </style>
</head>

<body x-data="{ mobileMenuOpen: false, portalModalOpen: false }" :class="portalModalOpen ? 'overflow-hidden' : ''">

    <!-- Ambient Mesh Gradients -->
    <div class="absolute top-0 left-0 w-full overflow-hidden h-[900px] z-0 pointer-events-none">
        <div class="glow-sphere absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-primary rounded-full"></div>
        <div class="glow-sphere absolute top-[40%] right-[-10%] w-[600px] h-[600px] bg-accent rounded-full"></div>
    </div>

    <!-- ***** Navbar Area Start ***** -->
    <nav class="sticky top-0 z-40 glass-panel shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center">
                    <a href="#" class="flex items-center gap-3">
                        @if($settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="h-10 w-auto rounded">
                        @else
                            <div class="w-10 h-10 rounded-premium bg-primary flex items-center justify-center text-white font-black text-xl shadow-md shadow-primary/20">
                                {{ substr($settings->nama_sekolah ?? 'S', 0, 1) }}
                            </div>
                        @endif
                        <span class="text-xl font-extrabold tracking-tight text-secondary">
                            {{ $settings->nama_aplikasi ?? 'SIAKAD' }}
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#hero" class="text-sm font-semibold text-secondary hover:text-primary transition-colors">Home</a>
                    <a href="#why-choose-us" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Keunggulan</a>
                    <a href="#school-profile" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Profil</a>
                    <a href="#features" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Fitur</a>
                    <a href="#news" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Berita</a>
                    <a href="#gallery" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">Galeri</a>
                    <a href="#faq" class="text-sm font-semibold text-slate-600 hover:text-primary transition-colors">FAQ</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <button @click="portalModalOpen = true" class="px-6 py-2.5 rounded-premium bg-secondary text-white text-sm font-bold shadow-md hover:bg-slate-800 hover:-translate-y-0.5 transition-all">
                        Portal Akademik
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-secondary hover:text-primary p-2 focus:outline-none">
                        <i class="fa-solid" :class="mobileMenuOpen ? 'fa-xmark text-2xl' : 'fa-bars text-2xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden glass-panel border-t border-slate-200">
            <div class="px-4 pt-2 pb-6 space-y-4 shadow-lg">
                <a href="#hero" @click="mobileMenuOpen = false" class="block text-base font-semibold text-secondary py-2 border-b border-slate-100">Home</a>
                <a href="#why-choose-us" @click="mobileMenuOpen = false" class="block text-base font-semibold text-slate-600 py-2 border-b border-slate-100">Keunggulan</a>
                <a href="#school-profile" @click="mobileMenuOpen = false" class="block text-base font-semibold text-slate-600 py-2 border-b border-slate-100">Profil</a>
                <a href="#features" @click="mobileMenuOpen = false" class="block text-base font-semibold text-slate-600 py-2 border-b border-slate-100">Fitur</a>
                <a href="#news" @click="mobileMenuOpen = false" class="block text-base font-semibold text-slate-600 py-2 border-b border-slate-100">Berita</a>
                <a href="#gallery" @click="mobileMenuOpen = false" class="block text-base font-semibold text-slate-600 py-2 border-b border-slate-100">Galeri</a>
                <a href="#faq" @click="mobileMenuOpen = false" class="block text-base font-semibold text-slate-600 py-2 border-b border-slate-100">FAQ</a>
                <button @click="mobileMenuOpen = false; portalModalOpen = true" class="block w-full text-center px-6 py-3 rounded-premium bg-primary text-white font-bold">
                    Portal Akademik
                </button>
            </div>
        </div>
    </nav>
    <!-- ***** Navbar Area End ***** -->

    <!-- ***** Hero Area Start ***** -->
    <section id="hero" class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-24 z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left Content -->
            <div class="space-y-8 text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/20">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-xs font-bold text-primary tracking-wide uppercase">{{ $settings->hero_subheadline ?? 'SIAKAD 2.0 Premium' }}</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-secondary leading-[1.1] sm:leading-[1.1]">
                    {!! $settings->hero_headline ?? 'Masa Depan <br class="hidden sm:inline"><span class="bg-gradient-to-r from-primary to-blue-500 bg-clip-text text-transparent">Akademik Digital</span> <br> yang Terintegrasi' !!}
                </h1>
                
                <p class="text-lg text-slate-600 max-w-xl leading-relaxed">
                    {{ $settings->hero_description ?? 'Transformasi pengelolaan sekolah Anda dengan platform digital modern terpadu. Hubungkan administrasi, guru, siswa, dan orang tua dalam satu ekosistem yang pintar dan efisien.' }}
                </p>

                <div class="flex flex-wrap gap-4">
                    @if($settings->hero_button1_text)
                        <button @click="portalModalOpen = true" class="px-8 py-3.5 rounded-premium bg-primary text-white font-bold hover:bg-blue-700 transition-all shadow-lg shadow-primary/20">
                            {{ $settings->hero_button1_text }} <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
                        </button>
                    @endif
                    @if($settings->hero_button2_text)
                        <a href="{{ $settings->hero_button2_url ?? '#school-profile' }}" class="px-8 py-3.5 rounded-premium bg-white text-secondary font-bold border border-slate-200 hover:bg-slate-50 transition-all shadow-sm">
                            {{ $settings->hero_button2_text }}
                        </a>
                    @endif
                </div>

                <!-- Social Proof Badges -->
                <div class="flex flex-wrap items-center gap-6 pt-4 text-slate-500 text-sm font-sans">
                    <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-success"></i> Dipercaya 50+ Sekolah</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-bolt text-accent"></i> Didukung AI Terpadu</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-shield-halved text-primary"></i> Keamanan Enkripsi</div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="relative flex justify-center lg:justify-end">
                <!-- Background decorative glow -->
                <div class="absolute -inset-4 bg-gradient-to-tr from-primary to-accent rounded-[32px] opacity-10 blur-xl"></div>
                
                @if($settings->hero_image)
                    <div class="relative w-full max-w-[500px] aspect-[1.1] rounded-[24px] overflow-hidden shadow-2xl border border-slate-200/50">
                        <img src="{{ asset('storage/' . $settings->hero_image) }}" alt="Hero Graphic" class="w-full h-full object-cover">
                    </div>
                @else
                    <!-- Default UI Mockup representation -->
                    <div class="relative w-full max-w-[500px] aspect-[1.1] rounded-[24px] bg-slate-900 border border-slate-800 shadow-2xl p-6 overflow-hidden flex flex-col justify-between">
                        <!-- Dashboard UI Shell -->
                        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                            <div class="flex items-center gap-3">
                                <span class="w-3 sm:w-4 h-3 sm:h-4 rounded-full bg-red-500"></span>
                                <span class="w-3 sm:w-4 h-3 sm:h-4 rounded-full bg-yellow-500"></span>
                                <span class="w-3 sm:w-4 h-3 sm:h-4 rounded-full bg-green-500"></span>
                            </div>
                            <span class="text-xs font-semibold text-slate-400">{{ str_replace(['http://', 'https://'], '', $settings->website ?? 'siakad.sch.id') }}/dashboard</span>
                            <div class="w-6 h-6 rounded bg-slate-800"></div>
                        </div>

                        <!-- Inner Widgets Grid -->
                        <div class="grid grid-cols-2 gap-4 my-6 flex-grow">
                            <!-- Stat Card 1 -->
                            <div class="glass-panel-dark rounded-premium p-4 flex flex-col justify-between">
                                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wide">Aktif Belajar</span>
                                <div class="text-2xl sm:text-3xl font-extrabold text-white my-1">98.4%</div>
                                <span class="text-[10px] sm:text-xs font-semibold text-success"><i class="fa-solid fa-arrow-up mr-1"></i> +1.2% bulan ini</span>
                            </div>

                            <!-- Stat Card 2 -->
                            <div class="glass-panel-dark rounded-premium p-4 flex flex-col justify-between">
                                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wide">Guru Mengajar</span>
                                <div class="text-2xl sm:text-3xl font-extrabold text-white my-1">100%</div>
                                <span class="text-[10px] sm:text-xs font-semibold text-slate-400">Terverifikasi</span>
                            </div>

                            <!-- Chart Widget -->
                            <div class="col-span-2 glass-panel-dark rounded-premium p-4 flex flex-col justify-between">
                                <div class="flex justify-between items-center pb-2">
                                    <span class="text-xs font-bold text-white">Rerata Nilai Ujian</span>
                                    <span class="text-[10px] font-semibold text-accent">Semester Ganjil</span>
                                </div>
                                <div class="h-20 flex items-end justify-between gap-1 pt-4 relative">
                                    <div class="absolute inset-0 border-b border-dashed border-slate-700/60 h-10"></div>
                                    <div class="w-full bg-blue-500/20 rounded-t h-[60%] border-t-2 border-primary"></div>
                                    <div class="w-full bg-blue-500/20 rounded-t h-[75%] border-t-2 border-primary"></div>
                                    <div class="w-full bg-amber-500/20 rounded-t h-[50%] border-t-2 border-accent"></div>
                                    <div class="w-full bg-blue-500/20 rounded-t h-[90%] border-t-2 border-primary"></div>
                                    <div class="w-full bg-blue-500/20 rounded-t h-[80%] border-t-2 border-primary"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Info inside shell -->
                        <div class="flex justify-between items-center text-[10px] text-slate-500">
                            <span>Pembaruan Sistem: Baru saja</span>
                            <span>v2.8.4</span>
                        </div>
                    </div>
                @endif

                <!-- Floating Card 1 -->
                @if($settings->hero_floating_card1_title)
                    <div class="absolute top-10 left-[-20px] sm:left-[-40px] glass-panel p-4 rounded-premium shadow-xl border border-slate-200/50 flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                        <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center text-accent"><i class="fa-solid fa-award text-lg"></i></div>
                        <div>
                            <div class="text-[10px] font-bold text-slate-500 uppercase">{{ $settings->hero_floating_card1_title }}</div>
                            <div class="text-xs font-bold text-secondary">{{ $settings->hero_floating_card1_desc }}</div>
                        </div>
                    </div>
                @endif

                <!-- Floating Card 2 -->
                @if($settings->hero_floating_card2_title)
                    <div class="absolute bottom-10 right-[-10px] sm:right-[-25px] glass-panel p-4 rounded-premium shadow-xl border border-slate-200/50 flex items-center gap-3 animate-bounce" style="animation-duration: 6s;">
                        <div class="w-10 h-10 rounded-full bg-success/10 flex items-center justify-center text-success"><i class="fa-solid fa-circle-check text-lg"></i></div>
                        <div>
                            <div class="text-[10px] font-bold text-slate-500 uppercase">{{ $settings->hero_floating_card2_title }}</div>
                            <div class="text-xs font-bold text-secondary">{{ $settings->hero_floating_card2_desc }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- ***** Hero Area End ***** -->

    <!-- ***** Statistics Start ***** -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-slate-100">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12" x-data="{ triggered: false }" x-intersect="triggered = true">
            <!-- Stat 1 -->
            <div class="text-center space-y-2">
                <div class="text-4xl sm:text-5xl font-extrabold text-primary flex justify-center items-center">
                    <span x-text="triggered ? '{{ $stats['siswa'] }}+' : '0'">{{ $stats['siswa'] }}+</span>
                </div>
                <div class="text-sm font-semibold text-slate-500">Siswa Aktif</div>
            </div>
            <!-- Stat 2 -->
            <div class="text-center space-y-2">
                <div class="text-4xl sm:text-5xl font-extrabold text-primary flex justify-center items-center">
                    <span x-text="triggered ? '{{ $stats['guru'] }}+' : '0'">{{ $stats['guru'] }}+</span>
                </div>
                <div class="text-sm font-semibold text-slate-500">Guru & Staf Pengajar</div>
            </div>
            <!-- Stat 3 -->
            <div class="text-center space-y-2">
                <div class="text-4xl sm:text-5xl font-extrabold text-primary flex justify-center items-center">
                    <span x-text="triggered ? '{{ $stats['kelas'] }}' : '0'">{{ $stats['kelas'] }}</span>
                </div>
                <div class="text-sm font-semibold text-slate-500">Total Kelas</div>
            </div>
            <!-- Stat 4 -->
            <div class="text-center space-y-2">
                <div class="text-4xl sm:text-5xl font-extrabold text-primary flex justify-center items-center">
                    <span x-text="triggered ? '{{ $stats['alumni'] }}+' : '0'">{{ $stats['alumni'] }}+</span>
                </div>
                <div class="text-sm font-semibold text-slate-500">Total Alumni/Lulusan</div>
            </div>
        </div>
    </section>
    <!-- ***** Statistics End ***** -->

    <!-- ***** Why Choose Us Start ***** -->
    <section id="why-choose-us" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center space-y-4 mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent/10 border border-accent/20">
                <span class="text-xs font-bold text-accent tracking-wide uppercase">Mengapa SIAKAD?</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-secondary">
                Solusi Manajemen Pendidikan Unggulan
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto">
                Kami merancang sistem dengan perhatian penuh pada pengalaman pengguna demi meningkatkan efisiensi proses belajar mengajar.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($keunggulans as $k)
                <div class="bg-white rounded-premium p-8 shadow-sm border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div class="w-12 h-12 rounded-premium bg-blue-100 flex items-center justify-center text-primary mb-6">
                        <i class="fa-solid {{ $k->icon }} text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-secondary mb-3">{{ $k->title }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $k->description }}</p>
                </div>
            @endforeach
        </div>
    </section>
    <!-- ***** Why Choose Us End ***** -->

    <!-- ***** School Profile Start ***** -->
    <section id="school-profile" class="bg-white py-24 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Image -->
                <div class="relative">
                    <div class="absolute -inset-4 bg-primary/10 rounded-[24px] blur-lg pointer-events-none"></div>
                    <div class="relative rounded-premium overflow-hidden shadow-xl border border-slate-200/40 aspect-[4/3] bg-slate-100 flex items-center justify-center">
                        <i class="fa-solid fa-school text-[120px] text-primary/30"></i>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/20">
                        <span class="text-xs font-bold text-primary tracking-wide uppercase font-sans">Profil Sekolah</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-secondary font-sans">
                        Membangun Generasi Unggul berkarakter Mulia
                    </h2>
                    <div class="text-slate-600 leading-relaxed space-y-4">
                        {!! $settings->deskripsi ?? 'Sekolah kami berkomitmen menyediakan fasilitas pendidikan berkualitas tinggi berbasis teknologi informasi.' !!}
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6 pt-4 font-sans">
                        <div class="space-y-2">
                            <h4 class="font-bold text-secondary flex items-center gap-2"><i class="fa-solid fa-eye text-primary"></i> Visi</h4>
                            <div class="text-xs text-slate-500 leading-relaxed">{!! $settings->visi ?? 'Mengintegrasikan sains, adab, dan teknologi informasi.' !!}</div>
                        </div>
                        <div class="space-y-2">
                            <h4 class="font-bold text-secondary flex items-center gap-2"><i class="fa-solid fa-bullseye text-primary"></i> Misi</h4>
                            <div class="text-xs text-slate-500 leading-relaxed">{!! $settings->misi ?? 'Menjamin sistem belajar transparan dan terukur.' !!}</div>
                        </div>
                    </div>

                    @if($settings->kepala_sekolah)
                        <div class="mt-6 p-4 rounded-premium bg-slate-50 border border-slate-100 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500"><i class="fa-solid fa-user-tie"></i></div>
                            <div>
                                <div class="text-xs text-slate-400">Kepala Sekolah</div>
                                <div class="text-sm font-bold text-secondary">{{ $settings->kepala_sekolah }}</div>
                                @if($settings->nip_kepala_sekolah)
                                    <div class="text-[10px] text-slate-500">NIP. {{ $settings->nip_kepala_sekolah }}</div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ***** School Profile End ***** -->

    <!-- ***** Academic Features Start ***** -->
    <section id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center space-y-4 mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/20">
                <span class="text-xs font-bold text-primary tracking-wide uppercase font-sans">Bento Grid Fitur</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-secondary">
                Fitur Akademik & Integrasi
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto">
                Eksplorasi modul canggih yang dirancang khusus untuk memenuhi standar digitalisasi pengelolaan sekolah abad ke-21.
            </p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($fiturAkademiks as $index => $f)
                @if($index === 0)
                    <!-- Large Card (2/3 width) -->
                    <div class="lg:col-span-2 bg-white rounded-premium border border-slate-100 shadow-sm p-8 flex flex-col justify-between hover:shadow-xl transition-all duration-300 group">
                        <div class="space-y-4 max-w-xl">
                            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-primary/5 text-primary text-xs font-bold">
                                <i class="fa-solid {{ $f->icon }}"></i> Module
                            </div>
                            <h3 class="text-xl font-bold text-secondary group-hover:text-primary transition-colors">{{ $f->title }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">{{ $f->description }}</p>
                        </div>
                        
                        <!-- Dynamic Feature Image / Representation -->
                        @if($f->image)
                            <div class="mt-8 rounded-xl overflow-hidden border border-slate-100 aspect-[2.4/1]">
                                <img src="{{ asset('storage/' . $f->image) }}" alt="{{ $f->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <!-- Default curve representation -->
                            <div class="mt-8 rounded-xl bg-slate-50 border border-slate-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/2 space-y-3">
                                    <div class="text-xs font-bold text-slate-400">Jadwal Kelas Hari Ini</div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center p-2 rounded bg-white shadow-sm border border-slate-100">
                                            <span class="text-xs font-bold text-secondary font-sans">Matematika Wajib</span>
                                            <span class="text-[10px] px-2 py-0.5 rounded bg-blue-100 text-primary font-bold">08:00</span>
                                        </div>
                                        <div class="flex justify-between items-center p-2 rounded bg-white shadow-sm border border-slate-100">
                                            <span class="text-xs font-bold text-secondary font-sans">Fisika Terapan</span>
                                            <span class="text-[10px] px-2 py-0.5 rounded bg-green-100 text-success font-bold">10:00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 h-28 relative flex items-end">
                                    <div class="absolute top-0 right-0 text-xs font-bold text-slate-400">Semester 2 (Sains)</div>
                                    <svg viewBox="0 0 200 100" class="w-full h-full text-primary">
                                        <path d="M 0,80 Q 50,20 100,50 T 200,10" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                        <circle cx="100" cy="50" r="5" fill="currentColor" />
                                        <circle cx="200" cy="10" r="5" fill="currentColor" />
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <!-- Small Card (1/3 width) -->
                    <div class="bg-white rounded-premium border border-slate-100 shadow-sm p-8 flex flex-col justify-between hover:shadow-xl transition-all duration-300 group">
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-primary/5 text-primary text-xs font-bold">
                                <i class="fa-solid {{ $f->icon }}"></i> Module
                            </div>
                            <h3 class="text-xl font-bold text-secondary group-hover:text-primary transition-colors">{{ $f->title }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">{{ $f->description }}</p>
                        </div>
                        
                        @if($f->image)
                            <div class="mt-8 rounded-xl overflow-hidden border border-slate-100 aspect-[1.5/1]">
                                <img src="{{ asset('storage/' . $f->image) }}" alt="{{ $f->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <!-- Default alert mock representation -->
                            <div class="mt-8 space-y-3">
                                <div class="p-3 rounded-premium bg-slate-50 border border-slate-100 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-accent"><i class="fa-solid fa-bell text-xs"></i></div>
                                    <div>
                                        <div class="text-xs font-bold text-secondary">Notifikasi Sistem</div>
                                        <div class="text-[10px] text-slate-400">Pembaruan Akademik</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach

            <!-- Static Payment Gateway Bento Box (as part of layout preservation) -->
            <div class="lg:col-span-2 bg-white rounded-premium border border-slate-100 shadow-sm p-8 flex flex-col justify-between hover:shadow-xl transition-all duration-300 group">
                <div class="space-y-4 max-w-xl">
                    <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-purple-100 text-purple-600 text-xs font-bold">
                        <i class="fa-solid fa-credit-card"></i> Midtrans Payment Gateway
                    </div>
                    <h3 class="text-xl font-bold text-secondary group-hover:text-primary transition-colors">Kemudahan Pembayaran SPP Online</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-sans">
                        Bayar uang sekolah, SPP bulanan, dan iuran kegiatan dengan praktis menggunakan Virtual Account, E-Wallet, atau Kartu Kredit berkat integrasi penuh gerbang pembayaran Midtrans.
                    </p>
                </div>
                <div class="mt-8 flex flex-wrap gap-4 items-center justify-center">
                    <span class="px-4 py-2 bg-slate-50 rounded-premium border border-slate-100 text-xs font-bold text-slate-600"><i class="fa-solid fa-building-columns mr-2 text-primary font-sans"></i> Virtual Account</span>
                    <span class="px-4 py-2 bg-slate-50 rounded-premium border border-slate-100 text-xs font-bold text-slate-600"><i class="fa-solid fa-wallet mr-2 text-success"></i> E-Wallet</span>
                    <span class="px-4 py-2 bg-slate-50 rounded-premium border border-slate-100 text-xs font-bold text-slate-600"><i class="fa-solid fa-credit-card mr-2 text-accent"></i> Kartu Kredit</span>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Academic Features End ***** -->

    <!-- ***** Latest News Start ***** -->
    <section id="news" class="bg-white py-24 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/20">
                        <span class="text-xs font-bold text-primary tracking-wide uppercase font-sans">Kabar & Update</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-secondary">
                        Berita Terkini & Informasi Sekolah
                    </h2>
                </div>
                <a href="#" class="inline-flex items-center text-sm font-bold text-primary hover:underline">Lihat Semua Artikel <i class="fa-solid fa-arrow-right ml-2"></i></a>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($news as $article)
                    <article class="bg-white rounded-premium border border-slate-100 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300">
                        <div class="aspect-[16/10] bg-slate-100 overflow-hidden relative">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <i class="fa-solid fa-images text-slate-300 text-[60px] absolute inset-0 flex items-center justify-center"></i>
                            @endif
                            <span class="absolute top-4 left-4 bg-secondary text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded">{{ $article->kategori }}</span>
                        </div>
                        <div class="p-6 space-y-3">
                            <span class="text-xs font-semibold text-slate-400"><i class="fa-solid fa-calendar-day mr-1"></i> {{ $article->tanggal ? $article->tanggal->format('d M Y') : '' }}</span>
                            <h3 class="text-lg font-bold text-secondary group-hover:text-primary transition-colors leading-snug">
                                <a href="#">{{ $article->title }}</a>
                            </h3>
                            <p class="text-sm text-slate-500 line-clamp-2">{!! strip_tags($article->content) !!}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ***** Latest News End ***** -->

    <!-- ***** Gallery Area Start ***** -->
    <section id="gallery" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center space-y-4 mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/20">
                <span class="text-xs font-bold text-primary tracking-wide uppercase">Dokumentasi</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-secondary">
                Galeri Aktivitas Sekolah
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galleries as $g)
                <div class="rounded-premium overflow-hidden aspect-[4/3] bg-slate-100 relative group border border-slate-200/50 shadow-sm">
                    <img src="{{ asset('storage/' . $g->image) }}" alt="{{ $g->caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <span class="text-xs font-bold text-white uppercase tracking-wide">{{ $g->caption }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- ***** Gallery Area End ***** -->

    <!-- ***** Testimonials Start ***** -->
    <section class="bg-slate-900 py-24 relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="glow-sphere absolute bottom-[-20%] left-[-20%] w-[500px] h-[500px] bg-primary/20 rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" x-data="{ activeSlide: 0, totalSlides: {{ $testimonials->count() }} }">
            <div class="text-center space-y-4 mb-16 font-sans">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/20 text-xs font-bold text-primary uppercase tracking-wide">Testimoni</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white font-sans">Apa Kata Mereka tentang SIAKAD?</h2>
            </div>

            @if($testimonials->count() > 0)
                <div class="relative max-w-4xl mx-auto min-h-[300px] flex items-center">
                    @foreach($testimonials as $index => $t)
                        <div x-show="activeSlide === {{ $index }}" x-transition.opacity.duration.500ms class="w-full text-center space-y-6">
                            <div class="text-yellow-400">
                                @for($i = 0; $i < $t->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                            <blockquote class="text-xl sm:text-2xl text-slate-300 leading-relaxed font-medium italic">
                                "{{ $t->isi }}"
                            </blockquote>
                            <div class="flex items-center justify-center gap-3">
                                @if($t->foto)
                                    <img src="{{ asset('storage/' . $t->foto) }}" alt="{{ $t->nama }}" class="w-10 h-10 rounded-full object-cover">
                                @endif
                                <div class="text-left">
                                    <div class="font-bold text-white text-base">{{ $t->nama }}</div>
                                    <div class="text-xs text-slate-400">{{ $t->role }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Dots Navigation -->
                <div class="flex justify-center gap-2.5 mt-10">
                    @foreach($testimonials as $index => $t)
                        <button @click="activeSlide = {{ $index }}" class="w-3 h-3 rounded-full transition-all" :class="activeSlide === {{ $index }} ? 'bg-primary scale-110' : 'bg-slate-700'"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- ***** Testimonials End ***** -->

    <!-- ***** FAQ Accordion Start ***** -->
    <section id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24" x-data="{ openFaq: null }">
        <div class="text-center space-y-4 mb-16">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 border border-primary/20 text-xs font-bold text-primary uppercase tracking-wide font-sans">FAQ</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-secondary">Pertanyaan yang Sering Diajukan</h2>
        </div>

        <div class="space-y-4">
            @foreach($faqs as $index => $faq)
                <div class="bg-white rounded-premium border border-slate-100 shadow-sm overflow-hidden">
                    <button @click="openFaq = (openFaq === {{ $index }} ? null : {{ $index }})" class="w-full px-6 py-5 text-left flex items-center justify-between font-bold text-secondary focus:outline-none">
                        <span>{{ $faq->question }}</span>
                        <i class="fa-solid transition-transform duration-300" :class="openFaq === {{ $index }} ? 'fa-minus text-primary' : 'fa-plus text-slate-400'"></i>
                    </button>
                    <div x-show="openFaq === {{ $index }}" x-collapse class="px-6 pb-5 text-sm text-slate-500 border-t border-slate-50 pt-3 leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- ***** FAQ Accordion End ***** -->

    <!-- ***** CTA Area Start ***** -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        @if($settings->cta_background)
            <div class="rounded-[24px] p-12 sm:p-16 text-center relative overflow-hidden shadow-xl" style="background-image: url('{{ asset('storage/' . $settings->cta_background) }}'); background-size: cover; background-position: center;">
        @else
            <div class="rounded-[24px] bg-gradient-to-tr from-primary via-slate-900 to-secondary p-12 sm:p-16 text-center relative overflow-hidden shadow-xl shadow-primary/10">
        @endif
            <!-- Abstract background shape overlay -->
            <div class="absolute -top-12 -left-12 w-48 h-48 rounded-full bg-blue-500/10 blur-xl"></div>
            <div class="absolute -bottom-12 -right-12 w-48 h-48 rounded-full bg-accent/10 blur-xl"></div>

            <div class="relative z-10 space-y-6 max-w-2xl mx-auto">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">{{ $settings->cta_heading ?? 'Siap Memulai Digitalisasi Pendidikan Sekarang?' }}</h2>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-sans">
                    {{ $settings->cta_description ?? 'Masuk ke dalam ekosistem sistem informasi akademik pintar. Mari tingkatkan kinerja administrasi sekolah Anda agar lebih produktif, transparan, dan terukur.' }}
                </p>
                <div class="flex flex-wrap justify-center gap-4 pt-4">
                    @if($settings->cta_button_text)
                        <button @click="portalModalOpen = true" class="px-8 py-3.5 rounded-premium bg-primary text-white font-bold hover:bg-blue-600 transition-all shadow-lg shadow-primary/20">
                            {{ $settings->cta_button_text }}
                        </button>
                    @endif
                    <a href="#school-profile" class="px-8 py-3.5 rounded-premium bg-transparent text-white font-bold border border-white/20 hover:bg-white/5 transition-all">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** CTA Area End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer class="bg-white border-t border-slate-100 py-12 text-slate-500 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col md:flex-row justify-between items-start gap-8">
                <!-- Info Column -->
                <div class="space-y-4 max-w-sm">
                    <div class="flex items-center gap-3">
                        @if($settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="h-8">
                        @else
                            <div class="w-8 h-8 rounded-premium bg-primary flex items-center justify-center text-white font-black text-lg">
                                {{ substr($settings->nama_sekolah ?? 'S', 0, 1) }}
                            </div>
                        @endif
                        <span class="text-base font-extrabold text-secondary">{{ $settings->nama_aplikasi ?? 'SIAKAD' }}</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        {{ $settings->alamat ?? 'Jl. Pendidikan Raya No. 45, Jakarta, Indonesia' }}
                    </p>
                    <div class="text-xs space-y-1 text-slate-400">
                        <div><i class="fa-solid fa-phone mr-2 text-primary"></i> {{ $settings->telepon }}</div>
                        <div><i class="fa-solid fa-envelope mr-2 text-primary"></i> {{ $settings->email }}</div>
                    </div>
                </div>

                <!-- Navigation/Portal Column -->
                <div class="space-y-3 text-left">
                    <h4 class="font-bold text-secondary text-xs uppercase tracking-wider">Sosial Media</h4>
                    <div class="flex gap-4 text-lg">
                        @if($settings->facebook) <a href="{{ $settings->facebook }}" target="_blank" class="text-slate-400 hover:text-primary"><i class="fa-brands fa-facebook"></i></a> @endif
                        @if($settings->instagram) <a href="{{ $settings->instagram }}" target="_blank" class="text-slate-400 hover:text-primary"><i class="fa-brands fa-instagram"></i></a> @endif
                        @if($settings->youtube) <a href="{{ $settings->youtube }}" target="_blank" class="text-slate-400 hover:text-primary"><i class="fa-brands fa-youtube"></i></a> @endif
                        @if($settings->tiktok) <a href="{{ $settings->tiktok }}" target="_blank" class="text-slate-400 hover:text-primary"><i class="fa-brands fa-tiktok"></i></a> @endif
                        @if($settings->whatsapp) <a href="{{ $settings->whatsapp }}" target="_blank" class="text-slate-400 hover:text-primary"><i class="fa-brands fa-whatsapp"></i></a> @endif
                    </div>
                </div>

                <!-- Links Column -->
                <div class="space-y-3">
                    <h4 class="font-bold text-secondary text-xs uppercase tracking-wider">Portal</h4>
                    <button @click="portalModalOpen = true" class="text-xs font-bold text-primary hover:underline">Masuk Portal Akademik</button>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-sans">
                <p>{{ $settings->copyright ?? '© 2026 SIAKAD.test. Seluruh hak cipta dilindungi undang-undang.' }}</p>
                <p>Dikembangkan dengan <i class="fa-solid fa-heart text-red-500"></i> untuk Pendidikan Indonesia</p>
            </div>
        </div>
    </footer>
    <!-- ***** Footer End ***** -->


    <!-- ============================================ -->
    <!--          PORTAL AKADEMIK MODAL (AlpineJS)    -->
    <!-- ============================================ -->
    <div x-show="portalModalOpen" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;"
         x-transition:opacity.duration.300ms>
         
        <!-- Backdrop overlay -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="portalModalOpen = false"></div>

        <!-- Modal Box -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="portalModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-lg bg-white rounded-[24px] shadow-2xl p-6 sm:p-8 border border-slate-100 z-10 space-y-6">
                 
                <!-- Close Button -->
                <button @click="portalModalOpen = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <!-- Header -->
                <div class="text-center space-y-2">
                    <h3 class="text-2xl font-black text-secondary tracking-tight">Portal Akademik</h3>
                    <p class="text-sm text-slate-500 font-sans">Silakan pilih jenis akun Anda untuk masuk</p>
                </div>

                <!-- Roles Grid / List -->
                <div class="space-y-4">
                    <!-- Siswa -->
                    <div class="p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <span class="text-3xl">👨‍🎓</span>
                            <div>
                                <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Siswa</h4>
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold font-sans mt-0.5">Lihat Nilai • Jadwal • Materi</p>
                            </div>
                        </div>
                        <a href="/siswa/login" class="px-4 py-2 bg-primary/10 text-primary text-xs font-bold rounded-premium hover:bg-primary hover:text-white transition-colors whitespace-nowrap">
                            Masuk
                        </a>
                    </div>

                    <!-- Guru -->
                    <div class="p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <span class="text-3xl">👨‍🏫</span>
                            <div>
                                <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Guru</h4>
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold font-sans mt-0.5">Kelola Nilai • Materi • Absensi</p>
                            </div>
                        </div>
                        <a href="/guru/login" class="px-4 py-2 bg-primary/10 text-primary text-xs font-bold rounded-premium hover:bg-primary hover:text-white transition-colors whitespace-nowrap">
                            Masuk
                        </a>
                    </div>

                    <!-- Orang Tua -->
                    <div class="p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <span class="text-3xl">👨‍👩‍👦</span>
                            <div>
                                <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Orang Tua</h4>
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold font-sans mt-0.5">Pantau Anak • Pembayaran • Nilai</p>
                            </div>
                        </div>
                        <a href="/orangtua/login" class="px-4 py-2 bg-primary/10 text-primary text-xs font-bold rounded-premium hover:bg-primary hover:text-white transition-colors whitespace-nowrap">
                            Masuk
                        </a>
                    </div>

                    <!-- Administrator -->
                    <div class="p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <span class="text-3xl">🛠️</span>
                            <div>
                                <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Administrator</h4>
                                <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold font-sans mt-0.5">Kelola Sistem • Master Data • Pengaturan</p>
                            </div>
                        </div>
                        <a href="/admin/login" class="px-4 py-2 bg-primary/10 text-primary text-xs font-bold rounded-premium hover:bg-primary hover:text-white transition-colors whitespace-nowrap">
                            Masuk
                        </a>
                    </div>
                </div>

                <!-- Footer Text in Modal -->
                <div class="text-center text-xs text-slate-400 pt-2 border-t border-slate-50">
                    Belum memiliki akun? <a href="#" class="text-primary font-bold hover:underline">Ajukan Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
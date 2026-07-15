@props([
    'actions' => [],
    'breadcrumbs' => [],
    'heading',
    'subheading' => null,
])

@php
    $isGuruPanel = false;
    try {
        $isGuruPanel = filament()->getCurrentPanel() && filament()->getCurrentPanel()->getId() === 'guru';
    } catch (\Throwable $e) {}
@endphp

@if ($isGuruPanel)
    <!-- Premium Hero Page Header for Guru Panel -->
    <header {{ $attributes->class(['fi-header flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between py-6 mb-4']) }}>
        <div class="space-y-3">
            @if ($breadcrumbs)
                <x-filament-panels::breadcrumbs :breadcrumbs="$breadcrumbs" class="text-xs text-slate-400 dark:text-slate-500 font-medium" />
            @endif

            <div class="flex items-center gap-3">
                @php
                    // Dynamic Emojis based on the Heading
                    $icon = '🎓';
                    $headingLower = strtolower($heading);
                    if (str_contains($headingLower, 'nilai')) {
                        $icon = '👨‍🏫';
                    } elseif (str_contains($headingLower, 'materi')) {
                        $icon = '📚';
                    } elseif (str_contains($headingLower, 'tugas') || str_contains($headingLower, 'pengumpulan')) {
                        $icon = '📝';
                    } elseif (str_contains($headingLower, 'absen') || str_contains($headingLower, 'presensi')) {
                        $icon = '📋';
                    } elseif (str_contains($headingLower, 'jadwal')) {
                        $icon = '📅';
                    } elseif (str_contains($headingLower, 'profil') || str_contains($headingLower, 'akun')) {
                        $icon = '👤';
                    }
                @endphp
                <span class="text-3xl sm:text-4xl">{{ $icon }}</span>
                <div>
                    <h1 class="fi-header-heading text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white leading-none">
                        {{ $heading }}
                    </h1>
                    
                    @php
                        // Dynamic fallback subheadings for professional premium feel
                        $displaySubheading = $subheading;
                        if (!$displaySubheading) {
                            if (str_contains($headingLower, 'nilai')) {
                                $displaySubheading = 'Kelola nilai akademik siswa secara cepat, mudah, dan transparan.';
                            } elseif (str_contains($headingLower, 'materi')) {
                                $displaySubheading = 'Bagikan bahan ajar, modul, dan dokumen pendukung materi pembelajaran.';
                            } elseif (str_contains($headingLower, 'tugas') && !str_contains($headingLower, 'pengumpulan')) {
                                $displaySubheading = 'Buat, kelola, dan pantau tugas kelas terstruktur siswa.';
                            } elseif (str_contains($headingLower, 'pengumpulan')) {
                                $displaySubheading = 'Periksa dan berikan penilaian pada hasil pengumpulan tugas siswa.';
                            } elseif (str_contains($headingLower, 'absen') || str_contains($headingLower, 'presensi')) {
                                $displaySubheading = 'Rekapitulasi kehadiran harian siswa secara real-time.';
                            } elseif (str_contains($headingLower, 'jadwal')) {
                                $displaySubheading = 'Lihat seluruh jadwal pelajaran dan jam mengajar Anda.';
                            } elseif (str_contains($headingLower, 'profil')) {
                                $displaySubheading = 'Kelola informasi profil pribadi dan pengaturan akun Anda.';
                            } else {
                                $displaySubheading = 'Kelola aktivitas akademik sekolah Anda.';
                            }
                        }
                    @endphp
                    <p class="fi-header-subheading mt-2 text-xs sm:text-sm font-medium text-slate-400 dark:text-slate-500">
                        {{ $displaySubheading }}
                    </p>
                </div>
            </div>
        </div>

        @if ($actions)
            <x-filament-panels::actions :actions="$actions" class="shrink-0" />
        @endif
    </header>
@else
    <!-- Default Filament Layout wrapper for other panels (Admin, etc) -->
    <header {{ $attributes->class(['fi-header flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between']) }}>
        <div>
            @if ($breadcrumbs)
                <x-filament-panels::breadcrumbs :breadcrumbs="$breadcrumbs" class="mb-2" />
            @endif

            <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                {{ $heading }}
            </h1>

            @if ($subheading)
                <p class="fi-header-subheading mt-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ $subheading }}
                </p>
            @endif
        </div>

        @if ($actions)
            <x-filament-panels::actions :actions="$actions" class="shrink-0" />
        @endif
    </header>
@endif

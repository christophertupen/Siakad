<div>

<form action="{{ route('filament.akademik.auth.logout') }}" method="POST" id="logout-form" class="hidden">
    @csrf
</form>

<!-- Sidebar Shell -->
<aside class="fixed left-0 top-0 h-full z-40 hidden md:flex flex-col bg-glass-fill dark:bg-inverse-surface/80 rounded-xl m-4 h-[calc(100vh-32px)] w-72 backdrop-blur-xl border border-glass-stroke shadow-xl">
<div class="p-8">
<h1 class="font-headline-lg text-headline-lg text-primary dark:text-primary-fixed-dim font-black">SIAKAD Staff</h1>
<p class="font-label-md text-label-md text-on-surface-variant opacity-70">Academic Portal</p>
</div>
<nav class="flex-1 px-4 space-y-2 overflow-y-auto custom-scrollbar">
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 transition-all duration-200 flex items-center gap-3 px-4 py-3 group" href="/akademik">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 transition-all duration-200 flex items-center gap-3 px-4 py-3 group" href="/akademik/kelas">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">school</span>
<span class="font-label-md text-label-md">Akademik</span>
</a>
<!-- Active Navigation -->
<a class="bg-primary text-on-primary rounded-xl flex items-center gap-3 px-4 py-3 scale-95 active:scale-90 transition-transform shadow-lg shadow-primary/20" href="/akademik/monitoring">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">monitoring</span>
<span class="font-label-md text-label-md">Monitoring</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 transition-all duration-200 flex items-center gap-3 px-4 py-3 group" href="/akademik/pengumuman">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">campaign</span>
<span class="font-label-md text-label-md">Informasi</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 transition-all duration-200 flex items-center gap-3 px-4 py-3 group" href="/akademik/profil">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">person</span>
<span class="font-label-md text-label-md">Akun</span>
</a>
</nav>
<div class="p-4 border-t border-outline-variant/20">
<div class="flex items-center gap-3 p-2 bg-surface-container-low rounded-lg">
<img class="w-10 h-10 rounded-full object-cover border-2 border-primary/20" src="https://lh3.googleusercontent.com/aida-public/AB6AXuADbdKGkLy4mLBlDMsw9aX-F14z-MgGzYZTXJ8isR-ip7p-gxHPhz9gGmpR5ySYs6jHlu3_aeGvi8YPaq0jBQlZZRRvpVGGZEOklmqt7PmzWJiKhJmbejWnwOI_bDluiT8uingzlE6MBGFQ8d8LcBrNwZO5oRukLCDmlyifnXkfD70VTgfb6EylEhx0nXd70JxLJhQXI576sd6Xu27yLAPjVWYRnr_IJs2bX909yE46Xm5vu0RY0Sqv"/>
<div>
<p class="font-label-md text-label-md font-bold">{{ auth()->user()->name }}</p>
<p class="text-[10px] uppercase tracking-wider text-primary font-bold">Senior Administrator</p>
</div>
</div>
<button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-4 w-full flex items-center gap-2 px-4 py-2 text-error font-label-md hover:bg-error/5 rounded-lg transition-colors">
<span class="material-symbols-outlined">logout</span>
<span>Logout</span>
</button>
</div>
</aside>

<!-- Top Navigation -->
<header class="fixed top-0 right-0 left-0 md:left-80 z-30 flex justify-between items-center px-6 md:px-margin-desktop h-20 bg-glass-fill/70 dark:bg-surface/70 backdrop-blur-md border-b border-outline-variant/20">
<div class="flex items-center gap-6 flex-1">
<div class="relative max-w-md w-full focus-within:ring-2 focus-within:ring-primary rounded-xl transition-all">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container rounded-xl border-none text-body-md focus:ring-0" placeholder="Search monitoring data..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<div class="hidden md:flex items-center gap-2 bg-primary/10 px-4 py-1.5 rounded-full border border-primary/20">
<span class="font-label-md text-label-md text-primary">Academic Year 2024/2025</span>
</div>
</div>
</header>

<!-- Main Content Canvas -->
<main class="pt-24 pb-8 px-6 md:ml-80 md:px-margin-desktop min-h-screen">

<!-- Custom Tab Switcher -->
<div class="flex p-1 bg-surface-container rounded-2xl mb-8 max-w-md border border-outline-variant/10">
    <button wire:click="setTab('materi_tugas')" class="flex-1 px-6 py-2.5 rounded-xl font-label-md text-label-md {{ $activeTab === 'materi_tugas' ? 'bg-primary text-white shadow-md' : 'text-on-surface-variant hover:bg-white/50' }}">Materi & Tugas</button>
    <button wire:click="setTab('rapor_nilai')" class="flex-1 px-6 py-2.5 rounded-xl font-label-md text-label-md {{ $activeTab === 'rapor_nilai' ? 'bg-primary text-white shadow-md' : 'text-on-surface-variant hover:bg-white/50' }}">Rapor & Nilai</button>
</div>

@if($activeTab === 'materi_tugas')
    <!-- ================= TAB 1: MATERI & TUGAS ================= -->
    <!-- Header Section -->
    <section class="relative mb-8 p-8 rounded-[24px] bg-gradient-to-br from-primary to-[#003ea8] text-on-primary overflow-hidden shadow-2xl">
    <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center">
    <div>
    <h2 class="font-headline-lg text-headline-lg mb-2">Monitoring Materi &amp; Tugas</h2>
    <p class="font-body-lg text-body-lg text-on-primary/80 max-w-lg">Track academic delivery and student engagement across all active courses and departments.</p>
    </div>
    <div class="hidden lg:block float-decoration absolute right-12 -top-12">
    <img class="w-56 h-auto drop-shadow-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJj-SAPmWIUrm9VujO2yqUavrASi8-EVrRzHsZeCK8zM1X5SiWGMJs4dsyb2bUvj8fC7ZFYYpNIx7_l0TkReuMY4rBmMxi12XUHK-4dhd1wGY-rnTQ8Tcdmk4qG1Of8dR1d8xN6AMastfJ4JBlx8VXPErk-pkbNBLaohTjXIbvYeTUsBI-DuMLERHge-QboBbBy4j2cvGE4KKAc4_n72BpLiVxLNquLftmShaS0Vmw0rnIbBf3vTcU"/>
    </div>
    </div>
    <!-- Global Stats Overlay -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 relative z-10">
    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
    <p class="text-xs uppercase font-bold tracking-widest text-white/60 mb-1">Total Materials</p>
    <p class="text-2xl font-black">{{ $totalMaterials }}</p>
    </div>
    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
    <p class="text-xs uppercase font-bold tracking-widest text-white/60 mb-1">Total Assignments</p>
    <p class="text-2xl font-black">{{ $totalAssignments }}</p>
    </div>
    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
    <p class="text-xs uppercase font-bold tracking-widest text-white/60 mb-1">Avg. Submission</p>
    <p class="text-2xl font-black">{{ $avgSubmissionRate }}%</p>
    </div>
    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
    <p class="text-xs uppercase font-bold tracking-widest text-white/60 mb-1">Review Pending</p>
    <p class="text-2xl font-black text-[#FFD700]">{{ $pendingReview }} Items</p>
    </div>
    </div>
    </section>

    <!-- Analytics Bento Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter mb-8">
    <!-- Materials Completion Card -->
    <div class="lg:col-span-2 glass-card p-stack-md rounded-[24px] p-6">
    <div class="flex justify-between items-center mb-6">
    <div>
    <h3 class="font-headline-md text-headline-md">Penyelesaian Materi per Kelas</h3>
    <p class="text-on-surface-variant font-body-md">Distribution of learning content across academic years</p>
    </div>
    </div>
    <div class="h-64 flex items-end gap-4 px-2 pt-8">
    @foreach($classMateriStats as $cms)
    <div class="flex-1 flex flex-col items-center gap-2 group cursor-pointer h-full justify-end">
    <div class="w-full bg-primary/20 rounded-t-lg relative transition-all duration-300 group-hover:bg-primary" style="height: {{ $cms['percentage'] }}%;">
    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">{{ $cms['percentage'] }}%</div>
    </div>
    <span class="text-xs font-bold text-on-surface-variant whitespace-nowrap">{{ $cms['name'] }}</span>
    </div>
    @endforeach
    </div>
    </div>
    <!-- Assignment Submission Rate -->
    <div class="glass-card p-stack-md rounded-[24px] p-6 flex flex-col justify-between">
    <div>
    <h3 class="font-headline-md text-headline-md mb-2">Tingkat Pengumpulan</h3>
    <p class="text-on-surface-variant font-body-md mb-6">Real-time assignment submission health.</p>
    </div>
    <div class="relative flex items-center justify-center py-6">
    <svg class="w-40 h-40 transform -rotate-90">
    <circle class="text-surface-container-high" cx="80" cy="80" fill="transparent" r="70" stroke="currentColor" stroke-width="12"></circle>
    <circle class="text-success transition-all duration-1000 ease-out" cx="80" cy="80" fill="transparent" r="70" stroke="currentColor" stroke-dasharray="440" stroke-dashoffset="{{ 440 - (440 * $avgSubmissionRate / 100) }}" stroke-width="12"></circle>
    </svg>
    <div class="absolute flex flex-col items-center">
    <span class="text-3xl font-black text-on-surface">{{ $avgSubmissionRate }}%</span>
    <span class="text-[10px] font-bold uppercase text-on-surface-variant tracking-wider">Submitted</span>
    </div>
    </div>
    <div class="space-y-3">
    <div class="flex items-center justify-between p-2 rounded-lg bg-success/5 border border-success/10">
    <div class="flex items-center gap-2">
    <span class="w-3 h-3 rounded-full bg-success"></span>
    <span class="text-label-md">Submitted</span>
    </div>
    <span class="font-bold">{{ $actualSubmissions }}</span>
    </div>
    </div>
    </div>
    </div>

    <!-- Latest Feed Section -->
    <div class="glass-card rounded-[24px] overflow-hidden">
    <div class="p-6 border-b border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-4">
    <h3 class="font-headline-md text-headline-md">Recent Feed</h3>
    </div>
    <div class="overflow-x-auto">
    <table class="w-full text-left">
    <thead>
    <tr class="bg-surface-container-low text-on-surface-variant text-[11px] uppercase tracking-widest font-bold">
    <th class="px-8 py-4">Sender &amp; Content</th>
    <th class="px-6 py-4">Type</th>
    <th class="px-6 py-4">Department</th>
    <th class="px-6 py-4">Timestamp</th>
    <th class="px-6 py-4">Status</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-outline-variant/10">
    @forelse($feeds as $fd)
    <tr class="hover:bg-surface-container-lowest transition-colors">
    <td class="px-8 py-4">
    <div class="flex items-center gap-4">
    <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center font-bold text-primary">
    {{ substr($fd['sender'], 0, 2) }}
    </div>
    <div>
    <p class="font-bold text-body-md">{{ $fd['sender'] }}</p>
    <p class="text-label-sm text-on-surface-variant">{{ $fd['title'] }}</p>
    </div>
    </div>
    </td>
    <td class="px-6 py-4">
    <span class="px-3 py-1 text-[10px] font-black rounded-full uppercase {{ $fd['type'] === 'Materi' ? 'bg-primary/10 text-primary' : 'bg-tertiary/10 text-tertiary' }}">
        {{ $fd['type'] }}
    </span>
    </td>
    <td class="px-6 py-4 text-on-surface-variant font-label-md">{{ $fd['dept'] }}</td>
    <td class="px-6 py-4 text-label-sm">{{ $fd['time'] }}</td>
    <td class="px-6 py-4">
    <span class="flex items-center gap-1 font-bold text-[12px] {{ $fd['status'] === 'Approved' ? 'text-success' : 'text-tertiary' }}">
    <span class="material-symbols-outlined text-[14px]">{{ $fd['status'] === 'Approved' ? 'check_circle' : 'pending_actions' }}</span>
        {{ $fd['status'] }}
    </span>
    </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="p-8 text-center text-outline">Tidak ada feed baru.</td>
    </tr>
    @endforelse
    </tbody>
    </table>
    </div>
    </div>
@else
    <!-- ================= TAB 2: RAPOR & NILAI ================= -->
    <!-- Hero Header -->
    <div class="relative mb-stack-lg p-10 overflow-hidden rounded-[32px] bg-gradient-to-br from-primary-container via-primary-container/80 to-surface-bright border border-glass-stroke shadow-xl text-on-primary">
    <div class="relative z-10 max-w-2xl text-on-primary-container">
    <h2 class="font-headline-lg text-headline-lg text-on-primary-container mb-4">Penerbitan Rapor & Nilai</h2>
    <p class="text-on-primary-container/80 font-body-lg text-body-lg mb-8">Kelola dan verifikasi hasil belajar siswa untuk Semester Ganjil 2024/2025 dengan sistem automasi validasi wali kelas.</p>
    <div class="flex flex-wrap gap-4">
    <button onclick="alert('Melakukan automasi Rapor massal...')" class="bg-primary text-on-primary px-8 py-3 rounded-xl font-label-md text-label-md flex items-center gap-2 shadow-lg shadow-primary/30 hover:scale-105 active:scale-95 transition-all">
    <span class="material-symbols-outlined">auto_awesome</span>
                                Generate Massal
                            </button>
    </div>
    </div>
    <div class="absolute right-[-20px] top-1/2 -translate-y-1/2 hidden lg:block float-decoration">
    <div class="w-72 h-72 relative">
    <img class="w-full h-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7SaILBqP7JEKsJouR1mk5GiDQ0VVvEhq2--oNeVtORIeZ21skouYxHlft3EKuQ5PBeLNoZwQPSNq6UlWAsYY6FFRY2GXKcRPuIhh7GG1IINOWugzAi1SOPL-K8WhZ-SD9I9HbZUHkTD8fhKnpRm2ulKconMywmjcaZG1PnmQFyWQXN3XodhkZAGYrGQPPvh5ktq0lI5PSi9mFEctVmq13cBURsFGEUN0AyOtEtbp0E-3XQexGSFTD"/>
    </div>
    </div>
    </div>

    <!-- Dashboard Stats Bento -->
    <div class="grid grid-cols-12 gap-6 mb-stack-md">
    <div class="col-span-12 md:col-span-4 glass-card p-8 rounded-3xl border-l-4 border-l-primary">
    <p class="text-on-surface-variant font-label-md text-label-md mb-2">Input Nilai Selesai</p>
    <div class="flex items-baseline gap-2">
    <span class="font-headline-lg text-headline-lg text-on-surface">{{ $inputNilaiPercent }}%</span>
    </div>
    <p class="text-outline font-label-sm text-label-sm mt-4">Kalkulasi kelas yang sudah input nilai</p>
    </div>
    <div class="col-span-12 md:col-span-4 glass-card p-8 rounded-3xl border-l-4 border-l-tertiary">
    <p class="text-on-surface-variant font-label-md text-label-md mb-2">Menunggu Verifikasi</p>
    <div class="flex items-baseline gap-2">
    <span class="font-headline-lg text-headline-lg text-on-surface">{{ $pendingVerificationCount }}</span>
    <span class="text-outline font-label-sm text-label-sm">Siswa</span>
    </div>
    <p class="text-outline font-label-sm text-label-sm mt-4">Verifikasi Manual Wali Kelas</p>
    </div>
    <div class="col-span-12 md:col-span-4 glass-card p-8 rounded-3xl border-l-4 border-l-success">
    <p class="text-on-surface-variant font-label-md text-label-md mb-2">Siap Cetak / Kirim</p>
    <div class="flex items-baseline gap-2">
    <span class="font-headline-lg text-headline-lg text-on-surface">{{ $verifiedCount }}</span>
    <span class="text-success font-label-sm text-label-sm flex items-center gap-1">
    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                Verified
                            </span>
    </div>
    <p class="text-outline font-label-sm text-label-sm mt-4">Sudah terverifikasi oleh Kepsek</p>
    </div>
    </div>

    <!-- Workflow Section -->
    <div class="grid grid-cols-12 gap-6">
    <!-- Main Status Table -->
    <div class="col-span-12 lg:col-span-8 glass-card rounded-3xl overflow-hidden">
    <div class="p-8 border-b border-outline-variant/20 flex justify-between items-center">
    <div>
    <h3 class="font-headline-md text-headline-md text-on-surface">Daftar Status Per Kelas</h3>
    <p class="text-outline font-label-md text-label-md">Tracking progres pengisian nilai guru mata pelajaran</p>
    </div>
    </div>
    <div class="overflow-x-auto">
    <table class="w-full text-left">
    <thead class="bg-surface-container-low">
    <tr>
    <th class="px-8 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Kelas</th>
    <th class="px-8 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Wali Kelas</th>
    <th class="px-8 py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Status Input</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-outline-variant/10">
    @forelse($classRaporStatus as $crs)
    <tr class="hover:bg-surface-container-lowest transition-all">
    <td class="px-8 py-5">
    <div class="font-label-md text-label-md text-on-surface">{{ $crs['nama_kelas'] }}</div>
    <div class="text-[12px] text-outline">{{ $crs['siswa_count'] }} Siswa</div>
    </td>
    <td class="px-8 py-5">
    <div class="flex items-center gap-3">
    <div class="w-8 h-8 rounded-full bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center font-bold text-[10px]">W</div>
    <span class="text-on-surface font-medium">{{ $crs['wali_kelas'] }}</span>
    </div>
    </td>
    <td class="px-8 py-5">
    @if($crs['status'] === 'Selesai')
    <span class="px-3 py-1 rounded-full bg-success/10 text-success text-[12px] font-bold inline-flex items-center gap-1">
    <span class="material-symbols-outlined text-[14px]">check</span> Selesai
    </span>
    @elseif($crs['status'] === 'Verifikasi')
    <span class="px-3 py-1 rounded-full bg-tertiary/10 text-tertiary text-[12px] font-bold inline-flex items-center gap-1">
    <span class="material-symbols-outlined text-[14px]">pending</span> Verifikasi
    </span>
    @else
    <span class="px-3 py-1 rounded-full bg-error/10 text-error text-[12px] font-bold inline-flex items-center gap-1">
    <span class="material-symbols-outlined text-[14px]">error</span> Input Nilai
    </span>
    @endif
    </td>
    </tr>
    @empty
    <tr>
        <td colspan="3" class="p-8 text-center text-outline">Tidak ada kelas terdaftar.</td>
    </tr>
    @endforelse
    </tbody>
    </table>
    </div>
    </div>
    <!-- Right Action Sidebar -->
    <div class="col-span-12 lg:col-span-4 space-y-6">
    <div class="glass-card p-8 rounded-3xl bg-gradient-to-br from-tertiary/10 to-transparent">
    <div class="flex items-start gap-4 mb-4">
    <span class="material-symbols-outlined text-tertiary">info</span>
    <h4 class="font-label-md text-label-md text-tertiary uppercase tracking-wider">Penting</h4>
    </div>
    <p class="text-on-surface-variant text-body-md font-body-md">
                                Pastikan seluruh nilai mata pelajaran sudah divalidasi sebelum melakukan <strong>Generate Massal</strong>. Kesalahan data setelah generate memerlukan reset serial number rapor.
                            </p>
    </div>
    </div>
    </div>
@endif

</main>

</div>

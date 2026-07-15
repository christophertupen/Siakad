<div>

<form action="{{ route('filament.akademik.auth.logout') }}" method="POST" id="logout-form" class="hidden">
    @csrf
</form>

<!-- Sidebar Navigation -->
<aside class="fixed left-0 top-0 h-full z-40 hidden md:flex flex-col bg-glass-fill dark:bg-inverse-surface/80 rounded-xl m-4 h-[calc(100vh-32px)] w-72 backdrop-blur-xl border border-glass-stroke shadow-xl">
<div class="p-6 flex items-center gap-4">
<div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
</div>
<div>
<h1 class="font-headline-md text-headline-md text-primary dark:text-primary-fixed-dim font-black leading-tight">SIAKAD Staff</h1>
<p class="text-xs text-on-surface-variant font-medium opacity-70">Academic Portal</p>
</div>
</div>
<nav class="flex-1 px-4 space-y-2 mt-4">
<!-- Dashboard -->
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 cubic-transition scale-95 active:scale-90" href="/akademik">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<!-- Akademik (ACTIVE: Kelas context) -->
<a class="bg-primary text-on-primary rounded-xl flex items-center gap-3 px-4 py-3 cubic-transition shadow-lg shadow-primary/20" href="/akademik/kelas">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
<span class="font-label-md text-label-md">Akademik</span>
</a>
<!-- Monitoring -->
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 cubic-transition scale-95 active:scale-90" href="/akademik/monitoring">
<span class="material-symbols-outlined">monitoring</span>
<span class="font-label-md text-label-md">Monitoring</span>
</a>
<!-- Informasi -->
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 cubic-transition scale-95 active:scale-90" href="/akademik/pengumuman">
<span class="material-symbols-outlined">campaign</span>
<span class="font-label-md text-label-md">Informasi</span>
</a>
<!-- Akun -->
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary hover:bg-primary/10 flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200 cubic-transition scale-95 active:scale-90" href="/akademik/profil">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">Akun</span>
</a>
</nav>
<div class="p-6 border-t border-outline-variant/10">
<div class="flex items-center gap-3 p-3 bg-surface-container-low rounded-2xl">
<img class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxesiXgBvLO6HircIY-aJoJvVbZ6GJwbtba6tiXYA6vA3n5UXqSdYdtC6P3gtYmH67pJKxC7KeTb6MwMGWttHgv4sla4ZJf7pdhUvybcOTthxpzH5PPglQjsPjC4ATQa7Gt6WKsNn940zdUXuz9-_q2l5RQM7CxC9ikAqLU3mBTQimr3AIosMlEnJuDP9-_rXf5NHDuvxZ-H8ytSwyvw8n1BLycXnI-KKj4V0g_G29eq9bZBmupgKE"/>
<div class="overflow-hidden">
<p class="font-label-md text-label-md truncate">{{ auth()->user()->name }}</p>
<p class="text-[10px] text-on-surface-variant opacity-60">Senior Administrator</p>
</div>
</div>
<button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-4 w-full flex items-center gap-2 px-4 py-2 text-error font-label-md hover:bg-error/5 rounded-lg transition-colors">
<span class="material-symbols-outlined">logout</span>
<span>Logout</span>
</button>
</div>
</aside>
<!-- Top Navigation Bar -->
<header class="fixed top-0 right-0 left-0 md:left-80 z-30 flex justify-between items-center px-6 md:px-margin-desktop h-20 bg-glass-fill/70 backdrop-blur-md border-b border-outline-variant/20">
<div class="flex items-center gap-4 flex-1">
<div class="relative w-full max-w-md group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant">search</span>
<input wire:model.live.debounce.300ms="search" class="w-full h-11 pl-10 pr-4 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 cubic-transition font-body-md text-body-md" placeholder="Cari data kelas..." type="text"/>
</div>
</div>
<div class="flex items-center gap-6">
<div class="hidden lg:flex items-center gap-2 bg-secondary-container px-4 py-1.5 rounded-full">
<span class="material-symbols-outlined text-primary text-sm">calendar_today</span>
<span class="text-primary font-label-md text-label-md">T.A 2024/2025</span>
</div>
</div>
</header>
<!-- Main Content Area -->
<main class="md:ml-80 mt-20 p-6 md:p-margin-desktop min-h-screen relative overflow-hidden">
<!-- Decorative 3D Elements (Floating) -->
<div class="absolute top-20 right-20 w-48 h-48 opacity-20 floating-object pointer-events-none">
<img class="w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAknzvkwlxZQShCyy4eJfA4oNiFCKHD1PjrXZDCcqzBb1eSm1DFtQHO1iJ61JXPdhUHo80wYbsMXNp5K3LLTUWpIxCjNE3u3UHj29SDuGseb-7sZKpsK5TTX8VBJ60U6abIl7IQhtLNIPzbyBlJjTNBY5SNKqDi3GkonPiG7zhpL4gkOgGmNRHN2BVgSxVK5LebxyfGjvh8BgUvGdHH4-46_ulEW6kbDohakDoAhopulhCMexIYVKYK"/>
</div>
<div class="absolute bottom-20 left-10 w-32 h-32 opacity-10 floating-object pointer-events-none" style="animation-delay: 2s;">
<img class="w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnmq0Ekc4YgfghEO5X4ZpLozq_mBijg9k4RDm7ChBkrr-hdqm-Np-7KVTExNeOCi7h75PRvCgl4TcsP5HmbdOFMncfH004ZA13nFds_-ocaaDYOg5NS6HCI9wOtoYLN-K1Sw14bgAL75_1c4v8RfEh5H3ic-fLgPS0ev184VrNuwkSZ_gIWXjMQvAZ1NsdbofqOFD8K21YRAdhHX3d1nhD8UCONp60TFcffGBzrzAF_p3KalTanm4G"/>
</div>
<!-- Page Header -->
<section class="mb-stack-md flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<nav class="flex items-center gap-2 text-on-surface-variant/60 font-label-sm text-label-sm mb-2">
<span>Akademik</span>
<span class="material-symbols-outlined text-sm">chevron_right</span>
<span class="text-primary font-semibold">Manajemen Kelas</span>
</nav>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Manajemen Kelas</h2>
<p class="text-on-surface-variant font-body-md text-body-md mt-1 font-semibold">Kelola data ruang kelas, wali kelas, dan kapasitas siswa.</p>
</div>
<div class="flex items-center gap-3">
<a href="/akademik/mata-pelajaran" class="px-6 py-3.5 bg-white border border-outline-variant text-on-surface rounded-2xl font-label-md text-label-md hover:bg-surface-container-low cubic-transition">
    Mata Pelajaran
</a>
<a href="/akademik/jadwal" class="px-6 py-3.5 bg-white border border-outline-variant text-on-surface rounded-2xl font-label-md text-label-md hover:bg-surface-container-low cubic-transition">
    Jadwal Pelajaran
</a>
<button wire:click="openCreateModal" class="flex items-center gap-2 bg-primary text-on-primary px-6 py-3.5 rounded-2xl font-label-md text-label-md shadow-lg shadow-primary/25 hover:scale-105 active:scale-95 cubic-transition">
<span class="material-symbols-outlined">add</span>
                Tambah Kelas
</button>
</div>
</section>

<!-- Session Messages -->
@if (session()->has('message'))
    <div class="mb-6 p-4 bg-success/10 border border-success/20 text-success rounded-xl font-semibold">
        {{ session('message') }}
    </div>
@endif

<!-- Filters & Tabs -->
<section class="mb-stack-md flex flex-wrap items-center gap-4">
<div class="flex p-1 bg-surface-container-low rounded-2xl">
<button wire:click="setFilter('all')" class="px-6 py-2 rounded-xl font-label-md text-label-md {{ $tingkatFilter === 'all' ? 'bg-white shadow-sm text-primary' : 'hover:bg-white/50 text-on-surface-variant' }}">Semua</button>
<button wire:click="setFilter('X')" class="px-6 py-2 rounded-xl font-label-md text-label-md {{ $tingkatFilter === 'X' ? 'bg-white shadow-sm text-primary' : 'hover:bg-white/50 text-on-surface-variant' }}">Kelas X</button>
<button wire:click="setFilter('XI')" class="px-6 py-2 rounded-xl font-label-md text-label-md {{ $tingkatFilter === 'XI' ? 'bg-white shadow-sm text-primary' : 'hover:bg-white/50 text-on-surface-variant' }}">Kelas XI</button>
<button wire:click="setFilter('XII')" class="px-6 py-2 rounded-xl font-label-md text-label-md {{ $tingkatFilter === 'XII' ? 'bg-white shadow-sm text-primary' : 'hover:bg-white/50 text-on-surface-variant' }}">Kelas XII</button>
</div>
</section>

<!-- Classes Bento Grid -->
<section class="bento-grid">
<!-- Class Card Loop -->
@forelse($classes as $item)
@php
    $borderClass = match($item->tingkat) {
        'X' => 'border-primary',
        'XI' => 'border-tertiary-container',
        'XII' => 'border-secondary',
        default => 'border-primary'
    };
@endphp
<div class="glass-card p-6 rounded-[24px] border-t-4 {{ $borderClass }} group hover:-translate-y-2 cubic-transition flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-6">
<div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white cubic-transition">
<span class="material-symbols-outlined text-3xl">meeting_room</span>
</div>
@if($item->status)
<span class="px-3 py-1 bg-success/10 text-success rounded-full font-label-sm text-label-sm">Aktif</span>
@else
<span class="px-3 py-1 bg-error/10 text-error rounded-full font-label-sm text-label-sm">Penuh</span>
@endif
</div>
<h3 class="font-headline-md text-headline-md mb-2">{{ $item->nama_kelas }}</h3>
<div class="space-y-3">
<div class="flex items-center gap-3 text-on-surface-variant">
<span class="material-symbols-outlined text-lg">account_circle</span>
<span class="font-body-md text-body-md">{{ $item->waliKelas?->nama ?? 'Belum ada Wali Kelas' }}</span>
</div>
<div class="flex items-center gap-3 text-on-surface-variant">
<span class="material-symbols-outlined text-lg">groups</span>
<span class="font-body-md text-body-md">{{ $item->kelasSiswas->count() }} Siswa Terdaftar</span>
</div>
<div class="flex items-center gap-3 text-on-surface-variant">
<span class="material-symbols-outlined text-lg">location_on</span>
<span class="font-body-md text-body-md">Gedung A, Ruang {{ 100 + $item->id }}</span>
</div>
</div>
</div>
<div class="mt-8 flex gap-2">
<button onclick="alert('Jumlah Siswa Terdaftar: {{ $item->kelasSiswas->count() }}')" class="flex-1 py-2.5 bg-surface-container-high rounded-xl font-label-md text-label-md hover:bg-surface-variant cubic-transition">Detail</button>
<button wire:click="openEditModal({{ $item->id }})" class="w-11 h-11 flex items-center justify-center bg-surface-container-high rounded-xl hover:text-primary cubic-transition">
<span class="material-symbols-outlined">edit</span>
</button>
<button onclick="confirm('Hapus kelas ini?') || event.stopImmediatePropagation()" wire:click="deleteClass({{ $item->id }})" class="w-11 h-11 flex items-center justify-center bg-surface-container-high rounded-xl hover:text-error cubic-transition">
<span class="material-symbols-outlined">delete</span>
</button>
</div>
</div>
@empty
<div class="p-8 text-center text-outline bg-white rounded-3xl col-span-3">Tidak ada data kelas yang sesuai.</div>
@endforelse

<!-- Add New Class Virtual Card -->
<div wire:click="openCreateModal" class="border-2 border-dashed border-outline-variant/50 p-6 rounded-[24px] flex flex-col items-center justify-center text-center group hover:border-primary/50 hover:bg-primary/5 cubic-transition cursor-pointer">
<div class="w-16 h-16 bg-surface-container rounded-full flex items-center justify-center text-outline group-hover:bg-primary/20 group-hover:text-primary cubic-transition mb-4">
<span class="material-symbols-outlined text-4xl">add_circle</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface-variant group-hover:text-primary">Buat Kelas Baru</h3>
<p class="text-on-surface-variant/60 font-body-md text-body-md max-w-[200px] mt-2">Tambahkan entitas kelas untuk periode akademik baru.</p>
</div>
</section>

<!-- Stats Overview Banner -->
<section class="mt-stack-lg glass-card p-8 rounded-[32px] flex flex-col md:flex-row items-center gap-8 overflow-hidden relative">
<div class="flex-1 z-10">
<h4 class="font-headline-md text-headline-md text-on-surface mb-2">Ringkasan Kapasitas</h4>
<p class="text-on-surface-variant mb-6 max-w-lg">Rasio hunian kelas saat ini mencapai {{ $occupancyRate }}%. Terdapat {{ $totalClassesCount }} kelas terdaftar dengan rasio siswa rata-rata per kelas mencapai {{ $averageStudents }} siswa.</p>
<div class="flex gap-10">
<div>
<p class="text-xs font-bold text-on-surface-variant/50 uppercase tracking-widest mb-1">Total Kelas</p>
<p class="text-4xl font-black text-primary">{{ $totalClassesCount }}</p>
</div>
<div>
<p class="text-xs font-bold text-on-surface-variant/50 uppercase tracking-widest mb-1">Ruang Tersedia</p>
<p class="text-4xl font-black text-on-surface">{{ $availableRooms }}</p>
</div>
<div>
<p class="text-xs font-bold text-on-surface-variant/50 uppercase tracking-widest mb-1">Rata-rata/Kelas</p>
<p class="text-4xl font-black text-on-surface">{{ $averageStudents }}</p>
</div>
</div>
</div>
<div class="w-full md:w-1/3 h-48 relative z-10">
<img class="w-full h-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBA4m1Hp0A-WCH2dDwezfxI56EGAoqC1LqmJLerUfk_HY8lY6WojM7aCXPvvZxX98y9px9ZASQVqCaMB90ixdrVh4kMwWrHkPst_4XzVEvJQ5881joakePUj-K53Z_iswQE-qkxgMCCnzOrrE_EYfOOmtHPhGPIzf6YcXHcC5auIfVDINW9KKuuFutFxEpkjyoRzA5aLng1yj8B1m-7QE3dwFP1kkOd5Y46wR3LvSWInQ_ogsxdKl65"/>
</div>
<!-- Background gradient effect -->
<div class="absolute -right-20 -bottom-20 w-80 h-80 bg-primary/5 rounded-full blur-[80px]"></div>
</section>
</main>

<!-- Modals -->
@if($showCreateModal)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl border border-outline-variant/30 space-y-6">
        <h3 class="text-xl font-bold text-on-surface">Buat Kelas Baru</h3>
        <form wire:submit.prevent="createClass" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Nama Kelas</label>
                <input type="text" wire:model="nama_kelas" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" placeholder="e.g. X-IPA 1" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Tingkat</label>
                <select wire:model="tingkat" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Tingkat</option>
                    <option value="X">Kelas X</option>
                    <option value="XI">Kelas XI</option>
                    <option value="XII">Kelas XII</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Wali Kelas</label>
                <select wire:model="wali_kelas_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2">
                    <option value="">Pilih Wali Kelas</option>
                    @foreach($gurus as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="status" class="rounded text-primary focus:ring-primary">
                    <span class="text-sm font-semibold">Aktif (Centang untuk ya, kosongkan jika penuh/tidak aktif)</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" wire:click="$set('showCreateModal', false)" class="px-5 py-2 bg-surface-container hover:bg-surface-container-high rounded-xl font-label-md">Batal</button>
                <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-xl font-label-md shadow-lg shadow-primary/20">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endif

@if($showEditModal)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl border border-outline-variant/30 space-y-6">
        <h3 class="text-xl font-bold text-on-surface">Ubah Kelas</h3>
        <form wire:submit.prevent="updateClass" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Nama Kelas</label>
                <input type="text" wire:model="nama_kelas" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Tingkat</label>
                <select wire:model="tingkat" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Tingkat</option>
                    <option value="X">Kelas X</option>
                    <option value="XI">Kelas XI</option>
                    <option value="XII">Kelas XII</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Wali Kelas</label>
                <select wire:model="wali_kelas_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2">
                    <option value="">Pilih Wali Kelas</option>
                    @foreach($gurus as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="status" class="rounded text-primary focus:ring-primary">
                    <span class="text-sm font-semibold">Aktif</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" wire:click="$set('showEditModal', false)" class="px-5 py-2 bg-surface-container hover:bg-surface-container-high rounded-xl font-label-md">Batal</button>
                <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-xl font-label-md shadow-lg shadow-primary/20">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
        document.querySelectorAll('.glass-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        });
</script>
</div>

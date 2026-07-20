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
<h1 class="font-headline-md text-headline-md text-primary dark:text-primary-fixed-dim font-black leading-tight">SchonaNexa Staff</h1>
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
<input wire:model.live.debounce.300ms="search" class="w-full h-11 pl-10 pr-4 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 cubic-transition font-body-md text-body-md" placeholder="Cari data mata pelajaran..." type="text"/>
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
<!-- Decorative 3D Elements -->
<div class="absolute top-20 right-20 w-48 h-48 opacity-20 floating-object pointer-events-none">
<img class="w-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAknzvkwlxZQShCyy4eJfA4oNiFCKHD1PjrXZDCcqzBb1eSm1DFtQHO1iJ61JXPdhUHo80wYbsMXNp5K3LLTUWpIxCjNE3u3UHj29SDuGseb-7sZKpsK5TTX8VBJ60U6abIl7IQhtLNIPzbyBlJjTNBY5SNKqDi3GkonPiG7zhpL4gkOgGmNRHN2BVgSxVK5LebxyfGjvh8BgUvGdHH4-46_ulEW6kbDohakDoAhopulhCMexIYVKYK"/>
</div>
<!-- Page Header -->
<section class="mb-stack-md flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<nav class="flex items-center gap-2 text-on-surface-variant/60 font-label-sm text-label-sm mb-2">
<span>Akademik</span>
<span class="material-symbols-outlined text-sm">chevron_right</span>
<span class="text-primary font-semibold">Manajemen Mata Pelajaran</span>
</nav>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Manajemen Mata Pelajaran</h2>
<p class="text-on-surface-variant font-body-md text-body-md mt-1 font-semibold">Kelola kurikulum, kode, dan standar nilai kelulusan minimal (KKM).</p>
</div>
<div class="flex items-center gap-3">
<a href="/akademik/kelas" class="px-6 py-3.5 bg-white border border-outline-variant text-on-surface rounded-2xl font-label-md text-label-md hover:bg-surface-container-low cubic-transition">
    Manajemen Kelas
</a>
<a href="/akademik/jadwal" class="px-6 py-3.5 bg-white border border-outline-variant text-on-surface rounded-2xl font-label-md text-label-md hover:bg-surface-container-low cubic-transition">
    Jadwal Pelajaran
</a>
<button wire:click="openCreateModal" class="flex items-center gap-2 bg-primary text-on-primary px-6 py-3.5 rounded-2xl font-label-md text-label-md shadow-lg shadow-primary/25 hover:scale-105 active:scale-95 cubic-transition">
<span class="material-symbols-outlined">add</span>
                Tambah Mapel
</button>
</div>
</section>

<!-- Session Messages -->
@if (session()->has('message'))
    <div class="mb-6 p-4 bg-success/10 border border-success/20 text-success rounded-xl font-semibold">
        {{ session('message') }}
    </div>
@endif

<!-- Mapels Bento Grid -->
<section class="bento-grid">
@forelse($mapels as $item)
<div class="glass-card p-6 rounded-[24px] border-t-4 border-primary group hover:-translate-y-2 cubic-transition flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-6">
<div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white cubic-transition font-bold text-sm">
{{ substr($item->nama_mata_pelajaran, 0, 2) }}
</div>
@if($item->status)
<span class="px-3 py-1 bg-success/10 text-success rounded-full font-label-sm text-label-sm">Aktif</span>
@else
<span class="px-3 py-1 bg-error/10 text-error rounded-full font-label-sm text-label-sm">Nonaktif</span>
@endif
</div>
<h3 class="font-headline-md text-headline-md mb-1">{{ $item->nama_mata_pelajaran }}</h3>
<p class="text-xs text-outline font-semibold mb-4">{{ $item->kode_mata_pelajaran }}</p>
<div class="space-y-3">
<div class="flex items-center gap-3 text-on-surface-variant">
<span class="material-symbols-outlined text-lg">fact_check</span>
<span class="font-body-md text-body-md">KKM: {{ $item->kkm }}</span>
</div>
<div class="text-sm text-on-surface-variant italic line-clamp-2">
{{ $item->deskripsi ?: 'Tidak ada deskripsi.' }}
</div>
</div>
</div>
<div class="mt-8 flex gap-2">
<button onclick="alert('Kode Mapel: {{ $item->kode_mata_pelajaran }}\nKKM: {{ $item->kkm }}')" class="flex-1 py-2.5 bg-surface-container-high rounded-xl font-label-md text-label-md hover:bg-surface-variant cubic-transition">Detail</button>
<button wire:click="openEditModal({{ $item->id }})" class="w-11 h-11 flex items-center justify-center bg-surface-container-high rounded-xl hover:text-primary cubic-transition">
<span class="material-symbols-outlined">edit</span>
</button>
<button onclick="confirm('Hapus mata pelajaran ini?') || event.stopImmediatePropagation()" wire:click="deleteMapel({{ $item->id }})" class="w-11 h-11 flex items-center justify-center bg-surface-container-high rounded-xl hover:text-error cubic-transition">
<span class="material-symbols-outlined">delete</span>
</button>
</div>
</div>
@empty
<div class="p-8 text-center text-outline bg-white rounded-3xl col-span-3">Tidak ada data mata pelajaran yang sesuai.</div>
@endforelse

<!-- Add New Mapel Virtual Card -->
<div wire:click="openCreateModal" class="border-2 border-dashed border-outline-variant/50 p-6 rounded-[24px] flex flex-col items-center justify-center text-center group hover:border-primary/50 hover:bg-primary/5 cubic-transition cursor-pointer">
<div class="w-16 h-16 bg-surface-container rounded-full flex items-center justify-center text-outline group-hover:bg-primary/20 group-hover:text-primary cubic-transition mb-4">
<span class="material-symbols-outlined text-4xl">add_circle</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface-variant group-hover:text-primary">Buat Mapel Baru</h3>
<p class="text-on-surface-variant/60 font-body-md text-body-md max-w-[200px] mt-2">Tambahkan mata pelajaran baru untuk kurikulum akademik.</p>
</div>
</section>

<!-- Stats Overview Banner -->
<section class="mt-stack-lg glass-card p-8 rounded-[32px] flex flex-col md:flex-row items-center gap-8 overflow-hidden relative">
<div class="flex-1 z-10">
<h4 class="font-headline-md text-headline-md text-on-surface mb-2">Ringkasan Mata Pelajaran</h4>
<p class="text-on-surface-variant mb-6 max-w-lg">Terdapat {{ $totalMapels }} mata pelajaran terdaftar dalam kurikulum aktif dengan rata-rata KKM kelulusan minimal di angka {{ $averageKKM }}.</p>
<div class="flex gap-10">
<div>
<p class="text-xs font-bold text-on-surface-variant/50 uppercase tracking-widest mb-1">Total Mapel</p>
<p class="text-4xl font-black text-primary">{{ $totalMapels }}</p>
</div>
<div>
<p class="text-xs font-bold text-on-surface-variant/50 uppercase tracking-widest mb-1">Mapel Aktif</p>
<p class="text-4xl font-black text-on-surface">{{ $activeMapels }}</p>
</div>
<div>
<p class="text-xs font-bold text-on-surface-variant/50 uppercase tracking-widest mb-1">Rata-rata KKM</p>
<p class="text-4xl font-black text-on-surface">{{ $averageKKM }}</p>
</div>
</div>
</div>
<div class="w-full md:w-1/3 h-48 relative z-10">
<img class="w-full h-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBA4m1Hp0A-WCH2dDwezfxI56EGAoqC1LqmJLerUfk_HY8lY6WojM7aCXPvvZxX98y9px9ZASQVqCaMB90ixdrVh4kMwWrHkPst_4XzVEvJQ5881joakePUj-K53Z_iswQE-qkxgMCCnzOrrE_EYfOOmtHPhGPIzf6YcXHcC5auIfVDINW9KKuuFutFxEpkjyoRzA5aLng1yj8B1m-7QE3dwFP1kkOd5Y46wR3LvSWInQ_ogsxdKl65"/>
</div>
<div class="absolute -right-20 -bottom-20 w-80 h-80 bg-primary/5 rounded-full blur-[80px]"></div>
</section>
</main>

<!-- Modals -->
@if($showCreateModal)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl border border-outline-variant/30 space-y-6">
        <h3 class="text-xl font-bold text-on-surface">Buat Mapel Baru</h3>
        <form wire:submit.prevent="createMapel" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Kode Mapel</label>
                <input type="text" wire:model="kode_mata_pelajaran" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" placeholder="e.g. MTK-101" required>
                @error('kode_mata_pelajaran') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Nama Mapel</label>
                <input type="text" wire:model="nama_mata_pelajaran" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" placeholder="e.g. Matematika" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Deskripsi</label>
                <textarea wire:model="deskripsi" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" placeholder="Deskripsi mata pelajaran..."></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">KKM</label>
                <input type="number" wire:model="kkm" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" min="0" max="100" required>
            </div>
            <div>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="status" class="rounded text-primary focus:ring-primary">
                    <span class="text-sm font-semibold">Aktif</span>
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
        <h3 class="text-xl font-bold text-on-surface">Ubah Mapel</h3>
        <form wire:submit.prevent="updateMapel" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Kode Mapel</label>
                <input type="text" wire:model="kode_mata_pelajaran" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                @error('kode_mata_pelajaran') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Nama Mapel</label>
                <input type="text" wire:model="nama_mata_pelajaran" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Deskripsi</label>
                <textarea wire:model="deskripsi" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2"></textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">KKM</label>
                <input type="number" wire:model="kkm" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" min="0" max="100" required>
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

</div>

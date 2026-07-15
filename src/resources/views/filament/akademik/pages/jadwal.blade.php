<div>

<form action="{{ route('filament.akademik.auth.logout') }}" method="POST" id="logout-form" class="hidden">
    @csrf
</form>

<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-full z-40 hidden md:flex flex-col rounded-xl m-4 h-[calc(100vh-32px)] w-72 bg-glass-fill backdrop-blur-xl border border-glass-stroke shadow-xl">
<div class="p-8 flex flex-col items-center">
<div class="mb-8 w-full">
<h1 class="font-headline-lg text-headline-lg text-primary font-black tracking-tighter">SIAKAD Staff</h1>
<p class="text-on-surface-variant font-label-md text-label-md opacity-70">Academic Portal</p>
</div>
<nav class="w-full flex flex-col gap-2">
<a class="text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/kelas">
<span class="material-symbols-outlined">school</span>
<span class="font-label-md text-label-md">Akademik</span>
</a>
<a class="text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/monitoring">
<span class="material-symbols-outlined">monitoring</span>
<span class="font-label-md text-label-md">Monitoring</span>
</a>
<!-- Active Item (Mandate) -->
<a class="bg-primary text-on-primary rounded-xl flex items-center gap-3 px-4 py-3 shadow-lg scale-95 active:scale-90 transition-transform" href="/akademik/jadwal">
<span class="material-symbols-outlined">calendar_today</span>
<span class="font-label-md text-label-md">Jadwal Pelajaran</span>
</a>
<a class="text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/pengumuman">
<span class="material-symbols-outlined">campaign</span>
<span class="font-label-md text-label-md">Informasi</span>
</a>
<a class="text-on-surface-variant hover:text-primary hover:bg-primary/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/profil">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">Akun</span>
</a>
</nav>
</div>
<div class="mt-auto p-8 border-t border-outline-variant/10">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full bg-primary-fixed overflow-hidden border-2 border-white shadow-sm">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqdsTg4baOdr5jsv0KzoCGAXrRgkSvnGxogq4NoCuiM1fmCaQaJdoTQrrezMIGoZVi3F5hDfaBUXMZfnosgkVZv4ytmBMzlZKJnsyABX0Rfegukw3rJMZhyvYfx4Yw5BD1FwSNpWefnyr1OTeDYD19f2M3JhtMblzeaIKPYJ5JnHeMoBHUiZM4SvbhO5Q9EkdUg6xTVKMWHYDOk1tWbs1bKtAif5TMMuvnbcckH2KgVEZQ1hrXh5Ar"/>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface">{{ auth()->user()->name }}</p>
<p class="text-[10px] uppercase tracking-widest text-on-surface-variant font-bold">Coordinator</p>
</div>
</div>
<button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-4 w-full flex items-center gap-2 px-4 py-2 text-error font-label-md hover:bg-error/5 rounded-lg transition-colors">
<span class="material-symbols-outlined">logout</span>
<span>Logout</span>
</button>
</div>
</aside>
<!-- TopNavBar -->
<header class="fixed top-0 right-0 left-0 md:left-80 z-30 flex justify-between items-center px-margin-desktop h-20 bg-glass-fill/70 backdrop-blur-md border-b border-outline-variant/20">
<div class="flex items-center gap-8 w-full max-w-2xl">
<div class="relative w-full max-w-md focus-within:ring-2 focus-within:ring-primary rounded-xl transition-all">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="w-full bg-surface-container-low border-none rounded-xl py-3 pl-12 pr-4 font-body-md text-body-md focus:ring-0" placeholder="Cari guru, mata pelajaran, atau kelas..." type="text"/>
</div>
<div class="hidden lg:flex items-center gap-4">
<div class="px-4 py-1.5 bg-primary/10 text-primary rounded-full font-label-md text-label-md">
                    TA 2024/2025
                </div>
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="pt-24 pb-8 md:pl-80 pr-4 md:pr-12 min-h-screen">
<div class="max-w-[1440px] mx-auto space-y-gutter">
<!-- Header Section -->
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<nav class="flex items-center gap-2 text-outline-variant mb-2">
<span class="text-xs font-bold uppercase tracking-widest">Akademik</span>
<span class="material-symbols-outlined text-sm">chevron_right</span>
<span class="text-xs font-bold uppercase tracking-widest text-primary">Jadwal Pelajaran</span>
</nav>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Manajemen Jadwal</h2>
<p class="text-on-surface-variant font-body-md">Kelola pembagian jam mengajar dan ruang kelas untuk Semester Ganjil.</p>
</div>
<div class="flex items-center gap-3">
<button onclick="window.print()" class="flex items-center gap-2 px-6 py-3 border border-glass-stroke glass-card rounded-xl text-primary font-label-md hover:bg-white transition-all shadow-sm">
<span class="material-symbols-outlined">print</span>
                        Cetak Jadwal
                    </button>
<button wire:click="toggleEditMode" class="flex items-center gap-2 px-6 py-3 {{ $isEditMode ? 'bg-success text-on-primary' : 'bg-primary text-on-primary' }} rounded-xl font-label-md hover:shadow-lg transition-all active:scale-95" id="editModeBtn">
<span class="material-symbols-outlined">{{ $isEditMode ? 'save' : 'edit' }}</span>
                        {{ $isEditMode ? 'Selesai Edit' : 'Edit Schedule' }}
                    </button>
</div>
</section>

<!-- Conflict Alert (Dynamic Visibility) -->
@if($conflictsCount > 0)
<div class="flex items-center justify-between p-4 bg-error-container text-on-error-container rounded-xl border border-error/20 animate-pulse" id="conflictAlert">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined">warning</span>
<p class="font-label-md">Terdapat {{ $conflictsCount }} konflik jadwal ditemukan: {{ implode(', ', $conflictList) }}.</p>
</div>
<button onclick="alert('Daftar konflik:\n{{ implode('\n', $conflictList) }}')" class="text-xs font-bold underline hover:no-underline">Tinjau Konflik</button>
</div>
@endif

<!-- Session Messages -->
@if (session()->has('message'))
    <div class="p-4 bg-success/10 border border-success/20 text-success rounded-xl font-semibold">
        {{ session('message') }}
    </div>
@endif

<!-- Bento Grid - Filters & Summary -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
<!-- Filters Panel -->
<div class="lg:col-span-8 p-8 rounded-3xl bg-white shadow-xl flex flex-wrap gap-4 items-center">
<div class="space-y-1">
<label class="text-[10px] font-black text-outline uppercase tracking-widest px-1">Filter Kelas</label>
<select wire:model.live="filterKelasId" class="block w-48 bg-surface-container-low border-none rounded-xl py-2.5 font-label-md text-on-surface focus:ring-2 focus:ring-primary">
<option value="all">Semua Kelas</option>
@foreach($kelasDropdown as $kd)
<option value="{{ $kd->id }}">{{ $kd->nama_kelas }}</option>
@endforeach
</select>
</div>
<div class="space-y-1">
<label class="text-[10px] font-black text-outline uppercase tracking-widest px-1">Filter Guru</label>
<select wire:model.live="filterGuruId" class="block w-48 bg-surface-container-low border-none rounded-xl py-2.5 font-label-md text-on-surface focus:ring-2 focus:ring-primary">
<option value="all">Semua Guru</option>
@foreach($gurusDropdown as $gd)
<option value="{{ $gd->id }}">{{ $gd->nama }}</option>
@endforeach
</select>
</div>
</div>
<!-- Summary Stats -->
<div class="lg:col-span-4 p-8 rounded-3xl bg-primary text-on-primary shadow-xl flex items-center justify-between overflow-hidden relative">
<div class="relative z-10">
<p class="text-xs font-bold uppercase tracking-widest opacity-80 mb-1">Total Jam/Minggu</p>
<h3 class="text-[40px] font-black leading-none">{{ $totalHours }} <span class="text-lg font-normal opacity-60">Jam</span></h3>
<p class="mt-2 text-xs bg-white/20 inline-block px-2 py-1 rounded">Semester Ganjil 24/25</p>
</div>
<span class="material-symbols-outlined text-8xl absolute -right-4 -bottom-4 opacity-10">schedule</span>
</div>
</div>

<!-- Master Schedule Grid -->
<div class="rounded-3xl bg-white shadow-xl overflow-hidden p-2">
<div class="schedule-grid">
<!-- Column Headers -->
<div class="time-cell font-black bg-surface-container text-on-surface-variant">JAM</div>
<div class="schedule-header">SENIN</div>
<div class="schedule-header">SELASA</div>
<div class="schedule-header">RABU</div>
<div class="schedule-header">KAMIS</div>
<div class="schedule-header">JUMAT</div>

<!-- Time Slot rows -->
@php
    $slotCounter = 0;
@endphp
@foreach($slots as $slotName => $times)
    @php $slotCounter++; @endphp
    
    <!-- Time cell & slot columns -->
    <div class="time-cell text-xs">{{ $slotName }}</div>
    @foreach($days as $day)
        <div class="slot-cell">
            @php $cellItems = $scheduleGrid[$slotName][$day] ?? collect(); @endphp
            @forelse($cellItems as $item)
                @php
                    $isConflict = isset($item->is_conflict) && $item->is_conflict;
                    $cardBg = $isConflict ? 'conflict border-left-color-[#ba1a1a] !bg-[#fef2f2]' : 'border-left-color-[#004ac6] !bg-[#eff6ff]';
                @endphp
                <div wire:click="openEditModal({{ $item->id }})" class="course-card {{ $cardBg }} mb-2">
                    <p class="font-bold text-primary">{{ $item->mataPelajaran?->nama_mata_pelajaran }}</p>
                    <p class="text-[10px] text-on-surface-variant">{{ $item->guru?->nama }} | {{ $item->kelas?->nama_kelas }}</p>
                    <div class="mt-2 flex items-center gap-1 opacity-60">
                        <span class="material-symbols-outlined text-[12px]">location_on</span>
                        <span class="text-[10px]">R.{{ 100 + $item->id }}</span>
                    </div>
                </div>
            @empty
                @if($isEditMode)
                    <button wire:click="openCreateModal('{{ $day }}', '{{ substr($times[0], 0, 5) }}', '{{ substr($times[1], 0, 5) }}')" class="w-full h-full border-2 border-dashed border-primary/20 hover:border-primary/50 hover:bg-primary/5 rounded-lg py-4 flex items-center justify-center text-primary/40 hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-lg">add</span>
                    </button>
                @endif
            @endforelse
        </div>
    @endforeach

    <!-- Draw First Break Row after slot 2 -->
    @if($slotCounter === 2)
        <div class="time-cell text-[10px] bg-surface-variant/20 uppercase tracking-widest text-outline">Break</div>
        <div class="bg-surface-variant/20 flex items-center justify-center text-xs font-bold text-outline py-2 border-l border-white" style="grid-column: span 5;">ISTIRAHAT PERTAMA</div>
    @endif
@endforeach

</div>
</div>

<!-- Instructional Footer -->
<footer class="p-8 border border-outline-variant/20 rounded-3xl bg-surface-container-lowest/50 backdrop-blur-sm flex items-center gap-6">
<div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined">info</span>
</div>
<div>
<h4 class="font-label-md text-on-surface">Tips Manajemen</h4>
<p class="text-sm text-on-surface-variant">Gunakan mode <b>Edit Schedule</b> untuk menambahkan jadwal pelajaran baru di slot kosong secara real-time. Sistem akan mendeteksi bentrok ruangan atau pengajar yang sama secara otomatis.</p>
</div>
</footer>
</div>
</main>

<!-- FAB for adding new entry -->
<button wire:click="openCreateModal()" class="fixed bottom-8 right-8 w-16 h-16 rounded-full bg-primary text-on-primary shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50">
<span class="material-symbols-outlined text-3xl">add</span>
</button>

<!-- Modals -->
@if($showCreateModal)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl border border-outline-variant/30 space-y-6">
        <h3 class="text-xl font-bold text-on-surface">Buat Jadwal Baru</h3>
        <form wire:submit.prevent="createJadwal" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Mata Pelajaran</label>
                <select wire:model="mata_pelajaran_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Mapel</option>
                    @foreach($mapelsDropdown as $mp)
                        <option value="{{ $mp->id }}">{{ $mp->nama_mata_pelajaran }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Guru Pengajar</label>
                <select wire:model="guru_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Guru</option>
                    @foreach($gurusDropdown as $gr)
                        <option value="{{ $gr->id }}">{{ $gr->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Kelas</label>
                <select wire:model="kelas_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelasDropdown as $kl)
                        <option value="{{ $kl->id }}">{{ $kl->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Hari</label>
                    <select wire:model="hari" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-2 py-2" required>
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Jam Mulai</label>
                    <input type="text" wire:model="jam_mulai" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-2 py-2" placeholder="07:30" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Jam Selesai</label>
                    <input type="text" wire:model="jam_selesai" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-2 py-2" placeholder="09:00" required>
                </div>
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
        <h3 class="text-xl font-bold text-on-surface">Ubah / Hapus Jadwal</h3>
        <form wire:submit.prevent="updateJadwal" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Mata Pelajaran</label>
                <select wire:model="mata_pelajaran_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Mapel</option>
                    @foreach($mapelsDropdown as $mp)
                        <option value="{{ $mp->id }}">{{ $mp->nama_mata_pelajaran }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Guru Pengajar</label>
                <select wire:model="guru_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Guru</option>
                    @foreach($gurusDropdown as $gr)
                        <option value="{{ $gr->id }}">{{ $gr->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Kelas</label>
                <select wire:model="kelas_id" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($kelasDropdown as $kl)
                        <option value="{{ $kl->id }}">{{ $kl->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Hari</label>
                    <select wire:model="hari" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-2 py-2" required>
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Jam Mulai</label>
                    <input type="text" wire:model="jam_mulai" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-2 py-2" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Jam Selesai</label>
                    <input type="text" wire:model="jam_selesai" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-2 py-2" required>
                </div>
            </div>
            <div class="flex justify-between items-center pt-4">
                <button type="button" onclick="confirm('Hapus jadwal ini?') || event.stopImmediatePropagation()" wire:click="deleteJadwal({{ $editJadwalId }})" class="px-5 py-2 bg-error text-on-error rounded-xl font-label-md">Hapus Jadwal</button>
                <div class="flex gap-2">
                    <button type="button" wire:click="$set('showEditModal', false)" class="px-5 py-2 bg-surface-container hover:bg-surface-container-high rounded-xl font-label-md">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-xl font-label-md shadow-lg shadow-primary/20">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif

</div>

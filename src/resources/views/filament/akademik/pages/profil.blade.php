<div>

<form action="{{ route('filament.akademik.auth.logout') }}" method="POST" id="logout-form" class="hidden">
    @csrf
</form>

<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-full z-40 hidden md:flex flex-col rounded-xl m-4 h-[calc(100vh-32px)] w-72 bg-glass-fill dark:bg-inverse-surface/80 backdrop-blur-xl border border-glass-stroke shadow-xl">
<div class="p-8">
<h1 class="font-headline-lg text-headline-lg text-primary dark:text-primary-fixed-dim font-black">SIAKAD Staff</h1>
<p class="text-on-surface-variant font-label-md">Academic Portal</p>
</div>
<nav class="flex-1 px-4 space-y-2">
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary flex items-center gap-3 px-4 py-3 hover:bg-primary/10 transition-colors duration-200" href="/akademik">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary flex items-center gap-3 px-4 py-3 hover:bg-primary/10 transition-colors duration-200" href="/akademik/kelas">
<span class="material-symbols-outlined">school</span>
<span class="font-label-md text-label-md">Akademik</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary flex items-center gap-3 px-4 py-3 hover:bg-primary/10 transition-colors duration-200" href="/akademik/monitoring">
<span class="material-symbols-outlined">monitoring</span>
<span class="font-label-md text-label-md">Monitoring</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary flex items-center gap-3 px-4 py-3 hover:bg-primary/10 transition-colors duration-200" href="/akademik/pengumuman">
<span class="material-symbols-outlined">campaign</span>
<span class="font-label-md text-label-md">Informasi</span>
</a>
<!-- Active -->
<a class="bg-primary text-on-primary rounded-xl flex items-center gap-3 px-4 py-3 transition-transform scale-95 active:scale-90" href="/akademik/profil">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">Akun</span>
</a>
</nav>
<div class="p-6 mt-auto border-t border-outline-variant/30">
<div class="bg-surface-container-low rounded-xl p-4 flex items-center gap-4">
<img class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBooDCKezR6kPGmvPgja5ae9SKYUVG1la6P2JT8GH5Y07aqBmXKiyEUY1rAhc0N8vh0q4HdylgHCZH6hPBk3h6_AwZ4adjnTFxBRUk0g8FHw0teBhtFnX1iXFYNQ_eHzFZ8tQLGmbGOMoHjT2dE63M5E4dOSBH-I8ejuGzl5g-Mgz5Fg0nGJZHcYnhHUm1e3wACmPeeGczINtt8B2VUOgYqhMklc1AdUYTXM2BmuzF_LPfs3xbjy3B_"/>
<div>
<p class="font-label-md text-on-surface font-bold">{{ auth()->user()->name }}</p>
<p class="text-[12px] text-on-surface-variant">Super Administrator</p>
</div>
</div>
<button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-4 w-full flex items-center gap-2 px-4 py-2 text-error font-label-md hover:bg-error/5 rounded-lg transition-colors">
<span class="material-symbols-outlined">logout</span>
<span>Logout</span>
</button>
</div>
</aside>
<!-- Main Canvas -->
<main class="md:ml-80 min-h-screen pt-24 px-margin-mobile md:px-margin-desktop pb-12">
<!-- TopNavBar -->
<header class="fixed top-0 right-0 left-0 md:left-80 z-30 flex justify-between items-center px-margin-desktop h-20 bg-glass-fill/70 backdrop-blur-md border-b border-outline-variant/20">
<div class="flex items-center gap-6">
<p class="font-headline-md text-headline-md text-on-surface">Detail Akun &amp; Profil</p>
</div>
</header>

<div class="max-w-container-max mx-auto space-y-stack-md pt-8">

<!-- Session Messages -->
@if (session()->has('message'))
    <div class="p-4 bg-success/10 border border-success/20 text-success rounded-xl font-semibold">
        {{ session('message') }}
    </div>
@endif

<div class="grid grid-cols-12 gap-6">
<!-- Left Side Card (View Only Summary) -->
<div class="col-span-12 lg:col-span-4 space-y-6">
<div class="bg-surface rounded-[24px] p-8 ambient-shadow border border-outline-variant/10 relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-1 bg-primary"></div>
<div class="flex flex-col items-center text-center space-y-4 mb-8">
<div class="relative">
<img class="w-32 h-32 rounded-full object-cover border-4 border-surface shadow-xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAVFnvYmHqlos9TPZ_h5EUxXgIuMfDxOolGzcmdNGHJT58eDfZanDX16M9rLj5qXfxrRc734TkAcWp7VgYUH6Y42DDSOTNXgHYIOK7ZNHWXtErj3am8YplQQBhNkWhX4Fakbl0ydpkD-f0SgUSlROy4-l7CFuGoqSdE1WflXOCRZdjE03EPg_vd5qYcO0k2tz7uYAcBO02qTq2kO1I32CtGP_W-6k7GxgiYL-WGPPvUN3dglFyUlL0_"/>
<div class="absolute bottom-1 right-1 w-6 h-6 bg-success border-2 border-surface rounded-full"></div>
</div>
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">{{ auth()->user()->name }}</h3>
<p class="text-primary font-label-md uppercase tracking-wider">Academic Staff</p>
</div>
</div>
<div class="space-y-6">
<div class="flex items-start gap-4">
<div class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center text-primary">
<span class="material-symbols-outlined">badge</span>
</div>
<div>
<p class="text-label-sm text-on-surface-variant font-medium">NIP Staff</p>
<p class="font-body-md text-on-surface font-bold">{{ auth()->user()->nip ?: '-' }}</p>
</div>
</div>
<div class="flex items-start gap-4">
<div class="w-10 h-10 rounded-xl bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed-variant">
<span class="material-symbols-outlined">alternate_email</span>
</div>
<div>
<p class="text-label-sm text-on-surface-variant font-medium">Kontak Email</p>
<p class="font-body-md text-on-surface font-bold">{{ auth()->user()->email }}</p>
</div>
</div>
<div class="flex items-start gap-4">
<div class="w-10 h-10 rounded-xl bg-surface-container-high flex items-center justify-center text-on-surface-variant">
<span class="material-symbols-outlined">call</span>
</div>
<div>
<p class="text-label-sm text-on-surface-variant font-medium">Telepon</p>
<p class="font-body-md text-on-surface font-bold">{{ auth()->user()->nomor_telepon ?: '-' }}</p>
</div>
</div>
</div>
</div>
</div>

<!-- Right Side Column (Form Edit Profil) -->
<div class="col-span-12 lg:col-span-8">
<div class="bg-surface rounded-[24px] p-8 ambient-shadow border border-outline-variant/10">
    <h3 class="font-headline-md text-headline-md text-on-surface mb-6">Ubah Profil Saya</h3>
    <form wire:submit.prevent="updateProfil" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Nama Lengkap</label>
                <input type="text" wire:model="name" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Email</label>
                <input type="email" wire:model="email" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                @error('email') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">NIP</label>
                <input type="text" wire:model="nip" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2">
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">No. Telepon</label>
                <input type="text" wire:model="nomor_telepon" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2">
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Alamat</label>
            <textarea wire:model="alamat" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2 h-24"></textarea>
        </div>
        <div>
            <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Ganti Password (Kosongkan jika tidak diubah)</label>
            <input type="password" wire:model="password" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" placeholder="Password Baru...">
            @error('password') <span class="text-error text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="pt-4 flex justify-end">
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
</div>
</div>

</div>
</main>

</div>

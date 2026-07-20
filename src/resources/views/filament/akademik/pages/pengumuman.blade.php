<div>

<form action="{{ route('filament.akademik.auth.logout') }}" method="POST" id="logout-form" class="hidden">
    @csrf
</form>

<!-- SideNavBar -->
<aside class="fixed left-0 top-0 h-full z-40 hidden md:flex flex-col rounded-xl m-4 h-[calc(100vh-32px)] w-72 bg-glass-fill dark:bg-inverse-surface/80 backdrop-blur-xl border border-glass-stroke shadow-xl">
<div class="p-8">
<h1 class="font-headline-lg text-headline-lg text-primary dark:text-primary-fixed-dim font-black">SchonaNexa Staff</h1>
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
<a class="bg-primary text-on-primary rounded-xl flex items-center gap-3 px-4 py-3 transition-transform scale-95 active:scale-90" href="/akademik/pengumuman">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">campaign</span>
<span class="font-label-md text-label-md">Informasi</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant hover:text-primary flex items-center gap-3 px-4 py-3 hover:bg-primary/10 transition-colors duration-200" href="/akademik/profil">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">Akun</span>
</a>
</nav>
<div class="p-6 mt-auto border-t border-outline-variant/30">
<div class="bg-surface-container-low rounded-xl p-4 flex items-center gap-4">
<img class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBooDCKezR6kPGmvPgja5ae9SKYUVG1la6P2JT8GH5Y07aqBmXKiyEUY1rAhc0N8vh0q4HdylgHCZH6hPBk3h6_AwZ4adjnTFxBRUk0g8FHw0teBhtFnX1iXFYNQ_eHzFZ8tQLGmbGOMoHjT2dE63M5E4dOSBH-I8ejuGzl5g-Mgz5Fg0nGJZHcYnhHUm1e3wACmPeeGczINtt8B2VUOgYqhMklc1AdUYTXM2BmuzF_LPfs3xbjy3B_"/>
<div>
<p class="font-label-md text-on-surface font-bold">{{ auth()->user()->name }}</p>
<p class="text-[12px] text-on-surface-variant">administrator</p>
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
<div class="relative group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input wire:model.live.debounce.300ms="search" class="pl-10 pr-4 py-2 bg-surface-container-lowest border-none rounded-full w-64 md:w-96 focus:ring-2 focus:ring-primary transition-all text-body-md font-body-md" placeholder="Cari pengumuman..." type="text"/>
</div>
</div>
</header>

<!-- Content Grid -->
<div class="max-w-container-max mx-auto space-y-stack-md">
<!-- Page Header Area -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Informasi &amp; Pengumuman</h2>
<p class="font-body-md text-on-surface-variant font-semibold">Kelola pengumuman akademik sekolah untuk siswa, guru, dan staff.</p>
</div>
<button wire:click="openCreateModal" class="bg-primary text-on-primary px-6 py-3 rounded-full font-label-md flex items-center gap-2 hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-95">
<span class="material-symbols-outlined">add_circle</span>
                    Buat Pengumuman Baru
                </button>
</div>

<!-- Session Messages -->
@if (session()->has('message'))
    <div class="p-4 bg-success/10 border border-success/20 text-success rounded-xl font-semibold">
        {{ session('message') }}
    </div>
@endif

<!-- Bento Layout -->
<div class="grid grid-cols-12 gap-6">
<!-- Left stats column -->
<div class="col-span-12 lg:col-span-4 space-y-6">
<!-- Small Stat Card -->
<div class="bg-primary rounded-[24px] p-6 text-on-primary ambient-shadow flex items-center justify-between overflow-hidden relative">
<div class="relative z-10 text-white">
<p class="text-white/80 font-label-md">Pengumuman Aktif</p>
<h4 class="text-4xl font-black mt-1 text-white">{{ $totalActiveAnn }}</h4>
<p class="text-[12px] mt-2 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">trending_up</span>
                                Terbit saat ini
                            </p>
</div>
<span class="material-symbols-outlined text-8xl absolute -right-4 -bottom-4 opacity-10 rotate-12">campaign</span>
</div>
</div>

<!-- Announcement List (Right Col) -->
<div class="col-span-12 lg:col-span-8 space-y-6">
<!-- Filters -->
<div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
<button wire:click="setFilter('all')" class="px-5 py-2 rounded-full font-label-md whitespace-nowrap {{ $kategoriFilter === 'all' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-surface-container-low' }}">Semua</button>
<button wire:click="setFilter('Akademik')" class="px-5 py-2 rounded-full font-label-md whitespace-nowrap {{ $kategoriFilter === 'Akademik' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-surface-container-low' }}">Akademik</button>
<button wire:click="setFilter('Event')" class="px-5 py-2 rounded-full font-label-md whitespace-nowrap {{ $kategoriFilter === 'Event' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-surface-container-low' }}">Event</button>
<button wire:click="setFilter('Penting')" class="px-5 py-2 rounded-full font-label-md whitespace-nowrap {{ $kategoriFilter === 'Penting' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-surface-container-low' }}">Penting</button>
<button wire:click="setFilter('Archive')" class="px-5 py-2 rounded-full font-label-md whitespace-nowrap {{ $kategoriFilter === 'Archive' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-surface-container-low' }}">Archive</button>
</div>

<!-- Announcement Cards -->
<div class="space-y-4">
@forelse($announcements as $ann)
<div class="bg-surface p-6 rounded-[24px] ambient-shadow border border-outline-variant/10 flex gap-6 hover:scale-[1.01] transition-transform cursor-pointer group">
<div class="hidden sm:flex flex-shrink-0 w-24 h-24 rounded-2xl bg-primary-fixed items-center justify-center overflow-hidden relative">
<span class="material-symbols-outlined text-4xl text-primary group-hover:scale-110 transition-transform">campaign</span>
<div class="absolute bottom-0 w-full h-1 bg-primary"></div>
</div>
<div class="flex-1 space-y-2">
<div class="flex justify-between items-start">
<span class="text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full {{ $ann->kategori === 'Penting' ? 'bg-error-container text-on-error-container' : 'bg-tertiary-container text-on-tertiary-container' }}">
    {{ $ann->kategori }}
</span>
<p class="text-label-sm text-outline">{{ $ann->tanggal ? $ann->tanggal->format('d M Y') : '' }}</p>
</div>
<h4 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">{{ $ann->title }}</h4>
<p class="text-body-md text-on-surface-variant line-clamp-3">{{ strip_tags($ann->content) }}</p>
<div class="flex items-center gap-4 pt-2">
<p class="text-label-sm text-outline">Dibuat oleh {{ $ann->author ?? 'admin' }}</p>
</div>
</div>
<div class="flex flex-col justify-between items-end gap-2">
<div class="flex gap-1">
    <button wire:click="openEditModal({{ $ann->id }})" class="p-2 hover:bg-surface-container-high rounded-full transition-all text-primary" title="Ubah">
        <span class="material-symbols-outlined">edit</span>
    </button>
    <button onclick="confirm('Hapus pengumuman ini?') || event.stopImmediatePropagation()" wire:click="deleteAnn({{ $ann->id }})" class="p-2 hover:bg-surface-container-high rounded-full transition-all text-error" title="Hapus">
        <span class="material-symbols-outlined">delete</span>
    </button>
</div>
</div>
</div>
@empty
<div class="p-8 text-center text-outline bg-white rounded-[24px]">Tidak ada pengumuman terbit.</div>
@endforelse
</div>
</div>
</div>
</div>
</main>

<!-- Modals -->
@if($showCreateModal)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-lg w-full shadow-2xl border border-outline-variant/30 space-y-6">
        <h3 class="text-xl font-bold text-on-surface">Buat Pengumuman Baru</h3>
        <form wire:submit.prevent="createAnn" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Judul Pengumuman</label>
                <input type="text" wire:model="annTitle" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" placeholder="Judul..." required>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Kategori</label>
                <select wire:model="kategori" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="Akademik">Akademik</option>
                    <option value="Event">Event</option>
                    <option value="Penting">Penting</option>
                    <option value="Archive">Archive</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Isi Konten</label>
                <textarea wire:model="content" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2 h-40" placeholder="Isi detail pengumuman..." required></textarea>
            </div>
            <div class="flex gap-4">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="featured" class="rounded text-primary focus:ring-primary">
                    <span class="text-sm font-semibold">Tampilkan Sebagai Utama (Featured)</span>
                </label>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="status_publish" class="rounded text-primary focus:ring-primary">
                    <span class="text-sm font-semibold">Publish Langsung</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" wire:click="$set('showCreateModal', false)" class="px-5 py-2 bg-surface-container hover:bg-surface-container-high rounded-xl font-label-md">Batal</button>
                <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-xl font-label-md shadow-lg shadow-primary/20">Terbitkan</button>
            </div>
        </form>
    </div>
</div>
@endif

@if($showEditModal)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-lg w-full shadow-2xl border border-outline-variant/30 space-y-6">
        <h3 class="text-xl font-bold text-on-surface">Ubah Pengumuman</h3>
        <form wire:submit.prevent="updateAnn" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Judul Pengumuman</label>
                <input type="text" wire:model="annTitle" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Kategori</label>
                <select wire:model="kategori" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2" required>
                    <option value="Akademik">Akademik</option>
                    <option value="Event">Event</option>
                    <option value="Penting">Penting</option>
                    <option value="Archive">Archive</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-outline uppercase tracking-wider mb-1">Isi Konten</label>
                <textarea wire:model="content" class="w-full rounded-xl border-outline-variant bg-surface-container-low px-4 py-2 h-40" required></textarea>
            </div>
            <div class="flex gap-4">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="featured" class="rounded text-primary focus:ring-primary">
                    <span class="text-sm font-semibold">Tampilkan Sebagai Utama (Featured)</span>
                </label>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="status_publish" class="rounded text-primary focus:ring-primary">
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

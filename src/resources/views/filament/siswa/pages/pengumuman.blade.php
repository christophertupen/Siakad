<div class="w-full space-y-8 text-left" x-data="{ openDetail: null }">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Informasi & Pengumuman</h2>
            <p class="text-lg text-on-surface-variant">Ikuti informasi akademis terbaru, kegiatan sekolah, dan kebijakan teraktual dari manajemen sekolah.</p>
        </div>
    </div>

    <!-- Announcement Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($pengumumans as $p)
            <!-- Announcement Card -->
            <div class="glass-card rounded-3xl p-6 group hover:-translate-y-2 transition-all duration-300 flex flex-col cursor-pointer overflow-hidden relative bg-white border border-slate-200/50"
                 @click="openDetail = {{ json_encode($p) }}">
                
                @if($p->thumbnail)
                    <div class="w-full h-44 rounded-2xl mb-5 overflow-hidden relative bg-slate-100">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                             src="/storage/{{ $p->thumbnail }}" 
                             alt="Thumbnail"/>
                    </div>
                @endif
                
                <div class="flex-1 text-left">
                    <div class="flex justify-between items-center mb-3">
                        <span class="px-2.5 py-1 bg-primary/10 text-primary rounded-lg text-[10px] font-black uppercase">{{ $p->kategori ?: 'PENGUMUMAN' }}</span>
                        <span class="text-xs text-slate-400 font-bold">{{ $p->tanggal ? $p->tanggal->format('d M Y') : $p->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2 group-hover:text-primary transition-colors leading-tight">{{ $p->title }}</h3>
                    <p class="text-xs text-on-surface-variant line-clamp-4 leading-relaxed">{{ strip_tags($p->content) }}</p>
                </div>
                
                <div class="border-t border-glass-stroke pt-4 flex items-center justify-between mt-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center border text-[9px] font-bold text-slate-600">
                            {{ substr($p->author ?: 'A', 0, 1) }}
                        </div>
                        <span class="text-[11px] font-bold text-slate-600">{{ $p->author ?: 'Administrator' }}</span>
                    </div>
                    <span class="text-[10px] font-bold text-primary flex items-center gap-1">Baca Selengkapnya →</span>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
                <span class="material-symbols-outlined text-outline text-6xl mb-4">campaign</span>
                <h3 class="font-extrabold text-xl mb-1 text-slate-800">Tidak Ada Pengumuman</h3>
                <p class="text-sm text-slate-500">Saat ini belum ada pengumuman terbit.</p>
            </div>
        @endforelse
    </div>

    <!-- AlpineJS Modal Detail -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] flex items-center justify-center p-4" 
         x-show="openDetail !== null" 
         x-transition
         style="display: none;">
        <div class="bg-white dark:bg-slate-900 rounded-[32px] w-full max-w-2xl overflow-hidden shadow-2xl border border-slate-200/50 dark:border-slate-800 flex flex-col"
             @click.away="openDetail = null">
            
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <span class="px-2.5 py-1 bg-primary/10 text-primary rounded-lg text-xs font-black uppercase" x-text="openDetail?.kategori || 'PENGUMUMAN'"></span>
                <button @click="openDetail = null" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>

            <div class="p-8 overflow-y-auto max-h-[70vh] space-y-6 text-left">
                <h2 class="text-2xl font-extrabold text-slate-800" x-text="openDetail?.title"></h2>
                
                <div class="flex items-center gap-4 text-xs text-slate-400 font-semibold">
                    <span x-text="'Penulis: ' + (openDetail?.author || 'Admin')"></span>
                    <span>•</span>
                    <span x-text="'Tanggal: ' + (openDetail?.tanggal || '')"></span>
                </div>

                <div class="text-sm leading-relaxed text-slate-600 space-y-4" x-html="openDetail?.content"></div>
            </div>
        </div>
    </div>

</div>

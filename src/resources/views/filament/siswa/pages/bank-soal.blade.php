<div class="w-full space-y-8" x-data="{ semesterFilter: 'all', categoryFilter: 'all' }">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="text-left">
            <h1 class="text-3xl md:text-5xl font-extrabold text-on-surface">Bank Soal</h1>
            <p class="text-lg text-on-surface-variant max-w-2xl mt-2">Kumpulan soal-soal latihan, ujian, dan kuis untuk mempersiapkan dirimu lebih baik di kelas {{ $activeKelasName }}.</p>
        </div>
        
        <!-- Filters Bento Section -->
        <div class="flex flex-wrap items-center gap-3 bg-white/40 p-2 rounded-3xl backdrop-blur-md border border-glass-stroke">
            <div class="relative">
                <select x-model="semesterFilter" class="appearance-none bg-white border border-outline-variant rounded-2xl py-2.5 pl-4 pr-10 text-sm font-semibold focus:ring-2 focus:ring-primary/20 cursor-pointer">
                    <option value="all">Semua Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                </select>
            </div>
            <button class="bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-2xl hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">filter_list</span>
                Terapkan
            </button>
        </div>
    </div>

    <!-- Bank Soal Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($bankSoals as $soal)
            <!-- Bank Soal Card -->
            <div class="glass-card rounded-3xl p-6 group hover:-translate-y-2 transition-all duration-300 flex flex-col cursor-pointer overflow-hidden relative bg-white border border-slate-200/50">
                <div class="w-full h-44 rounded-2xl mb-5 overflow-hidden relative bg-blue-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-blue-500 opacity-50 group-hover:scale-110 transition-transform duration-500">quiz</span>
                    <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-extrabold text-primary uppercase">
                        {{ $soal->mataPelajaran?->nama_mata_pelajaran ?? 'Umum' }}
                    </div>
                </div>
                
                <div class="flex-1 text-left">
                    <div class="flex justify-between items-start mb-2 gap-2">
                        <h3 class="font-bold text-lg group-hover:text-primary transition-colors leading-tight">{{ $soal->judul }}</h3>
                        <span class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </div>
                    <p class="text-sm text-on-surface-variant mb-6 line-clamp-3">{{ $soal->deskripsi ?: 'Tidak ada deskripsi tambahan.' }}</p>
                </div>
                
                <div class="border-t border-glass-stroke pt-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center overflow-hidden border">
                            <span class="material-symbols-outlined text-sm text-slate-500">person</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-700">{{ $soal->guru?->nama }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($soal->file)
                        <a href="/storage/{{ $soal->file }}" target="_blank" class="bg-primary/10 hover:bg-primary hover:text-white p-2 rounded-xl text-primary transition-all flex items-center justify-center">
                            <span class="material-symbols-outlined text-sm">download</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
                <div class="w-48 h-48 mb-6 text-slate-300 flex items-center justify-center">
                    <span class="material-symbols-outlined text-9xl">note_stack</span>
                </div>
                <h3 class="font-extrabold text-xl mb-1 text-slate-800">Bank Soal Belum Tersedia</h3>
                <p class="text-sm text-slate-500">Guru belum membagikan bank soal untuk kelasmu.</p>
            </div>
        @endforelse
    </div>

</div>

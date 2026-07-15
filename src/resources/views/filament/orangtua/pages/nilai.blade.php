<div class="w-full space-y-8 text-left">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Laporan Nilai Anak</h2>
            <p class="text-lg text-on-surface-variant">Pantau indeks prestasi kumulatif, nilai tugas, UTS, dan UAS anak Anda secara rinci.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="window.print()" class="px-6 py-3 bg-white border border-outline-variant hover:border-primary text-primary font-bold rounded-xl transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">print</span>
                Cetak Rapor Belajar
            </button>
        </div>
    </div>

    <!-- Bento Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- GPA Card -->
        <div class="glass-card rounded-3xl p-8 relative overflow-hidden bg-white border border-slate-200/50">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-primary"></div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">IPK Anak</p>
                <h3 class="text-4xl font-extrabold text-on-surface mb-2">{{ $gpa }}</h3>
                <p class="text-success flex items-center gap-1 text-xs font-semibold">
                    <span class="material-symbols-outlined text-sm">trending_up</span>
                    Sangat Baik
                </p>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <span class="material-symbols-outlined text-9xl">school</span>
            </div>
        </div>

        <!-- Average Score Card -->
        <div class="glass-card rounded-3xl p-8 relative overflow-hidden bg-white border border-slate-200/50">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-tertiary-container"></div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Rata-rata Nilai</p>
                <h3 class="text-4xl font-extrabold text-on-surface mb-2">{{ $averageScore }}</h3>
                <p class="text-xs text-on-surface-variant font-semibold">Akumulasi seluruh ujian & tugas</p>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <span class="material-symbols-outlined text-9xl">analytics</span>
            </div>
        </div>

        <!-- Ranking Card -->
        <div class="glass-card rounded-3xl p-8 relative overflow-hidden bg-white border border-slate-200/50">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-success"></div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Peringkat Kelas</p>
                <h3 class="text-4xl font-extrabold text-on-surface mb-2">{{ $ranking }}</h3>
                <p class="text-xs text-on-surface-variant font-semibold">Peringkat internal di dalam kelas</p>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <span class="material-symbols-outlined text-9xl">workspace_premium</span>
            </div>
        </div>

        <!-- Trophy Card -->
        <div class="glass-card rounded-3xl p-6 bg-primary/5 flex flex-col items-center justify-center text-center border-2 border-dashed border-primary/20">
            <span class="material-symbols-outlined text-primary text-4xl mb-2 floating-anim" style="font-variation-settings: 'FILL' 1;">stars</span>
            <p class="font-bold text-primary text-sm">Prestasi Akademik</p>
            <p class="text-[10px] text-outline px-4 mt-1">Konsistensi prestasi belajar yang baik</p>
        </div>
    </div>

    <!-- Subject Breakdown Grid -->
    <div class="space-y-6">
        <h4 class="text-xl font-bold">Rincian Nilai per Mata Pelajaran</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            @forelse($nilais as $n)
                <!-- Subject Card -->
                <div class="glass-card rounded-3xl p-6 border-t-4 border-primary bg-white border border-slate-200/50">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-primary/10 rounded-2xl text-primary">
                            <span class="material-symbols-outlined">calculate</span>
                        </div>
                        <div class="px-3 py-1 bg-primary/10 text-primary rounded-full font-bold text-lg">
                            {{ $n->predikat ?: 'A' }}
                        </div>
                    </div>
                    <h5 class="font-bold text-lg mb-1 leading-tight">{{ $n->mataPelajaran?->nama }}</h5>
                    <p class="text-xs text-outline mb-4">Guru: {{ $n->guru?->nama ?? 'Pengampu Mapel' }}</p>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-[11px] font-bold text-on-surface-variant mb-1">
                                <span>Nilai Akhir</span>
                                <span>{{ $n->nilai_akhir }}%</span>
                            </div>
                            <div class="h-1.5 w-full bg-surface-container rounded-full overflow-hidden">
                                <div class="h-full bg-primary" style="width: {{ min(100, $n->nilai_akhir) }}%"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between pt-2 border-t border-outline-variant/30 text-xs font-semibold">
                            <div>
                                <p class="text-[9px] text-outline uppercase">UTS</p>
                                <p class="font-extrabold">{{ $n->uts ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] text-outline uppercase">UAS</p>
                                <p class="font-extrabold">{{ $n->uas ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] text-outline uppercase">Tugas</p>
                                <p class="font-extrabold">{{ $n->tugas ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
                    <span class="material-symbols-outlined text-outline text-6xl mb-4">folder_open</span>
                    <h3 class="font-extrabold text-xl mb-1 text-slate-800">Nilai Belum Tersedia</h3>
                    <p class="text-sm text-slate-500">Guru belum mempublikasikan nilai ujian/tugas anak Anda.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

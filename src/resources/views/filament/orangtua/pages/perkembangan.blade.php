<div class="w-full space-y-8 text-left">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Perkembangan Akademik</h2>
            <p class="text-lg text-on-surface-variant">Pantau kepatuhan pengumpulan tugas dan perkembangan belajar siswa di rumah.</p>
        </div>
    </div>

    <!-- Overall Completion Rate Card -->
    <div class="bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h4 class="font-bold text-slate-800">Tingkat Penyelesaian Tugas</h4>
                <p class="text-xs text-slate-400">Total tugas terkumpul: {{ $submissionsCount }} dari {{ $totalTugas }} tugas terdaftar</p>
            </div>
            <span class="text-2xl font-black text-primary">{{ $completionRate }}%</span>
        </div>
        <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-primary" style="width: {{ $completionRate }}%"></div>
        </div>
    </div>

    <!-- Task List Section -->
    <div class="bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm space-y-6">
        <h3 class="text-xl font-bold">Daftar Tugas & Status Pengumpulan</h3>

        <div class="space-y-4">
            @forelse($tugasList as $t)
                <div class="flex flex-col md:flex-row md:items-center justify-between p-6 bg-slate-50 rounded-2xl gap-4 border border-transparent hover:border-slate-100 transition-all">
                    <div class="space-y-1">
                        <span class="px-2.5 py-0.5 bg-primary/10 text-primary rounded-lg text-[9px] font-black uppercase">{{ $t->mataPelajaran?->nama }}</span>
                        <h4 class="font-bold text-slate-800 text-base">{{ $t->judul }}</h4>
                        <p class="text-xs text-slate-400">Tenggat Waktu: {{ $t->deadline ? $t->deadline->format('d M Y - H:i') : '-' }}</p>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        @if($t->submission)
                            <div class="text-right">
                                <span class="inline-flex px-3 py-1 bg-success/10 text-success rounded-full text-xs font-bold items-center gap-1">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    Terkumpul
                                </span>
                                @if($t->submission->nilai)
                                    <p class="text-xs text-slate-400 mt-1 font-bold">Nilai: <span class="text-primary font-black">{{ $t->submission->nilai }}</span></p>
                                @endif
                            </div>
                        @else
                            <span class="inline-flex px-3 py-1 bg-error/10 text-error rounded-full text-xs font-bold items-center gap-1">
                                <span class="material-symbols-outlined text-sm">warning</span>
                                Belum Terkumpul
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="py-12 flex flex-col items-center justify-center text-center">
                    <span class="material-symbols-outlined text-outline text-6xl mb-4">description</span>
                    <h3 class="font-extrabold text-xl mb-1 text-slate-800">Tidak Ada Tugas</h3>
                    <p class="text-sm text-slate-500">Saat ini belum ada tugas terdaftar untuk kelas anak Anda.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

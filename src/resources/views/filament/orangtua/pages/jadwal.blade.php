<div class="w-full space-y-8 text-left">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Jadwal Pelajaran Anak</h2>
            <p class="text-lg text-on-surface-variant">Lacak jadwal mata pelajaran mingguan dan ruangan kelas belajar anak Anda.</p>
        </div>
    </div>

    <!-- Calendar Grid by Day -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
        @foreach($hariSequence as $hari)
            @php
                $daySchedule = $jadwals->get($hari) ?? collect();
            @endphp
            
            <!-- Day Column Card -->
            <div class="glass-card bg-white border border-slate-200/50 rounded-[28px] p-6 flex flex-col shadow-sm">
                <h3 class="font-extrabold text-lg text-primary border-b border-slate-100 pb-3 mb-4 flex items-center justify-between">
                    <span>{{ $hari }}</span>
                    <span class="px-2 py-0.5 bg-primary/10 rounded-lg text-[10px] font-black text-primary">{{ $daySchedule->count() }} Kelas</span>
                </h3>
                
                <div class="space-y-4 flex-1">
                    @forelse($daySchedule as $item)
                        <div class="p-4 bg-slate-50 rounded-xl space-y-2 border border-transparent hover:border-slate-100 transition-all">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }}</span>
                            <h4 class="font-bold text-slate-800 text-sm leading-tight">{{ $item->mataPelajaran?->nama }}</h4>
                            <div class="text-[10px] text-slate-400 font-medium">
                                <p>Guru: {{ $item->guru?->nama }}</p>
                                <p class="mt-0.5">R. {{ $item->kelas?->ruangan ?? '301' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-6 text-center">Tidak ada jadwal</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

</div>

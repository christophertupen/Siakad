<div class="w-full flex flex-col gap-6" x-data="{ timeRemaining: 3600 }">

    <!-- Hero Section -->
    <section class="relative overflow-hidden glass-card p-10 bg-gradient-to-r from-primary to-primary-container text-white shadow-xl rounded-[32px]">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-4 text-center md:text-left">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20">
                    <span class="material-symbols-outlined text-sm mr-2" style="font-variation-settings: 'FILL' 1;">stars</span>
                    <span class="text-xs font-semibold">Semester {{ $semester }} • TA {{ $tahunAjaran }}</span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Selamat Pagi, {{ $studentName }}!</h1>
                <p class="text-lg opacity-90 max-w-xl">
                    Kamu telah menyelesaikan <span class="font-bold">{{ $progressPercent }}%</span> dari materi semester ini di kelas <span class="font-bold">{{ $activeKelasName }}</span>. Lanjutkan semangat belajarmu hari ini!
                </p>
                <div class="pt-4 flex flex-wrap gap-4 justify-center md:justify-start">
                    <a href="/siswa/materi" class="px-6 py-3 bg-white text-primary font-bold rounded-xl shadow-lg hover:scale-105 transition-transform inline-block">
                        Lanjutkan Belajar
                    </a>
                    <a href="/siswa/absensi" class="px-6 py-3 bg-white/10 backdrop-blur-md border border-white/20 font-bold rounded-xl hover:bg-white/20 transition-all inline-block">
                        Lihat Absensi
                    </a>
                </div>
            </div>
            <div class="relative w-full md:w-1/3 flex justify-center">
                <img class="w-64 h-64 object-contain floating-anim drop-shadow-2xl" src="https://lh3.googleusercontent.com/aida/AP1WRLsn1oka5SMhyA7odbMwU3oJmllfIPNvCvOPTPlhhO8zsUeU5u_5p5x3yuASz9On9QSILVY6Yse37zYcgENATthEfhl-zC6iGtB42tZVMhf93AlPKPoi8UNxLMr_DtKyyGwunM9Jsggp6zp6cfKIOCMKGukA7aEzepzVTqYwBuCchOXQWgj93duZUeeW9HgYJgqTbd3IFtqvtjX38tWODq6_i9z2qZlOHT1k65Se1M7kU2_kJWTbHbI5vjY" alt="Backpack"/>
            </div>
        </div>
        <!-- Abstract background shapes -->
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-primary-fixed-dim/10 rounded-full blur-3xl"></div>
    </section>

    <!-- Bento Grid Section -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        
        <!-- Card 1: Today's Schedule -->
        <div class="md:col-span-4 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-[32px] p-8 flex flex-col shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold">Jadwal Hari Ini</h3>
                <span class="text-primary font-bold text-sm">{{ $currentDateString }}</span>
            </div>
            <div class="space-y-8 relative before:content-[''] before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-surface-container">
                @if($todaySchedule->count() > 0)
                    @foreach($todaySchedule as $index => $item)
                        <div class="relative pl-10">
                            @if($index === 0)
                                <div class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-primary flex items-center justify-center border-4 border-white shadow-sm z-10 animate-pulse"></div>
                            @else
                                <div class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-surface-container flex items-center justify-center border-4 border-white z-10"></div>
                            @endif
                            <p class="text-xs font-semibold text-on-surface-variant">{{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }}</p>
                            <h4 class="font-bold text-lg leading-tight">{{ $item->mataPelajaran?->nama }}</h4>
                            <p class="text-sm text-on-surface-variant">{{ $item->guru?->nama }} • R. {{ $item->kelas?->ruangan ?? '301' }}</p>
                            @if($index === 0)
                                <span class="inline-block mt-2 px-3 py-1 rounded-full bg-success/10 text-success text-[10px] font-bold">Berlangsung</span>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="relative pl-10">
                        <div class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-slate-300 flex items-center justify-center border-4 border-white z-10"></div>
                        <p class="text-xs font-semibold text-on-surface-variant">Hari ini</p>
                        <h4 class="font-bold text-lg text-slate-400">Tidak Ada Jadwal Kelas</h4>
                        <p class="text-sm text-on-surface-variant">Nikmati waktu luangmu atau ulangi materi!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column - Stats & Kanban -->
        <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
            
            <!-- Card 2: Pending Assignments -->
            <a href="/siswa/tugas" class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-[28px] p-6 flex flex-col items-center justify-center text-center group hover:border-primary/30 transition-all cursor-pointer shadow-sm">
                <div class="mb-4 relative">
                    <div class="absolute inset-0 bg-primary/10 rounded-full blur-xl group-hover:blur-2xl transition-all"></div>
                    <span class="material-symbols-outlined text-primary text-5xl relative" style="font-variation-settings: 'FILL' 1;">assignment_late</span>
                </div>
                <h4 class="text-4xl font-extrabold text-primary">{{ $pendingAssignmentsCount }}</h4>
                <p class="text-sm font-semibold text-on-surface-variant">Tugas Tertunda</p>
                <p class="text-[12px] text-error font-semibold mt-1">Butuh diselesaikan segera</p>
            </a>

            <!-- Card 3: Average Score -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-[28px] p-6 flex flex-col items-center justify-center text-center shadow-sm">
                <div class="relative w-24 h-24 mb-4">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle class="text-surface-container" cx="48" cy="48" fill="transparent" r="40" stroke="currentColor" stroke-width="8"></circle>
                        <circle class="text-primary-container" cx="48" cy="48" fill="transparent" r="40" stroke="currentColor" stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 - (251.2 * ($averageScore / 100)) }}" stroke-width="8"></circle>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center flex-col">
                        <span class="font-bold text-xl">{{ $averageScore }}</span>
                        <span class="text-[10px] font-bold text-on-surface-variant">/100</span>
                    </div>
                </div>
                <h4 class="text-sm font-semibold">Rata-rata Nilai</h4>
                <span class="inline-block mt-2 px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded">Hasil Semester Ini</span>
            </div>

            <!-- Card 4: Attendance -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-[28px] p-6 flex flex-col justify-center shadow-sm">
                <div class="flex items-end gap-2 mb-2">
                    <h4 class="text-4xl font-extrabold text-success">{{ $attendanceRate }}%</h4>
                    <span class="text-xs font-semibold text-on-surface-variant mb-1">Hadir</span>
                </div>
                <div class="w-full h-3 bg-surface-container rounded-full overflow-hidden mb-4">
                    <div class="h-full bg-success" style="width: {{ $attendanceRate }}%"></div>
                </div>
                <p class="text-[11px] font-semibold text-on-surface-variant leading-tight">Kamu mempertahankan rekor kehadiran yang luar biasa!</p>
            </div>

            <!-- Card 5: Kanban Board -->
            <div class="sm:col-span-3 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-[32px] p-8 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-bold">Kanban Board Tugas</h3>
                    <a href="/siswa/tugas" class="text-primary font-bold flex items-center gap-2 hover:underline">
                        <span class="material-symbols-outlined text-sm">add</span> Buka Tugas
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- To Do -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-2 h-2 rounded-full bg-error"></div>
                            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">To Do ({{ $todoTugas->count() }})</span>
                        </div>
                        @forelse($todoTugas->take(2) as $t)
                            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/30 space-y-2 hover:shadow-md transition-shadow text-left">
                                <h5 class="font-bold text-sm leading-snug">{{ $t->judul }}</h5>
                                <p class="text-[11px] text-on-surface-variant">Mapel: {{ $t->mataPelajaran?->nama }}</p>
                                <p class="text-[11px] text-error font-bold">Deadline: {{ $t->deadline ? $t->deadline->format('d M Y') : '-' }}</p>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic">Tidak ada tugas baru</p>
                        @endforelse
                    </div>

                    <!-- In Progress -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-2 h-2 rounded-full bg-tertiary"></div>
                            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">In Progress ({{ $inProgressTugas->count() }})</span>
                        </div>
                        @forelse($inProgressTugas->take(2) as $t)
                            <div class="p-4 bg-surface-container-low rounded-xl border-l-4 border-l-tertiary shadow-sm space-y-2 text-left">
                                <h5 class="font-bold text-sm leading-snug">{{ $t->judul }}</h5>
                                <p class="text-[11px] text-on-surface-variant">Deadline Dekat!</p>
                                <p class="text-[11px] text-error font-bold">{{ $t->deadline ? $t->deadline->format('d M Y H:i') : '-' }}</p>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic">Tidak ada tugas mendesak</p>
                        @endforelse
                    </div>

                    <!-- Done -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-2 h-2 rounded-full bg-success"></div>
                            <span class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Done ({{ $doneTugas->count() }})</span>
                        </div>
                        @forelse($doneTugas->take(2) as $t)
                            <div class="p-4 bg-surface-container-low/50 rounded-xl border border-outline-variant/20 opacity-80 space-y-1 text-left">
                                <h5 class="font-bold text-sm line-through leading-snug text-slate-400">{{ $t->judul }}</h5>
                                <div class="flex items-center gap-1 text-success">
                                    <span class="material-symbols-outlined text-sm">check_circle</span>
                                    <span class="text-[10px] font-bold">Submitted</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic">Belum ada tugas selesai</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Card 6: Latest Materials -->
            <div class="sm:col-span-2 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-[32px] p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold">Materi Terbaru</h3>
                    <a class="text-sm font-bold text-primary" href="/siswa/materi">Lihat Semua</a>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    @forelse($latestMaterials as $mat)
                        <div class="flex items-center p-4 hover:bg-surface-variant/20 rounded-2xl transition-all cursor-pointer border border-transparent hover:border-outline-variant/30">
                            <div class="w-12 h-12 rounded-xl bg-error-container flex items-center justify-center mr-4">
                                <span class="material-symbols-outlined text-on-error-container">picture_as_pdf</span>
                            </div>
                            <div class="flex-1 text-left">
                                <h5 class="font-bold text-on-surface">{{ $mat->judul }}</h5>
                                <p class="text-xs text-on-surface-variant">Diunggah oleh {{ $mat->guru?->nama }} • {{ $mat->tanggal_dibuat ? $mat->tanggal_dibuat->format('d M Y') : '' }}</p>
                            </div>
                            <a href="/storage/{{ $mat->file }}" target="_blank" class="p-2 text-outline hover:text-primary transition-colors">
                                <span class="material-symbols-outlined">download</span>
                            </a>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-4">Belum ada materi baru yang diunggah</p>
                    @endforelse
                </div>
            </div>

            <!-- Card 7: Recent Grades -->
            <div class="sm:col-span-1 bg-white dark:bg-slate-900 border border-slate-200/50 dark:border-slate-800 rounded-[32px] p-8 shadow-sm">
                <h3 class="text-xl font-bold mb-6">Nilai Terakhir</h3>
                <div class="space-y-6">
                    @forelse($recentGrades as $grade)
                        <div class="flex items-center justify-between text-left">
                            <div>
                                <h5 class="font-bold text-sm">{{ $grade->mataPelajaran?->nama }}</h5>
                                <p class="text-[11px] text-on-surface-variant">Tahun Ajaran: {{ $grade->tahun_ajaran }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-extrabold text-lg text-primary">{{ $grade->nilai_akhir }}</p>
                                <span class="text-[10px] font-bold text-success bg-success/10 px-1.5 py-0.5 rounded">{{ $grade->predikat ?: 'A' }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-4">Belum ada nilai yang diinput</p>
                    @endforelse
                </div>
                <a href="/siswa/nilai" class="w-full mt-8 py-3 bg-surface-container-low border border-outline-variant/30 rounded-xl font-bold text-sm hover:bg-surface-variant/30 transition-all block text-center">
                    Rapor Lengkap
                </a>
            </div>

        </div>
    </div>

</div>

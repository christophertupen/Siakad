<div class="w-full flex flex-col gap-6">

    <!-- Parent Welcome Banner -->
    <section class="relative overflow-hidden glass-card p-10 bg-gradient-to-r from-primary to-primary-container text-white shadow-xl rounded-[32px] text-left">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-4">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20">
                    <span class="material-symbols-outlined text-sm mr-2" style="font-variation-settings: 'FILL' 1;">face</span>
                    <span class="text-xs font-semibold">Portal Wali Murid</span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Selamat Datang, {{ $parentName }}!</h1>
                <p class="text-lg opacity-90 max-w-xl">
                    Melalui portal ini, Anda dapat memantau aktivitas belajar, kehadiran kelas, rincian tagihan, dan rapor akademik anak Anda, <span class="font-bold">{{ $childName }}</span>.
                </p>
                <div class="pt-2 flex gap-4">
                    <a href="/orangtua/perkembangan" class="px-6 py-3 bg-white text-primary font-bold rounded-xl shadow-lg hover:scale-105 transition-transform inline-block">
                        Lihat Perkembangan Anak
                    </a>
                </div>
            </div>
            <div class="relative w-full md:w-1/3 flex justify-center">
                <img class="w-48 h-48 object-contain floating-anim drop-shadow-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAr4_SRCT0FqHciCHBdkw381xD5nJaEAgeAt2jN4M1nTEe94PY268B1iFa-XvuQMZNSIxxagFY-LUgNK_b6ZJuDiAUvVs0-1JE_Ry8CYBNompXMCjA0pS0wwTN1QIKfq1D0iP7TVAitJMpsh1HggUNQTb2oQCO3u_BT-2xh8lDHNjYQy556YbM43K16eLqq_SapLvkv8_ioGD6_V7H03yLytk9pyirLAZp026B5dmq8oWElDLRhsVPS" alt="Rocket"/>
            </div>
        </div>
    </section>

    <!-- Bento Grid Stats & Logs -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 text-left">
        <!-- Stats Summary Section (Left, 8 Cols) -->
        <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
            
            <!-- Kehadiran Anak -->
            <a href="/orangtua/absensi" class="glass-card p-8 bg-white border border-slate-200/50 rounded-[28px] shadow-sm flex flex-col justify-between hover:border-primary/20 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-slate-800 text-sm">Persentase Kehadiran Anak</h4>
                    <span class="material-symbols-outlined text-success">how_to_reg</span>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-success mb-2">{{ $attendanceRate }}%</h3>
                    <p class="text-xs text-on-surface-variant">Data absensi real-time kelas pelajaran {{ $activeKelasName }}</p>
                </div>
            </a>

            <!-- Rerata Nilai -->
            <a href="/orangtua/nilai" class="glass-card p-8 bg-white border border-slate-200/50 rounded-[28px] shadow-sm flex flex-col justify-between hover:border-primary/20 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-slate-800 text-sm">Rata-rata Nilai Tugas & Ujian</h4>
                    <span class="material-symbols-outlined text-primary">analytics</span>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-primary mb-2">{{ $averageGrade }}</h3>
                    <p class="text-xs text-on-surface-variant">Indeks prestasi kumulatif anak semester aktif</p>
                </div>
            </a>

            <!-- Tugas Tertunda -->
            <div class="glass-card p-8 bg-white border border-slate-200/50 rounded-[28px] shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-slate-800 text-sm">Tugas Belum Selesai</h4>
                    <span class="material-symbols-outlined text-warning">assignment_late</span>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-warning mb-2">{{ $pendingAssignmentsCount }} Tugas</h3>
                    <p class="text-xs text-on-surface-variant">Butuh pengawasan pengerjaan di rumah</p>
                </div>
            </div>

            <!-- Invoices Pending -->
            <a href="/orangtua/pembayaran" class="glass-card p-8 bg-white border border-slate-200/50 rounded-[28px] shadow-sm flex flex-col justify-between hover:border-primary/20 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-slate-800 text-sm">Tagihan Belum Dibayar</h4>
                    <span class="material-symbols-outlined text-error">payments</span>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-error mb-2">{{ $pendingBillsCount }} Transaksi</h3>
                    <p class="text-xs text-on-surface-variant">Klik untuk melakukan pelunasan via Midtrans</p>
                </div>
            </a>

            <!-- Today's Schedule -->
            <div class="sm:col-span-2 bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-800">Jadwal Kelas Anak Hari Ini</h3>
                    <span class="text-sm font-bold text-primary">{{ $currentDateString }}</span>
                </div>
                <div class="space-y-4">
                    @forelse($todaySchedule as $sched)
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                            <div>
                                <h4 class="font-bold text-slate-800">{{ $sched->mataPelajaran?->nama }}</h4>
                                <p class="text-xs text-slate-400">Guru: {{ $sched->guru?->nama }} • R. {{ $sched->kelas?->ruangan ?? '301' }}</p>
                            </div>
                            <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold">{{ substr($sched->jam_mulai, 0, 5) }} - {{ substr($sched->jam_selesai, 0, 5) }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-4">Hari ini tidak ada kelas berlangsung</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Grades & Child Card (Right, 4 Cols) -->
        <div class="md:col-span-4 flex flex-col gap-6">
            <!-- Dynamic child card details -->
            <div class="glass-card p-6 bg-white border border-slate-200/50 rounded-[32px] shadow-sm flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-full border-4 border-primary overflow-hidden shadow-md mb-4">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIJfZros69AYwO4PYlcZcwU4yfuvt0XNk3_je1VLma6iyiG8h__NAoU-nLbXVoTwU3h5dbeSLgKjfxpmfUGLZtjgyLs4BTT45aJw4oAUbmhsUjmOEWZyYHIlyQjdFlhSuoqdsrGjmgpyPTOvJpBJK7vXnATxS1WfzLtscIfR0dVBQOBUcyp8dC_WjIbWPQ3JVsfmOxDuolz7zhgdYgrySCyvoGj7osfFl6oLp6Mk2sZ-uGsbMYpV0D" alt="Avatar child"/>
                </div>
                <h4 class="font-extrabold text-lg">{{ $childName }}</h4>
                <p class="text-xs text-slate-400 font-bold uppercase mt-1">NISN: {{ $childNisn }}</p>
                <p class="text-xs font-semibold text-primary bg-primary/10 px-3 py-1 rounded-full mt-3">{{ $activeKelasName }}</p>
            </div>

            <!-- Recent Academic Grades -->
            <div class="glass-card p-6 bg-white border border-slate-200/50 rounded-[32px] shadow-sm flex flex-col">
                <h3 class="font-bold text-lg text-slate-800 mb-6">Nilai Terakhir Anak</h3>
                <div class="space-y-4">
                    @forelse($recentGrades as $grade)
                        <div class="flex items-center justify-between border-b border-slate-50 pb-3 last:border-0 last:pb-0">
                            <div>
                                <h5 class="font-bold text-sm leading-snug">{{ $grade->mataPelajaran?->nama }}</h5>
                                <p class="text-[10px] text-slate-400">Predikat: {{ $grade->predikat ?: 'A' }}</p>
                            </div>
                            <span class="text-lg font-black text-primary">{{ $grade->nilai_akhir }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic py-4">Belum ada nilai terinput</p>
                    @endforelse
                </div>
                <a href="/orangtua/nilai" class="w-full mt-6 py-3 bg-slate-50 hover:bg-slate-100 border rounded-xl font-bold text-xs text-slate-600 text-center block">
                    Lihat Semua Nilai
                </a>
            </div>
        </div>
    </div>

</div>

<div class="w-full space-y-8 text-left">

    <!-- Hero Stat Section -->
    <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="glass-card p-6 rounded-3xl col-span-1 md:col-span-2 relative overflow-hidden bg-primary/5 border border-primary/10">
            <div class="relative z-10">
                <p class="text-primary font-bold text-sm mb-2">Persentase Kehadiran Anak</p>
                <h2 class="text-4xl font-extrabold text-on-surface mb-2">{{ $attendanceRate }}%</h2>
                <p class="text-sm text-on-surface-variant">Anak Anda mempertahankan tingkat partisipasi kelas yang sangat baik semester ini.</p>
                <div class="mt-6 flex gap-4">
                    <span class="px-4 py-2 bg-success/10 text-success rounded-full text-xs font-semibold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">trending_up</span> Di atas target sekolah
                    </span>
                </div>
            </div>
            <img class="absolute -right-4 -bottom-4 w-40 h-40 opacity-30 transform rotate-12 pointer-events-none" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-p9jtPQRYoOKl1vc2Vu3RgDSJG9JkDVe2h2A7iRisiqFkNT0wsti-jfVBSd70IltpvAvoXdL_JoTs631t27EqrNbqoyx6fC5vxMSl5K7h0YgN7eJjCb21FyJFlsflJdtyyO7cIq3nrM7W-ve_AhKrDNNGyWQ-X9LPcgmYirl1j4OEXtyiYl2KMYOgOpqt1Hgi1Ec-_96YX2cHakaqv4q4UFI6LXkSGyzQS9Ekzks7AXcCPVZWSaBM" alt="Decoration"/>
        </div>
        
        <div class="glass-card p-6 rounded-3xl flex flex-col justify-between bg-white border border-slate-200/50">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-success/10 flex items-center justify-center text-success mb-4">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                </div>
                <p class="text-on-surface-variant font-bold text-sm">Total Hari Hadir</p>
                <h3 class="text-2xl font-extrabold">{{ $presentDays }} Hari</h3>
            </div>
            <p class="text-xs text-outline mt-2 italic">Tercatat dalam basis data akademik</p>
        </div>

        <div class="glass-card p-6 rounded-3xl flex flex-col justify-between bg-white border border-slate-200/50">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-error/10 flex items-center justify-center text-error mb-4">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">cancel</span>
                </div>
                <p class="text-on-surface-variant font-bold text-sm">Hari Tidak Hadir (Alpha)</p>
                <h3 class="text-2xl font-extrabold">{{ $absentDays }} Hari</h3>
            </div>
            <p class="text-xs text-outline mt-2 italic">Sakit/Izin: {{ $sickLeaveDays }} Hari</p>
        </div>
    </section>

    <!-- Main Interactive Area: Heatmap & Timeline -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Attendance Heatmap (Calendar) -->
        <div class="glass-card p-8 rounded-[32px] lg:col-span-2 bg-white border border-slate-200/50">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-xl font-bold">Kalender Absensi Bulanan</h3>
                    <p class="text-on-surface-variant text-sm mt-1">Status harian anak Anda pada bulan {{ $currentMonthName }}</p>
                </div>
            </div>
            
            <!-- Heatmap Grid -->
            <div class="grid grid-cols-7 gap-4 mb-8">
                <div class="text-center font-bold text-xs text-outline py-2">Sen</div>
                <div class="text-center font-bold text-xs text-outline py-2">Sel</div>
                <div class="text-center font-bold text-xs text-outline py-2">Rab</div>
                <div class="text-center font-bold text-xs text-outline py-2">Kam</div>
                <div class="text-center font-bold text-xs text-outline py-2">Jum</div>
                <div class="text-center font-bold text-xs text-outline py-2">Sab</div>
                <div class="text-center font-bold text-xs text-outline py-2">Min</div>

                @foreach($calendarDays as $cDay)
                    @if($cDay['status'] === 'blank')
                        <div class="h-16 rounded-2xl bg-slate-50/55 border border-transparent"></div>
                    @else
                        @php
                            $cellClass = 'bg-slate-100 text-slate-500';
                            if ($cDay['status'] === 'Hadir') {
                                $cellClass = 'bg-success text-white font-extrabold shadow-sm';
                            } elseif ($cDay['status'] === 'Sakit' || $cDay['status'] === 'Izin') {
                                $cellClass = 'bg-tertiary-fixed text-on-tertiary-fixed font-bold shadow-sm';
                            } elseif ($cDay['status'] === 'Alpha') {
                                $cellClass = 'bg-error text-white font-extrabold shadow-sm';
                            } elseif ($cDay['status'] === 'Weekend') {
                                $cellClass = 'bg-secondary-fixed text-on-secondary-fixed opacity-70 font-semibold';
                            }
                        @endphp
                        <div class="h-16 rounded-2xl flex items-center justify-center text-sm shadow-sm transition-transform hover:scale-110 cursor-default {{ $cellClass }}">
                            {{ $cDay['day'] }}
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Legends -->
            <div class="flex flex-wrap items-center gap-6 pt-6 border-t border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-success"></span>
                    <span class="text-xs font-bold text-on-surface-variant">Hadir</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-tertiary-fixed"></span>
                    <span class="text-xs font-bold text-on-surface-variant">Sakit / Izin</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-error"></span>
                    <span class="text-xs font-bold text-on-surface-variant">Alpha (Tanpa Keterangan)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-secondary-fixed"></span>
                    <span class="text-xs font-bold text-on-surface-variant">Akhir Pekan</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity Timeline -->
        <div class="glass-card p-8 rounded-[32px] flex flex-col bg-white border border-slate-200/50">
            <h3 class="text-xl font-bold mb-6">Log Kehadiran Terbaru</h3>
            <div class="flex-1 space-y-8 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-slate-100">
                @forelse($absensis as $absen)
                    <div class="relative pl-10">
                        @if($absen->status === 'Hadir')
                            <span class="absolute left-0 top-1 w-6 h-6 rounded-full bg-success flex items-center justify-center text-white shadow-lg">
                                <span class="material-symbols-outlined text-[14px]">done</span>
                            </span>
                        @elseif($absen->status === 'Alpha')
                            <span class="absolute left-0 top-1 w-6 h-6 rounded-full bg-error flex items-center justify-center text-white">
                                <span class="material-symbols-outlined text-[14px]">close</span>
                            </span>
                        @else
                            <span class="absolute left-0 top-1 w-6 h-6 rounded-full bg-tertiary-container flex items-center justify-center text-white">
                                <span class="material-symbols-outlined text-[14px]">description</span>
                            </span>
                        @endif
                        <p class="font-bold text-sm text-on-surface">Tercatat: {{ $absen->status }}</p>
                        <p class="text-[10px] text-outline">{{ $absen->tanggal->format('d M Y') }}</p>
                        @if($absen->keterangan)
                            <p class="text-xs text-on-surface-variant bg-slate-50 p-2.5 rounded-lg mt-2">Ket: {{ $absen->keterangan }}</p>
                        @endif
                    </div>
                @empty
                    <div class="relative pl-10">
                        <span class="absolute left-0 top-1 w-6 h-6 rounded-full bg-slate-300 flex items-center justify-center text-white">
                            <span class="material-symbols-outlined text-[14px]">info</span>
                        </span>
                        <p class="font-bold text-sm text-slate-400">Belum Ada Riwayat Kehadiran</p>
                    </div>
                @endforelse
            </div>
        </div>

    </section>

</div>

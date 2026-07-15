<div class="w-full space-y-8 text-left">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Rapor Hasil Belajar</h2>
            <p class="text-lg text-on-surface-variant">Laporan Pencapaian Kompetensi Peserta Didik Semester {{ $semester }} TA {{ $tahunAjaran }}</p>
        </div>
        <div class="flex gap-3">
            <button onclick="window.print()" class="px-6 py-3 bg-primary text-white rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform font-bold text-sm flex items-center gap-2">
                <span class="material-symbols-outlined">print</span>
                Cetak Rapor Resmi
            </button>
        </div>
    </div>

    <!-- Formal Report Card Card -->
    <div class="bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm space-y-8">
        
        <!-- Header Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-6 border-b border-slate-100 text-sm">
            <div class="space-y-1">
                <p class="text-slate-400 font-semibold uppercase text-[10px]">Nama Peserta Didik</p>
                <p class="font-bold text-slate-800 text-lg">{{ auth()->user()->siswa?->nama ?? auth()->user()->name }}</p>
                <p class="text-slate-400 font-semibold uppercase text-[10px] pt-2">Nomor Induk Siswa (NISN / NIS)</p>
                <p class="font-bold text-slate-800">{{ auth()->user()->siswa?->nisn ?? auth()->user()->siswa?->nis ?? '-' }}</p>
            </div>
            <div class="space-y-1 md:text-right">
                <p class="text-slate-400 font-semibold uppercase text-[10px]">Kelas Aktif</p>
                <p class="font-bold text-slate-800 text-lg">{{ $activeKelasName }}</p>
                <p class="text-slate-400 font-semibold uppercase text-[10px] pt-2">Semester / Tahun Ajaran</p>
                <p class="font-bold text-slate-800">{{ $semester }} / {{ $tahunAjaran }}</p>
            </div>
        </div>

        <!-- Grade Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-slate-400 uppercase text-[11px] font-black tracking-wider">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Mata Pelajaran</th>
                        <th class="py-3 px-4 text-center">Tugas</th>
                        <th class="py-3 px-4 text-center">UTS</th>
                        <th class="py-3 px-4 text-center">UAS</th>
                        <th class="py-3 px-4 text-center">Nilai Akhir</th>
                        <th class="py-3 px-4 text-center">Predikat</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($nilais as $index => $n)
                        <tr class="hover:bg-slate-50/55 transition-colors font-semibold text-slate-700">
                            <td class="py-4 px-4">{{ $index + 1 }}</td>
                            <td class="py-4 px-4">
                                <p class="text-slate-800 font-bold">{{ $n->mataPelajaran?->nama }}</p>
                                <p class="text-[10px] text-slate-400 font-medium">Guru: {{ $n->guru?->nama ?? 'Pengampu Mapel' }}</p>
                            </td>
                            <td class="py-4 px-4 text-center">{{ $n->tugas ?? '-' }}</td>
                            <td class="py-4 px-4 text-center">{{ $n->uts ?? '-' }}</td>
                            <td class="py-4 px-4 text-center">{{ $n->uas ?? '-' }}</td>
                            <td class="py-4 px-4 text-center font-bold text-primary">{{ $n->nilai_akhir }}</td>
                            <td class="py-4 px-4 text-center">
                                <span class="px-2.5 py-1 bg-primary/10 text-primary rounded-lg text-xs font-black">{{ $n->predikat ?: 'A' }}</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if($n->nilai_akhir >= 75)
                                    <span class="text-success font-bold flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">check_circle</span> Lulus
                                    </span>
                                @else
                                    <span class="text-error font-bold flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">cancel</span> Remedial
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-slate-400 italic">Belum ada data nilai semester ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Attendance Summary & Sign-off -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-8 border-t border-slate-100 text-sm">
            <!-- Attendance Summary -->
            <div class="space-y-4">
                <h4 class="font-bold text-slate-800">Ketidakhadiran</h4>
                <div class="space-y-2 font-semibold">
                    <div class="flex justify-between p-3 bg-slate-50 rounded-xl">
                        <span class="text-slate-500">Sakit / Izin</span>
                        <span class="text-slate-800">{{ $sickLeaveDays }} Hari</span>
                    </div>
                    <div class="flex justify-between p-3 bg-slate-50 rounded-xl">
                        <span class="text-slate-500">Tanpa Keterangan (Alpha)</span>
                        <span class="text-slate-800">{{ $absentDays }} Hari</span>
                    </div>
                </div>
            </div>

            <!-- Sign-offs -->
            <div class="text-center space-y-16 pt-4">
                <div>
                    <p class="text-slate-400 font-semibold text-xs">Orang Tua / Wali</p>
                </div>
                <div class="border-b border-dashed border-slate-300 w-40 mx-auto"></div>
            </div>

            <div class="text-center space-y-16 pt-4">
                <div>
                    <p class="text-slate-400 font-semibold text-xs">Wali Kelas</p>
                </div>
                <div class="border-b border-dashed border-slate-300 w-40 mx-auto"></div>
            </div>
        </div>

    </div>

</div>

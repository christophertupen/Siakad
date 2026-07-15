<div class="w-full">

    @if($activeTab === 'kanban')
        <!-- ==========================================
             KANBAN VIEW
             ========================================== -->
        <div class="space-y-10">
            <!-- Header Section -->
            <div class="flex justify-between items-end mb-10 relative text-left">
                <div>
                    <h1 class="text-4xl font-extrabold text-on-surface mb-2">Assignments Board</h1>
                    <p class="text-sm text-on-surface-variant max-w-xl">Kelola tugas akademik Anda dengan alur kerja Kanban yang terstruktur. Pantau tenggat waktu dan progres penyelesaian.</p>
                </div>
                <div class="flex gap-3">
                    <button class="flex items-center gap-2 px-6 py-3 bg-surface-container-highest text-on-surface-variant rounded-xl font-bold text-sm transition-all hover:bg-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">filter_list</span>
                        Filter
                    </button>
                </div>
            </div>

            <!-- Toast alert for success message -->
            @if(session()->has('success'))
                <div class="bg-success/15 border border-success/30 text-success p-4 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- KANBAN BOARD -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- COLUMN: TO DO -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center justify-between px-2 text-left">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-6 bg-primary rounded-full"></div>
                            <h2 class="text-lg font-bold">To Do</h2>
                            <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-primary">{{ $todoTugas->count() }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        @forelse($todoTugas as $t)
                            <div wire:click="selectTugas({{ $t->id }})" class="glass-card p-6 rounded-3xl group cursor-pointer transition-all hover:-translate-y-1 hover:shadow-xl bg-white border border-slate-200/50 text-left">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="px-3 py-1 bg-primary/10 text-primary rounded-lg text-[10px] font-bold uppercase">{{ $t->mataPelajaran?->nama }}</span>
                                    <span class="text-error font-semibold text-xs flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                                        {{ $t->deadline ? $t->deadline->diffForHumans(null, true) : '-' }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-lg mb-2 group-hover:text-primary transition-colors leading-tight">{{ $t->judul }}</h3>
                                <p class="text-xs text-on-surface-variant mb-6 line-clamp-2">{{ $t->deskripsi }}</p>
                                <div class="flex justify-end pt-4 border-t border-glass-stroke">
                                    <span class="text-[10px] font-bold text-primary hover:underline flex items-center gap-1">Upload Tugas →</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic py-6">Tidak ada tugas dalam antrean</p>
                        @endforelse
                    </div>
                </div>

                <!-- COLUMN: IN PROGRESS -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center justify-between px-2 text-left">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-6 bg-tertiary rounded-full"></div>
                            <h2 class="text-lg font-bold">In Progress</h2>
                            <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-tertiary-container">{{ $inProgressTugas->count() }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        @forelse($inProgressTugas as $t)
                            <div wire:click="selectTugas({{ $t->id }})" class="glass-card p-6 rounded-3xl group cursor-pointer transition-all hover:-translate-y-1 border-l-4 border-l-tertiary bg-white border border-slate-200/50 text-left">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="px-3 py-1 bg-tertiary/10 text-tertiary rounded-lg text-[10px] font-bold uppercase">{{ $t->mataPelajaran?->nama }}</span>
                                    <span class="text-error font-black text-xs flex items-center gap-1 animate-pulse">
                                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                                        Mendesak!
                                    </span>
                                </div>
                                <h3 class="font-bold text-lg mb-2 leading-tight">{{ $t->judul }}</h3>
                                <p class="text-xs text-on-surface-variant mb-6 line-clamp-2">{{ $t->deskripsi }}</p>
                                <div class="flex justify-end pt-4 border-t border-glass-stroke">
                                    <span class="text-[10px] font-bold text-tertiary hover:underline flex items-center gap-1">Kerjakan Sekarang →</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic py-6">Tidak ada tugas tenggat waktu dekat</p>
                        @endforelse
                    </div>
                </div>

                <!-- COLUMN: DONE -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center justify-between px-2 text-left">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-6 bg-success rounded-full"></div>
                            <h2 class="text-lg font-bold">Done</h2>
                            <span class="px-3 py-1 bg-surface-container-high rounded-full text-xs font-bold text-success">{{ $doneTugas->count() }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 opacity-80">
                        @forelse($doneTugas as $t)
                            <div wire:click="selectTugas({{ $t->id }})" class="glass-card p-6 rounded-3xl group cursor-pointer transition-all hover:-translate-y-1 bg-white border border-slate-200/50 text-left">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="px-3 py-1 bg-success/10 text-success rounded-lg text-[10px] font-bold uppercase">{{ $t->mataPelajaran?->nama }}</span>
                                    <span class="w-8 h-8 rounded-full bg-success/20 text-success flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check</span>
                                    </span>
                                </div>
                                <h3 class="font-bold text-lg mb-2 line-through text-slate-400 leading-tight">{{ $t->judul }}</h3>
                                <div class="flex justify-between items-center pt-4 border-t border-glass-stroke text-xs">
                                    <span class="text-success font-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">check_circle</span> Terkumpul
                                    </span>
                                    @if(isset($t->submission) && $t->submission->nilai)
                                        <span class="font-black text-primary">Nilai: {{ $t->submission->nilai }}</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic py-6">Belum ada tugas diselesaikan</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

    @elseif($activeTab === 'detail')
        <!-- ==========================================
             DETAIL VIEW
             ========================================== -->
        <div class="space-y-8 text-left">
            <!-- Breadcrumb -->
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-2 text-outline text-xs font-semibold">
                        <button wire:click="backToKanban" class="hover:text-primary transition-colors">Tugas</button>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="text-on-surface font-black">{{ $selectedTugas->judul }}</span>
                    </div>
                    <h2 class="text-3xl font-extrabold tracking-tight mt-2">{{ $selectedTugas->judul }}</h2>
                </div>
                
                <div class="flex gap-3">
                    @if($selectedSubmission)
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-success/10 text-success text-xs font-bold border border-success/20">
                            <span class="material-symbols-outlined text-[18px] mr-2" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            Telah Terkumpul
                        </span>
                        @if($selectedSubmission->nilai)
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold border border-primary/20">
                                <span class="material-symbols-outlined text-[18px] mr-2">grade</span>
                                Nilai: {{ $selectedSubmission->nilai }}/100
                            </span>
                        @endif
                    @else
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-error/10 text-error text-xs font-bold border border-error/20">
                            <span class="material-symbols-outlined text-[18px] mr-2">warning</span>
                            Belum Mengumpulkan
                        </span>
                    @endif
                </div>
            </div>

            <!-- Detail Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- Left: Task Info & Timeline (8 Columns) -->
                <div class="lg:col-span-8 flex flex-col gap-6">
                    
                    <!-- Instructions -->
                    <section class="glass-card p-8 bg-white border border-slate-200/50">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-3xl">description</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Instruksi Tugas</h3>
                                <p class="text-xs text-outline font-medium">Batas Pengumpulan: {{ $selectedTugas->deadline ? $selectedTugas->deadline->format('l, d M Y - H:i') : 'Tanpa batas' }}</p>
                            </div>
                        </div>
                        <div class="text-sm leading-relaxed text-on-surface-variant space-y-4">
                            <p>{{ $selectedTugas->deskripsi ?: 'Tidak ada instruksi tambahan.' }}</p>
                        </div>
                    </section>

                    <!-- Attachments -->
                    @if($selectedTugas->file_tugas)
                        <section class="glass-card p-8 bg-white border border-slate-200/50">
                            <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">attach_file</span>
                                Lampiran Soal
                            </h3>
                            <div class="flex items-center justify-between p-4 rounded-2xl border border-outline-variant/30 hover:bg-slate-50 transition-all cursor-pointer group">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-error-container/20 flex items-center justify-center text-error">
                                        <span class="material-symbols-outlined">picture_as_pdf</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold">File_Tugas_Pendukung.pdf</p>
                                    </div>
                                </div>
                                <a href="/storage/{{ $selectedTugas->file_tugas }}" target="_blank" class="p-2 text-outline hover:text-primary transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined">download</span>
                                </a>
                            </div>
                        </section>
                    @endif

                    <!-- Timeline Comments -->
                    <section class="glass-card p-8 bg-white border border-slate-200/50">
                        <h3 class="text-lg font-bold mb-8">Riwayat Penilaian & Komentar</h3>
                        <div class="relative pl-8 space-y-10">
                            <div class="absolute left-[11px] top-2 bottom-0 w-[2px] bg-slate-100"></div>
                            
                            @if($selectedSubmission && $selectedSubmission->nilai)
                                <div class="relative">
                                    <div class="absolute -left-10 w-6 h-6 rounded-full bg-success flex items-center justify-center border-4 border-white shadow-sm z-10">
                                        <span class="material-symbols-outlined text-[12px] text-white" style="font-variation-settings: 'FILL' 1;">check</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-on-surface">Dinilai oleh Guru</p>
                                        <p class="text-xs text-outline mb-3">{{ $selectedSubmission->updated_at->format('d M Y - H:i') }}</p>
                                        <div class="p-4 rounded-2xl bg-success/5 border border-success/20 italic text-sm text-slate-700">
                                            "{{ $selectedSubmission->catatan ?: 'Hasil evaluasi tugas dinilai memuaskan.' }}"
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($selectedSubmission)
                                <div class="relative">
                                    <div class="absolute -left-10 w-6 h-6 rounded-full bg-primary flex items-center justify-center border-4 border-white shadow-sm z-10">
                                        <span class="material-symbols-outlined text-[12px] text-white" style="font-variation-settings: 'FILL' 1;">file_upload</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-on-surface">Mengirimkan File Jawaban</p>
                                        <p class="text-xs text-outline mb-3">{{ $selectedSubmission->tanggal_pengumpulan->format('d M Y - H:i') }}</p>
                                        <a href="/storage/{{ $selectedSubmission->file_jawaban }}" target="_blank" class="mt-2 flex items-center gap-2 p-3 rounded-xl border border-glass-stroke bg-slate-50 w-fit text-primary font-bold text-xs hover:underline">
                                            <span class="material-symbols-outlined text-sm">description</span>
                                            Lihat File Terkirim
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="relative">
                                <div class="absolute -left-10 w-6 h-6 rounded-full bg-outline-variant flex items-center justify-center border-4 border-white shadow-sm z-10"></div>
                                <div>
                                    <p class="font-bold text-sm text-outline">Tugas Dirilis</p>
                                    <p class="text-xs text-outline">{{ $selectedTugas->created_at->format('d M Y - H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

                <!-- Right: Submission Form (4 Columns) -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    
                    <section class="glass-card p-8 flex flex-col items-center bg-white border border-slate-200/50">
                        <h3 class="text-lg font-bold mb-6 self-start w-full">Unggah File Jawaban</h3>
                        
                        <form wire:submit.prevent="submitTugas" class="w-full space-y-4">
                            <div class="relative w-full border-2 border-dashed border-slate-200 rounded-2xl p-6 bg-slate-50 hover:bg-slate-100/50 transition-colors flex flex-col items-center justify-center text-center cursor-pointer">
                                <input type="file" wire:model="fileJawaban" class="absolute inset-0 opacity-0 cursor-pointer"/>
                                <span class="material-symbols-outlined text-primary text-4xl mb-2">cloud_upload</span>
                                <p class="text-xs font-bold text-slate-700">Pilih file atau seret ke sini</p>
                                <p class="text-[10px] text-slate-400">PDF, DOCX, ZIP (Maks. 25MB)</p>
                            </div>
                            @error('fileJawaban') 
                                <span class="text-xs text-error font-semibold block">{{ $message }}</span> 
                            @enderror

                            <!-- Loading progress -->
                            <div wire:loading wire:target="fileJawaban" class="text-xs text-primary font-bold animate-pulse text-center w-full">
                                Mengunggah berkas, mohon tunggu...
                            </div>

                            <div class="space-y-1">
                                <label class="text-xs font-bold text-slate-600">Catatan untuk Guru (Opsional)</label>
                                <textarea wire:model="catatan" rows="3" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary" placeholder="Tulis catatan jika ada..."></textarea>
                            </div>

                            <button type="submit" class="w-full h-14 bg-primary hover:bg-blue-600 text-white rounded-2xl font-bold flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                                <span class="material-symbols-outlined">send</span>
                                Kirim Tugas
                            </button>
                        </form>
                    </section>

                </div>

            </div>
        </div>
    @endif

</div>

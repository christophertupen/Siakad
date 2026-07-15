<div class="w-full space-y-8" x-data="{ semesterFilter: 'all', categoryFilter: 'all' }">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="text-left">
            <h1 class="text-3xl md:text-5xl font-extrabold text-on-surface">Learning Library</h1>
            <p class="text-lg text-on-surface-variant max-w-2xl mt-2">Akses seluruh materi pembelajaran, buku panduan, dan modul interaktif dalam satu tempat terpusat kelas {{ $activeKelasName }}.</p>
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
            <div class="relative">
                <select x-model="categoryFilter" class="appearance-none bg-white border border-outline-variant rounded-2xl py-2.5 pl-4 pr-10 text-sm font-semibold focus:ring-2 focus:ring-primary/20 cursor-pointer">
                    <option value="all">Semua Kategori</option>
                    <option value="Science">Sains & Eksakta</option>
                    <option value="Social">Sosial & Humaniora</option>
                    <option value="Language">Bahasa</option>
                </select>
            </div>
            <button class="bg-primary text-white font-bold text-sm px-6 py-2.5 rounded-2xl hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">filter_list</span>
                Terapkan
            </button>
        </div>
    </div>

    <!-- Materials Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($materis as $m)
            <!-- Material Card -->
            <div class="glass-card rounded-3xl p-6 group hover:-translate-y-2 transition-all duration-300 flex flex-col cursor-pointer overflow-hidden relative bg-white border border-slate-200/50">
                <div class="w-full h-44 rounded-2xl mb-5 overflow-hidden relative bg-slate-100">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBgRRAbQ5erTZ9BVpyuM1ewavuQ0SaT-ocBLoZzL7gQCCqgIODtgAhAtIHh3iT4Zx-3BKw7xOEwZKc_mrsHjm1qsrP2AfeRQWY9VbxOTxuzpWXN1Hu4eJQCBjcC8c4fFm1dNj1YqzHNMuU_CSg5omJm3FPfP01_lTjaJoHadLqm-2diRZdUfOTpzuBkO2rsc9LXZGcPhMULxhmBso-q2fz4GK4XwodukKBH15mrqje594YyZP7B5L-" 
                         alt="Cover"/>
                    <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-extrabold text-primary uppercase">
                        {{ $m->mataPelajaran?->nama }}
                    </div>
                </div>
                
                <div class="flex-1 text-left">
                    <div class="flex justify-between items-start mb-2 gap-2">
                        <h3 class="font-bold text-lg group-hover:text-primary transition-colors leading-tight">{{ $m->judul }}</h3>
                        <span class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </div>
                    <p class="text-sm text-on-surface-variant mb-6 line-clamp-3">{{ $m->deskripsi ?: 'Tidak ada deskripsi tambahan.' }}</p>
                </div>
                
                <div class="border-t border-glass-stroke pt-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center overflow-hidden border">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA0xIuSZmzxunAxBNGvTzd3EsBBaZMau1wSltO-QKD-LNPqmI21_mAMbyuq4uNheDhhYn-MMmbmQONdvDcduw2yhoM1HA-xk4E80SNVOFErVqYAWntOLszEPNdA9pEuYu0F5689UxbZ97cJTU1fUSfkMPRsy307XoGs1zqga9OPV7ZmQY3l-dIEkx6EvM7C8O4nbpz35p1ykkq7IjRuQ6pyda5IfVCVxIUJ-ps8c3tGy8Z2j5BkwZCT" alt="Teacher"/>
                        </div>
                        <span class="text-xs font-semibold text-slate-700">{{ $m->guru?->nama }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="/storage/{{ $m->file }}" target="_blank" class="bg-primary/10 hover:bg-primary hover:text-white p-2 rounded-xl text-primary transition-all flex items-center justify-center">
                            <span class="material-symbols-outlined text-sm">download</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
                <div class="w-48 h-48 mb-6">
                    <img class="w-full h-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCny9TjDOjuqeZHAYtWXPkF60C6msemj6H4trLqUlVM0VVMqrS5f4M_QYdsUiGS_9MHFazlI1IAYcltRV367G8sKFcJQpO2rbR1NFG8v1ZYStYdgJR2FOub_VKSm6ax4OpmS6wmGZ9aBfNBX7duO-3kYpB5Qcnmj-MdEmP-E73VjWjw2Vq853V6O8g5q3CM1BFQszaWLRQ6hW6MUZaUFvRn68uykmDVhl_YF77kO5EQqpXPNc_OqA_f" alt="Empty"/>
                </div>
                <h3 class="font-extrabold text-xl mb-1 text-slate-800">Materi Belum Tersedia</h3>
                <p class="text-sm text-slate-500">Guru belum membagikan modul pembelajaran untuk kelasmu.</p>
            </div>
        @endforelse
    </div>

</div>

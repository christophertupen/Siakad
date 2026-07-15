<div class="w-full space-y-8 text-left">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Pengaturan</h2>
            <p class="text-lg text-on-surface-variant">Konfigurasi preferensi sistem, pemberitahuan, dan tampilan portal Anda.</p>
        </div>
    </div>

    <!-- Alert success notifications -->
    @if(session()->has('success_settings'))
        <div class="bg-success/15 border border-success/30 text-success p-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="text-sm font-semibold">{{ session('success_settings') }}</span>
        </div>
    @endif

    <div class="max-w-3xl bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm space-y-8">
        
        <form wire:submit.prevent="saveSettings" class="space-y-8">
            <!-- Notifications Config -->
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">notifications</span>
                    Pemberitahuan & Notifikasi
                </h3>
                <div class="space-y-4">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" wire:model="email_notification" class="rounded border-slate-200 text-primary focus:ring-primary/20 h-5 w-5"/>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Email Update Akademis</p>
                            <p class="text-xs text-slate-400">Kirim email otomatis saat guru membagikan nilai atau tugas baru.</p>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" wire:model="whatsapp_notification" class="rounded border-slate-200 text-primary focus:ring-primary/20 h-5 w-5"/>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Notifikasi WhatsApp</p>
                            <p class="text-xs text-slate-400">Terima reminder pengumuman penting langsung ke ponsel Anda.</p>
                        </div>
                    </label>
                </div>
            </div>

            <hr class="border-slate-100"/>

            <!-- Language and Theme -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">language</span>
                    Bahasa & Preferensi Regional
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">Bahasa Portal</label>
                        <select wire:model="language" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary cursor-pointer">
                            <option value="id">Bahasa Indonesia</option>
                            <option value="en">English (US)</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">Tema Visual</label>
                        <select wire:model="appearance" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary cursor-pointer">
                            <option value="light">Light Mode (Terang)</option>
                            <option value="dark">Dark Mode (Gelap)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-6 py-3 bg-primary hover:bg-blue-600 text-white rounded-xl font-bold text-sm shadow-md shadow-primary/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    Simpan Pengaturan
                </button>
            </div>
        </form>

    </div>

</div>

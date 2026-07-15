<div class="w-full space-y-8 text-left">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Profil Wali Murid</h2>
            <p class="text-lg text-on-surface-variant">Lengkapi detail data pribadi, nomor kontak, serta atur keamanan kata sandi Anda.</p>
        </div>
    </div>

    <!-- Alert success notifications -->
    @if(session()->has('success_profile'))
        <div class="bg-success/15 border border-success/30 text-success p-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="text-sm font-semibold">{{ session('success_profile') }}</span>
        </div>
    @endif
    @if(session()->has('success_password'))
        <div class="bg-success/15 border border-success/30 text-success p-4 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="text-sm font-semibold">{{ session('success_password') }}</span>
        </div>
    @endif

    <!-- Profile Forms Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Personal Information (8 Columns) -->
        <div class="lg:col-span-8 bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm">
            <h3 class="text-xl font-bold mb-6">Informasi Wali Murid</h3>
            
            <form wire:submit.prevent="updateProfile" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                        @error('nama') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">Alamat Email</label>
                        <input type="email" wire:model="email" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                        @error('email') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <!-- NIK -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" wire:model="nik" readonly class="w-full rounded-xl border border-slate-100 bg-slate-50 text-slate-500 text-sm cursor-not-allowed"/>
                    </div>

                    <!-- Hubungan -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">Hubungan Keluarga</label>
                        <input type="text" wire:model="hubungan" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                        @error('hubungan') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <!-- Pekerjaan -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">Pekerjaan</label>
                        <input type="text" wire:model="pekerjaan" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                        @error('pekerjaan') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <!-- Telepon -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-600">Nomor Telepon</label>
                        <input type="text" wire:model="nomor_telepon" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                        @error('nomor_telepon') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Alamat -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-600">Alamat Rumah</label>
                    <textarea wire:model="alamat" rows="4" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"></textarea>
                    @error('alamat') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-primary hover:bg-blue-600 text-white rounded-xl font-bold text-sm shadow-md shadow-primary/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Change Password (4 Columns) -->
        <div class="lg:col-span-4 bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm">
            <h3 class="text-xl font-bold mb-6">Ubah Kata Sandi</h3>
            
            <form wire:submit.prevent="updatePassword" class="space-y-6">
                <!-- Current Password -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-600">Kata Sandi Saat Ini</label>
                    <input type="password" wire:model="current_password" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                    @error('current_password') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- New Password -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-600">Kata Sandi Baru</label>
                    <input type="password" wire:model="new_password" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                    @error('new_password') <span class="text-xs text-error font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-600">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" wire:model="new_password_confirmation" class="w-full rounded-xl border border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                </div>

                <button type="submit" class="w-full h-12 bg-slate-800 hover:bg-slate-700 text-white rounded-xl font-bold text-sm transition-all hover:scale-[1.02] active:scale-[0.98]">
                    Ubah Kata Sandi
                </button>
            </form>
        </div>

    </div>

</div>

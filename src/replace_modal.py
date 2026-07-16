import sys

file_path = "resources/views/landing/home.blade.php"
with open(file_path, "r") as f:
    content = f.read()

start_marker = "<!-- ============================================ -->\n    <!--          PORTAL AKADEMIK MODAL (AlpineJS)    -->"
end_marker = "</body>"

start_idx = content.find(start_marker)
end_idx = content.find(end_marker)

if start_idx == -1 or end_idx == -1:
    print("Could not find markers")
    sys.exit(1)

new_modal = """<!-- ============================================ -->
    <!--          REGISTRASI AKUN MODAL (AlpineJS)    -->
    <!-- ============================================ -->
    <div x-show="modalOpen" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;"
         x-transition:opacity.duration.300ms>
         
        <!-- Backdrop overlay -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="modalOpen = false; step = 1; role = '';"></div>

        <!-- Modal Box -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="modalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-lg bg-white rounded-[24px] shadow-2xl p-6 sm:p-8 border border-slate-100 z-10 space-y-6">
                 
                <!-- Close Button -->
                <button @click="modalOpen = false; step = 1; role = '';" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>

                <!-- STEP 1: PILIH ROLE -->
                <div x-show="step === 1" class="space-y-6">
                    <div class="text-center space-y-2">
                        <h3 class="text-2xl font-black text-secondary tracking-tight">Buat Akun Baru</h3>
                        <p class="text-sm text-slate-500 font-sans">Silakan pilih jenis akun yang ingin Anda daftarkan.</p>
                    </div>

                    <div class="space-y-4">
                        <!-- Guru -->
                        <div @click="role = 'guru'; step = 2;" class="cursor-pointer p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <span class="text-3xl">👨‍🏫</span>
                                <div>
                                    <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Guru</h4>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-primary transition-colors"></i>
                        </div>

                        <!-- Siswa -->
                        <div @click="role = 'siswa'; step = 2;" class="cursor-pointer p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <span class="text-3xl">👨‍🎓</span>
                                <div>
                                    <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Siswa</h4>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-primary transition-colors"></i>
                        </div>

                        <!-- Orang Tua -->
                        <div @click="role = 'orang_tua'; step = 2;" class="cursor-pointer p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <span class="text-3xl">👨‍👩‍👦</span>
                                <div>
                                    <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Orang Tua</h4>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-primary transition-colors"></i>
                        </div>

                        <!-- Akademik -->
                        <div @click="role = 'akademik'; step = 2;" class="cursor-pointer p-4 rounded-premium border border-slate-100 hover:border-primary/20 hover:bg-slate-50/50 transition-all flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <span class="text-3xl">🏛️</span>
                                <div>
                                    <h4 class="font-bold text-secondary text-sm group-hover:text-primary transition-colors">Akademik</h4>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-primary transition-colors"></i>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: FORM REGISTRASI -->
                <div x-show="step === 2" class="space-y-6" style="display: none;">
                    <div class="flex items-center gap-4">
                        <button type="button" @click="step = 1; role = '';" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-primary/10 hover:text-primary transition-colors">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <div>
                            <h3 class="text-xl font-black text-secondary tracking-tight">Form Registrasi</h3>
                            <p class="text-xs text-slate-500 font-sans" x-text="'Mendaftar sebagai ' + (role.replace('_', ' ').toUpperCase())"></p>
                        </div>
                    </div>

                    <form id="registrasi-form" class="space-y-4" @submit.prevent="submitRegistrasi($event)">
                        @csrf
                        <input type="hidden" name="role" :value="role">
                        
                        <div id="reg-alert" class="hidden p-4 rounded-premium text-sm"></div>

                        <!-- Nama Lengkap -->
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="Masukkan nama lengkap Anda">
                            <p class="text-xs text-red-500 mt-1 hidden" id="err-name"></p>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="name@example.com">
                            <p class="text-xs text-red-500 mt-1 hidden" id="err-email"></p>
                        </div>

                        <!-- Nomor HP -->
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Nomor HP</label>
                            <input type="text" name="nomor_hp" required class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="Contoh: 0812...">
                            <p class="text-xs text-red-500 mt-1 hidden" id="err-nomor_hp"></p>
                        </div>

                        <!-- Role Specific Fields -->
                        <div x-show="role === 'guru'" class="space-y-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">NIP</label>
                            <input type="text" name="nip" :required="role === 'guru'" class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="Nomor Induk Pegawai">
                            <p class="text-xs text-red-500 mt-1 hidden" id="err-nip"></p>
                        </div>

                        <div x-show="role === 'siswa'" class="space-y-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">NIS</label>
                            <input type="text" name="nis" :required="role === 'siswa'" class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="Nomor Induk Siswa">
                            <p class="text-xs text-red-500 mt-1 hidden" id="err-nis"></p>
                        </div>

                        <div x-show="role === 'orang_tua'" class="space-y-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">NIK</label>
                            <input type="text" name="nik" :required="role === 'orang_tua'" class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="16 Digit NIK">
                            <p class="text-xs text-red-500 mt-1 hidden" id="err-nik"></p>
                        </div>

                        <div x-show="role === 'akademik'" class="space-y-1">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">NIP Staff</label>
                            <input type="text" name="nip_staff" :required="role === 'akademik'" class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="Nomor Induk Pegawai Staff">
                            <p class="text-xs text-red-500 mt-1 hidden" id="err-nip_staff"></p>
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Password</label>
                                <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="Min. 8 karakter">
                                <p class="text-xs text-red-500 mt-1 hidden" id="err-password"></p>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Konfirmasi</label>
                                <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-premium border border-slate-200 focus:outline-none focus:border-primary text-sm transition-all" placeholder="Ulangi password">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" id="reg-submit-btn" class="w-full py-3 rounded-premium bg-primary text-white font-bold hover:bg-blue-700 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                                <span>Ajukan Pendaftaran</span>
                                <i id="reg-spinner" class="fa-solid fa-spinner animate-spin hidden"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitRegistrasi(event) {
            const form = event.target;
            const submitBtn = document.getElementById('reg-submit-btn');
            const spinner = document.getElementById('reg-spinner');
            const alertBox = document.getElementById('reg-alert');
            
            // Clear previous errors
            alertBox.classList.add('hidden');
            alertBox.className = 'p-4 rounded-premium text-sm hidden';
            const errorFields = [
                'err-name', 'err-email', 'err-password', 'err-nomor_hp', 'err-nip', 'err-nis', 'err-nik', 'err-nip_staff'
            ];
            errorFields.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.classList.add('hidden');
                    el.innerText = '';
                }
            });

            submitBtn.disabled = true;
            spinner.classList.remove('hidden');

            const formData = new FormData(form);

            fetch("{{ route('registrasi.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    alertBox.classList.remove('hidden');
                    alertBox.className = 'p-4 rounded-premium text-sm bg-green-100 text-green-800 border border-green-200';
                    alertBox.innerText = data.message;
                    form.reset();
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('close-modal'));
                    }, 3000);
                } else {
                    alertBox.classList.remove('hidden');
                    alertBox.className = 'p-4 rounded-premium text-sm bg-red-100 text-red-800 border border-red-200';
                    alertBox.innerText = data.message || 'Terjadi kesalahan. Silakan periksa kembali isian Anda.';
                    
                    if (data.errors) {
                        for (const [key, messages] of Object.entries(data.errors)) {
                            const errEl = document.getElementById(`err-${key}`);
                            if (errEl) {
                                errEl.innerText = messages[0];
                                errEl.classList.remove('hidden');
                            }
                        }
                    }
                }
            })
            .catch(error => {
                alertBox.classList.remove('hidden');
                alertBox.className = 'p-4 rounded-premium text-sm bg-red-100 text-red-800 border border-red-200';
                alertBox.innerText = 'Terjadi kesalahan jaringan. Silakan coba lagi.';
                console.error(error);
            })
            .finally(() => {
                submitBtn.disabled = false;
                spinner.classList.add('hidden');
            });
        }
    </script>

"""

new_content = content[:start_idx] + new_modal + content[end_idx:]

with open(file_path, "w") as f:
    f.write(new_content)

print("Replaced modal section successfully")

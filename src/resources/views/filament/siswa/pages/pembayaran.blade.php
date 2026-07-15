<div class="w-full space-y-8 text-left">

    <!-- Page Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-on-surface mb-2">Portal Pembayaran</h2>
            <p class="text-lg text-on-surface-variant">Lacak status tagihan sekolah, riwayat pembayaran, dan lakukan transaksi via Midtrans secara instan.</p>
        </div>
    </div>

    <!-- Quick Stats Bento Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Tagihan -->
        <div class="glass-card rounded-3xl p-8 relative overflow-hidden bg-white border border-slate-200/50">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-error"></div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Total Tagihan Belum Dibayar</p>
                <h3 class="text-4xl font-extrabold text-on-surface mb-2">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</h3>
                <p class="text-xs text-on-surface-variant font-semibold">Harap selesaikan pembayaran sebelum jatuh tempo.</p>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <span class="material-symbols-outlined text-9xl">receipt_long</span>
            </div>
        </div>

        <!-- Total Terbayar -->
        <div class="glass-card rounded-3xl p-8 relative overflow-hidden bg-white border border-slate-200/50">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-success"></div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-outline uppercase tracking-wider mb-1">Total Terbayar Semester Ini</p>
                <h3 class="text-4xl font-extrabold text-on-surface mb-2">Rp {{ number_format($totalTerbayar, 0, ',', '.') }}</h3>
                <p class="text-success flex items-center gap-1 text-xs font-semibold">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Semua transaksi terverifikasi sistem
                </p>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <span class="material-symbols-outlined text-9xl">payments</span>
            </div>
        </div>
    </div>

    <!-- Invoice Table -->
    <div class="bg-white border border-slate-200/50 rounded-[32px] p-8 shadow-sm">
        <h3 class="text-xl font-bold mb-6">Daftar Tagihan & Riwayat Transaksi</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-slate-400 uppercase text-[11px] font-black tracking-wider">
                        <th class="py-3 px-4">No. Transaksi</th>
                        <th class="py-3 px-4">Kategori / Item</th>
                        <th class="py-3 px-4 text-center">Bulan</th>
                        <th class="py-3 px-4 text-right">Total</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pembayarans as $p)
                        <tr class="hover:bg-slate-50/55 transition-colors font-semibold text-slate-700">
                            <td class="py-4 px-4 font-mono text-xs">{{ $p->midtrans_order_id ?? 'INV-'.$p->id }}</td>
                            <td class="py-4 px-4">
                                <p class="text-slate-800 font-bold">{{ $p->kategori }}</p>
                                <p class="text-[10px] text-slate-400 font-medium">{{ $p->jenis_item }} {{ $p->ukuran ? '('.$p->ukuran.')' : '' }}</p>
                            </td>
                            <td class="py-4 px-4 text-center">{{ $p->bulan ?: '-' }}</td>
                            <td class="py-4 px-4 text-right font-extrabold text-slate-800">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                            <td class="py-4 px-4 text-center">
                                @if($p->status === 'Lunas')
                                    <span class="inline-flex px-2.5 py-1 bg-success/10 text-success rounded-lg text-xs font-black">Lunas</span>
                                @elseif($p->status === 'Pending')
                                    <span class="inline-flex px-2.5 py-1 bg-warning/10 text-warning rounded-lg text-xs font-black">Pending</span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 bg-error/10 text-error rounded-lg text-xs font-black">Gagal</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if($p->status === 'Pending')
                                    <a href="{{ route('midtrans.pay', $p->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary hover:bg-blue-600 text-white rounded-xl text-xs font-bold shadow-md shadow-primary/10 transition-all">
                                        <span class="material-symbols-outlined text-sm">payment</span>
                                        Bayar Sekarang
                                    </a>
                                @else
                                    <button disabled class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 text-slate-400 rounded-xl text-xs font-bold cursor-not-allowed">
                                        <span class="material-symbols-outlined text-sm">check_circle</span>
                                        Selesai
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400 italic">Belum ada riwayat tagihan terdaftar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

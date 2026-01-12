<div class="min-h-screen bg-slate-200 flex items-center justify-center p-4">
    <div class="bg-[#0b0b45] text-white rounded-[3rem] w-full max-w-lg shadow-2xl border border-white/10 p-10">
        <h2 class="text-2xl font-bold mb-2 text-center">Data Pelanggan</h2>
        <p class="text-white/50 text-xs uppercase tracking-widest text-center mb-8">Lengkapi detail pemesanan Anda</p>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 mb-8 text-sm">
            <div class="flex justify-between border-b border-white/5 pb-2 mb-2">
                <span class="text-white/40">Paket</span>
                <span class="font-bold text-amber-500">{{ $paket->nama_layanan }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-white/40">Waktu</span>
                <span>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }} | {{ $jadwal->jam_mulai }}</span>
            </div>
        </div>

        <div class="space-y-5">
            <div>
                <label class="text-[10px] text-white/40 uppercase tracking-widest ml-1 mb-2 block">Nama Lengkap</label>
                <input type="text" wire:model="nama_pelanggan" placeholder="Nama sesuai KTP..."
                    class="w-full bg-[#0b0b45] border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-amber-500 outline-none transition-all">
                @error('nama_pelanggan') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-[10px] text-white/40 uppercase tracking-widest ml-1 mb-2 block">Nomor
                    WhatsApp</label>
                <input type="text" wire:model="no_wa" placeholder="08XXXXXXXXXX"
                    class="w-full bg-[#0b0b45] border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-amber-500 outline-none transition-all">
                @error('no_wa') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
            </div>

            {{-- Kolom Tambahan Orang (Dropdown) --}}
            <div class="mt-5">
                <label class="text-[10px] text-white/40 uppercase tracking-widest ml-1 mb-2 block">Tambahan
                    Orang</label>
                <div class="relative">
                    <select wire:model="jumlah_orang"
                        class="w-full bg-[#0b0b45] border border-white/10 rounded-xl px-4 py-3 text-sm focus:border-amber-500 outline-none transition-all appearance-none text-white cursor-pointer">
                        <option value="0">Tidak ada tambahan (Sesuai Paket)</option>
                        <option value="1">+ 1 Orang</option>
                        <option value="2">+ 2 Orang</option>
                        <option value="3">+ 3 Orang</option>
                        <option value="4">+ 4 Orang</option>
                        <option value="5">+ 5 Orang</option>
                    </select>
                </div>
                @error('jumlah_orang') <span class="text-red-400 text-[10px]">{{ $message }}</span> @enderror
            </div>

            <button wire:click="confirmBooking"
                class="w-full bg-amber-500 hover:bg-amber-400 text-[#0b0b45] py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-2xl transition-all active:scale-95 mt-4">
                Konfirmasi Pembayaran →
            </button>

            <a href="{{ route('home') }}"
                class="block text-center text-white/30 text-[10px] uppercase hover:text-white transition-all mt-4">Batal
                & Kembali</a>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" 
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('pay-with-midtrans', (event) => {
            // Livewire v3 menggunakan array/objek pertama sebagai data
            const data = Array.isArray(event) ? event[0] : event;
            const snapToken = data.snapToken;

            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    // ARAHKAN KE CONTROLLER FINISH
                    // Kita kirim order_id hasil dari Midtrans (contoh: DW-10-123456)
                    window.location.href = "/booking/finish?order_id=" + result.order_id;
                },
                onPending: function(result) {
                    alert("Menunggu Pembayaran. Silakan cek aplikasi/email Anda.");
                },
                onError: function(result) {
                    alert("Pembayaran Gagal!");
                    window.location.reload();
                },
                onClose: function() {
                    alert('Anda menutup jendela pembayaran sebelum selesai.');
                }
            });
        });
    });
</script>
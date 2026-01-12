<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Berhasil!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#0b0b45] min-h-screen flex items-center justify-center p-4">
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 p-10 rounded-[3rem] text-center max-w-md w-full shadow-2xl">
        
        <div class="success-animation mb-6">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </div>

        <h1 class="text-3xl font-black text-white mb-2 uppercase tracking-tighter">Booking Berhasil!</h1>
        <p class="text-white/60 text-sm mb-8">Terima kasih telah melakukan pembayaran. Silahkan konfirmasi kepada admin whatsapp.</p>

        <div class="bg-black/20 rounded-2xl p-4 mb-8 text-left border border-white/5 space-y-2">
            <div class="flex justify-between text-xs mb-2">
                <span class="text-white/40">ID Pesanan</span>
                <span class="text-white font-mono">#{{ $pemesanan->id_pemesanan }}</span>
            </div>
            <div class="flex justify-between text-xs border-b border-white/5 pb-2">
                <span class="text-white/40">Nama Pelanggan</span>
                <span class="text-white font-bold uppercase">{{ $pemesanan->pelanggan->nama }}</span>
            </div>
            <div class="flex justify-between text-xs border-b border-white/5 pb-2">
                <span class="text-white/40">No. WhatsApp</span>
                <span class="text-white">{{ $pemesanan->pelanggan->whatsapp }}</span>
            </div>
            <div class="flex justify-between text-xs border-b border-white/5 pb-2">
                <span class="text-white/40">Jenis Paket</span>
                <span class="text-amber-500 font-bold uppercase">{{ $pemesanan->layanan->nama_layanan ?? 'Paket Studio' }}</span>
            </div>
            <div class="flex justify-between text-xs">
                <span class="text-white/40">Total Bayar</span>
                <span class="text-amber-500 font-bold">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        @php
            $pesanWA = "Halo Admin, saya telah melakukan pembayaran untuk:" . 
                       "\n\n*ID Pesanan:* #" . $pemesanan->id_pemesanan . 
                       "\n*Nama:* " . $pemesanan->pelanggan->nama . 
                       "\n*Paket:* " . ($pemesanan->layanan->nama_layanan ?? 'Paket Studio');
            $linkWA = "https://wa.me/628985292897?text=" . urlencode($pesanWA);
        @endphp

        <a href="{{ $linkWA }}" target="_blank"
            class="flex items-center justify-center gap-3 w-full bg-[#25D366] text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#128C7E] transition-all shadow-lg shadow-green-500/20 mb-4">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.938 3.659 1.434 5.628 1.435h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Konfirmasi ke WhatsApp
        </a>

        <a href="{{ route('home') }}"
            class="block w-full border border-white/20 text-white/70 py-4 rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-white/10 hover:text-white transition-all">
            Kembali ke Beranda
        </a>

    </div>
</body>

</html>
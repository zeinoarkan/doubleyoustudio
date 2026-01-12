@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4">Data Pesanan</h1>
    </div>

    {{-- Tabel Pesanan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">No</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Layanan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Jadwal Booking</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($pesanan as $item)
                    <tr class="hover:bg-blue-50/50 transition-colors">
                        {{-- No --}}
                        <td class="px-6 py-4 text-sm text-center text-gray-500 font-medium">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Pelanggan --}}
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $item->pelanggan->nama ?? '-' }}</div>
                            <div class="text-xs text-gray-400">ID: #{{ $item->id_pemesanan }}</div>
                        </td>

                        {{-- Layanan --}}
                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                            {{ $item->layanan->nama_layanan ?? '-' }}
                        </td>

                        {{-- Kontak --}}
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <a href="https://wa.me/{{ $item->pelanggan->whatsapp ?? '' }}" target="_blank" class="flex items-center gap-1 text-green-600 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.483 8.413-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.308 1.654zm6.749-3.336l.326.193c1.4.832 3.04 1.271 4.718 1.272l.012.002c5.44 0 9.868-4.427 9.87-9.869.001-2.638-1.028-5.117-2.898-6.988s-4.352-2.899-6.99-2.899c-5.442 0-9.87 4.429-9.872 9.87-.001 1.742.459 3.441 1.332 4.922l.213.356-.995 3.636 3.731-.977zm11.367-7.384c-.312-.156-1.848-.912-2.134-1.017-.286-.105-.494-.156-.703.156s-.807 1.017-.989 1.225-.364.234-.676.078c-.312-.156-1.318-.486-2.511-1.549-.928-.827-1.554-1.849-1.736-2.161-.182-.312-.019-.481.137-.636.141-.14.312-.364.468-.546s.208-.312.312-.52c.104-.208.052-.39-.026-.546s-.703-1.693-.963-2.315c-.253-.604-.512-.522-.703-.532-.182-.01-.39-.012-.598-.012s-.546.078-.832.39c-.286.312-1.092 1.067-1.092 2.601s1.118 3.018 1.274 3.226c.156.208 2.155 3.291 5.22 4.615.729.314 1.298.502 1.742.643.733.233 1.399.199 1.926.121.588-.087 1.848-.755 2.108-1.483.26-.728.26-1.353.182-1.483-.078-.13-.286-.208-.598-.364z"/></svg>
                                <span>{{ $item->pelanggan->whatsapp ?? '-' }}</span>
                            </a>
                        </td>

                        {{-- Jadwal --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 font-medium">
                                {{ \Carbon\Carbon::parse($item->jadwal->tanggal ?? '')->translatedFormat('d M Y') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $item->jadwal->jam_mulai ?? '-' }} - {{ $item->jadwal->jam_selesai ?? '-' }}
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">
                            @php
                                $statusClasses = [
                                    'Selesai' => 'bg-green-100 text-green-700 border-green-200',
                                    'Pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'Batal' => 'bg-red-100 text-red-700 border-red-200',
                                ];
                                $currentStatus = $item->status_pemesanan;
                                $class = $statusClasses[$currentStatus] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold border {{ $class }}">
                                {{ strtoupper($item->status_pemesanan) }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-sm">
                            <div class="flex justify-center items-center gap-4">
                                {{-- Tombol Detail --}}
                                <a href="{{ route('admin.pesanan.show', $item->id_pemesanan) }}" 
                                   class="flex items-center gap-1 text-blue-600 hover:text-blue-800 font-bold transition-colors group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>Detail</span>
                                </a>

                                <span class="text-gray-300">|</span>

                                {{-- Form Hapus --}}
                                <form action="{{ route('admin.pesanan.delete', $item->id_pemesanan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                            class="flex items-center gap-1 text-red-600 hover:text-red-800 font-bold transition-colors group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p>Tidak ada data pesanan ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SCRIPT KONFIRMASI HAPUS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Hapus Pesanan?',
            text: "Data ini akan dihapus secara permanen dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Merah Tailwind
            cancelButtonColor: '#6b7280',  // Abu-abu Tailwind
            confirmButtonText: 'Ya, Hapus Sekarang',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl px-5 py-2.5',
                cancelButton: 'rounded-xl px-5 py-2.5'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form induk dari tombol yang diklik
                button.closest('form').submit();
            }
        })
    }
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false,
        customClass: { popup: 'rounded-2xl' }
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Ups!',
        text: "{{ session('error') }}",
        confirmButtonColor: '#4f46e5',
        customClass: { popup: 'rounded-2xl' }
    });
</script>
@endif

@endsection
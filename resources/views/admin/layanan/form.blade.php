@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Layanan Baru</h1>
            <p class="text-sm text-gray-500">Isi detail layanan dan unggah foto terbaik untuk menarik pelanggan.</p>
        </div>
        <a href="{{ route('admin.layanan') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('admin.layanan.store') }}" enctype="multipart/form-data"
          id="layananForm" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-6">
        @csrf

        {{-- Nama Layanan --}}
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Nama Layanan</label>
            <input type="text" name="nama_layanan" required
                   class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3 border transition-all"
                   placeholder="Contoh: K-Pop Style Haircut">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Harga --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Harga (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">Rp</span>
                    <input type="number" name="harga" required
                           class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 pl-12 pr-4 py-3 border transition-all"
                           placeholder="0">
                </div>
            </div>

            {{-- Durasi --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Durasi (Menit)</label>
                <div class="relative">
                    <input type="number" name="durasi" required
                           class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3 border transition-all"
                           placeholder="Contoh: 60">
                    <span class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 text-sm font-medium">Menit</span>
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3 border transition-all"
                      placeholder="Jelaskan detail apa saja yang didapat pelanggan pada layanan ini..."></textarea>
        </div>

        {{-- Upload Foto dengan Preview --}}
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Foto Layanan</label>
            
            <div id="drop-area" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-indigo-400 hover:bg-indigo-50/30 transition-all group relative overflow-hidden min-h-[200px] items-center">
                
                {{-- Element Preview --}}
                <img id="preview-img" class="absolute inset-0 w-full h-full object-cover hidden z-0">

                {{-- Placeholder Content --}}
                <div id="placeholder-content" class="space-y-2 text-center z-10 relative transition-all">
                    <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600 justify-center">
                        <label for="file-upload" class="relative cursor-pointer bg-white/90 px-3 py-1 rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none shadow-sm">
                            <span>Klik untuk upload gambar</span>
                            <input id="file-upload" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                        </label>
                    </div>
                    <p class="text-xs text-gray-400 uppercase tracking-widest">PNG, JPG, WEBP (Maks. 2MB)</p>
                </div>
            </div>
        </div>

        {{-- Footer Buttons --}}
        <div class="flex justify-end items-center gap-4 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.layanan') }}"
               class="px-8 py-3 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-all">
                Batal
            </a>
            <button type="submit" id="btnSubmit"
                    class="px-8 py-3 text-sm font-bold text-white bg-indigo-900 rounded-xl hover:bg-indigo-800 shadow-lg shadow-indigo-100 transition-all transform active:scale-95 flex items-center justify-center min-w-[160px]">
                <span id="btnText">Simpan Layanan</span>
                <div id="btnLoader" class="hidden ml-3">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </button>
        </div>
    </form>
</div>

<script>
    /**
     * Fungsi Preview Gambar & Notifikasi Toast
     */
    function previewImage(input) {
        const file = input.files[0];
        const previewImg = document.getElementById('preview-img');
        const placeholder = document.getElementById('placeholder-content');
        
        if (file) {
            // Validasi Ukuran Sederhana (2MB)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar',
                    text: 'Maksimal ukuran gambar adalah 2MB',
                    confirmButtonColor: '#4f46e5'
                });
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                // Tampilkan Gambar
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                
                // Beri efek transparan pada teks agar tetap bisa ganti gambar
                placeholder.classList.add('bg-white/70', 'p-6', 'rounded-2xl', 'backdrop-blur-sm', 'shadow-lg');
                
                // NOTIFIKASI TOAST MODERN
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Gambar berhasil dipilih'
                });
            }
            reader.readAsDataURL(file);
        }
    }

    /**
     * Efek Loading saat Submit
     */
    const form = document.getElementById('layananForm');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    form.onsubmit = function() {
        // Matikan tombol agar tidak double klik
        btnSubmit.disabled = true;
        btnSubmit.classList.add('opacity-80', 'cursor-not-allowed');
        
        // Ganti teks jadi loading
        btnText.innerText = 'Menyimpan...';
        btnLoader.classList.remove('hidden');
    };
</script>
@endsection
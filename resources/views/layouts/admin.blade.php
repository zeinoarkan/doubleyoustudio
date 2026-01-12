<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Double You Studio</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#1e1b4b] text-white flex flex-col">
        <div class="p-6 font-bold text-xl border-b border-white/20">
            Admin Panel
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-white/10 transition-colors">
                Dashboard
            </a>

            <a href="{{ route('admin.layanan') }}"
               class="block px-4 py-2 rounded hover:bg-white/10 transition-colors">
                Layanan
            </a>

            <a href="{{ route('admin.pesanan') }}"
               class="block px-4 py-2 rounded hover:bg-white/10 transition-colors">
                Pesanan
            </a>
        </nav>

        <div class="p-4 border-t border-white/20">
            {{-- Tombol Logout --}}
            <a href="#" onclick="confirmLogout(event)"
               class="block text-red-300 hover:text-red-400 font-medium transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </a>

            {{-- Form Tersembunyi untuk Logout (Sangat disarankan di Laravel) --}}
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

{{-- SCRIPT AREA --}}
<script>
    /**
     * Fungsi Konfirmasi Logout
     */
    function confirmLogout(event) {
        event.preventDefault(); // Mencegah link pindah halaman langsung
        
        Swal.fire({
            title: 'Keluar dari Sistem?',
            text: "Anda harus login kembali untuk mengakses panel admin.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Warna merah (danger)
            cancelButtonColor: '#6b7280',  // Warna abu-abu
            confirmButtonText: 'Ya, Logout Sekarang',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl px-5 py-2.5',
                cancelButton: 'rounded-xl px-5 py-2.5'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form logout secara programmatik
                document.getElementById('logout-form').submit();
            }
        })
    }

    // Alert Sukses
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#ffffff',
            iconColor: '#4f46e5',
            customClass: {
                popup: 'rounded-2xl shadow-xl border border-gray-100',
                title: 'text-slate-800 font-bold',
                htmlContainer: 'text-slate-600'
            }
        });
    @endif

    // Alert Error
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Ups!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#4f46e5',
            customClass: { popup: 'rounded-2xl' }
        });
    @endif
</script>

</body>
</html>
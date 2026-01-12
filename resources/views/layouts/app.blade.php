<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoubleYou Studio</title>
    
    @vite('resources/css/app.css')
    
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    @include('layouts.navbar')

    {{-- KONTEN --}}
    <main class="flex-1">
        @if(isset($slot))
            {{ $slot }} {{-- Untuk Livewire Full-Page --}}
        @else
            @yield('content') {{-- Untuk Halaman Biasa --}}
        @endif
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    {{-- WAJIB: Script Livewire --}}
    @livewireScripts
</body>
</html>
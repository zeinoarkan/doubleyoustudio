<!DOCTYPE html>
<html>
<head>
    <title>Admin - Double You Studio</title>
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<nav class="admin-navbar">
    <div class="brand">Double You Studio</div>
    <div class="menu">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.layanan') }}">Layanan</a>
        <a href="{{ route('admin.pesanan') }}">Pesanan</a>
        <a href="{{ route('admin.logout') }}">Logout</a>
    </div>
</nav>

<main class="admin-container">
    @yield('content')
</main>

</body>
</html>

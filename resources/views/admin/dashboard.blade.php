@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded shadow">
        <p class="text-sm text-gray-500">Total Layanan</p>
        <p class="text-2xl font-bold">{{ $totalLayanan }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-sm text-gray-500">Total Pesanan</p>
        <p class="text-2xl font-bold">{{ $totalPesanan }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-sm text-gray-500">Lunas</p>
        <p class="text-2xl font-bold text-green-600">{{ $pesananLunas }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <p class="text-sm text-gray-500">Pending</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $pesananPending }}</p>
    </div>
</div>
@endsection

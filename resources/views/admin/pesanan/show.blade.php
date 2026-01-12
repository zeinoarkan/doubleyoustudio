@extends('admin.layouts.app')

@section('content')

<h1>Detail Pesanan</h1>

<div class="card">
    <p><b>Nama:</b> {{ $pesanan->nama_pelanggan }}</p>
    <p><b>No WA:</b> {{ $pesanan->no_wa }}</p>
    <p><b>Layanan:</b> {{ $pesanan->layanan->nama_layanan ?? '-' }}</p>
    <p><b>Status:</b> {{ $pesanan->status_pemesanan }}</p>

    <hr>

    <form method="POST" action="{{ route('admin.pesanan.status', $pesanan->id_pemesanan) }}">
        @csrf
        <label>Ubah Status</label><br>
        <select name="status_pemesanan">
            <option value="pending" {{ $pesanan->status_pemesanan == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="lunas" {{ $pesanan->status_pemesanan == 'lunas' ? 'selected' : '' }}>Lunas</option>
        </select>
        <br><br>
        <button type="submit">Update Status</button>
    </form>
</div>

@endsection

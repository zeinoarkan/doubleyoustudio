@extends('admin.layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #1e1e45; 
        --primary-hover: #2d2d65;
        --bg-gray: #f4f7f6;
        --border-light: #e0e0e0;
        --text-dark: #333;
    }

    .page-container {
        padding: 25px;
        color: var(--text-dark);
    }

    .content-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .card-custom {
        background: #ffffff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-light);
        max-width: 850px;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 8px;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #dcdfe6;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(30, 30, 69, 0.1);
    }

    /* Layout baris untuk Harga & Durasi */
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 1.25rem;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .btn-container {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .btn-update {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-update:hover {
        background-color: var(--primary-hover);
    }

    .btn-back {
        text-decoration: none;
        color: #888;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-back:hover {
        color: var(--text-dark);
    }
</style>

<div class="page-container">
    <div class="content-header">
        <h1>Edit Layanan</h1>
    </div>

    <div class="card-custom">
        <form method="POST" action="{{ route('admin.layanan.update', $layanan->id_layanan) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" id="nama_layanan" name="nama_layanan" class="form-control" 
                       value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" 
                           value="{{ old('harga', $layanan->harga) }}" placeholder="Contoh: 50000">
                </div>
                <div class="form-group">
                    <label>Durasi (menit)</label>
                    <input type="number" name="durasi" class="form-control" 
                           value="{{ old('durasi', $layanan->durasi) }}" placeholder="Contoh: 30">
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi Layanan</label>
                <textarea name="deskripsi" class="form-control" rows="4" style="resize: vertical;">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn-update">Update Layanan</button>
                <a href="{{ route('admin.layanan') }}" class="btn-back">Batal & Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
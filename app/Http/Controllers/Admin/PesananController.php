<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pemesanan::with(['pelanggan', 'layanan'])
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function show($id)
    {
        $pesanan = Pemesanan::with('layanan')->findOrFail($id);

        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function updateStatus($id)
    {
        $pesanan = Pemesanan::findOrFail($id);

        $pesanan->status_pemesanan =
            $pesanan->status_pemesanan === 'pending'
            ? 'lunas'
            : 'pending';

        $pesanan->save();

        return back()->with('success', 'Status pesanan diperbarui');
    }

    public function destroy($id)
{
    try {
        // Cari data berdasarkan primary key id_pemesanan
        $pesanan = Pemesanan::findOrFail($id);
        
        // Hapus data
        $pesanan->delete();

        return redirect()->route('admin.pesanan')->with('success', 'Pesanan berhasil dihapus selamanya');
    } catch (\Exception $e) {
        // Jika gagal karena relasi database atau hal lain
        return back()->with('error', 'Gagal menghapus pesanan. Kemungkinan data terkait dengan tabel lain.');
    }
}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\File; // Tambahkan ini untuk menghapus file

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'durasi' => 'required|numeric', // Tambahkan validasi durasi
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            // Simpan ke public/images/paket/ agar sesuai dengan view
            $file->move(public_path('images/paket'), $namaGambar);
        }

        Layanan::create([
            'id_admin' => session('admin_id') ?? 1,
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'durasi' => $request->durasi, // Pastikan durasi disimpan
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaGambar,
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan')); // Pastikan ada file edit.blade.php
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'durasi' => 'required|numeric', // Tambahkan validasi durasi
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $namaGambar = $layanan->gambar; // Gunakan gambar lama sebagai default

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada di folder images/paket/
            $pathLama = public_path('images/paket/' . $layanan->gambar);
            if ($layanan->gambar && File::exists($pathLama)) {
                File::delete($pathLama);
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/paket'), $namaGambar);
        }

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'durasi' => $request->durasi, // Pastikan durasi diupdate
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaGambar,
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Layanan dan gambar berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $nama_layanan = $layanan->nama_layanan;

        // --- TAMBAHAN: Hapus file gambar dari server ---
        $pathGambar = public_path('images/paket/' . $layanan->gambar);
        if ($layanan->gambar && File::exists($pathGambar)) {
            File::delete($pathGambar);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan')
            ->with('success', "Layanan '$nama_layanan' berhasil dihapus!");
    }
}
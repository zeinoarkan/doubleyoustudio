<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Pemesanan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLayanan = Layanan::count();
        $totalPesanan = Pemesanan::count();

        $pesananLunas = Pemesanan::where('status_pemesanan', 'lunas')->count();
        $pesananPending = Pemesanan::where('status_pemesanan', 'pending')->count();

        $pesananTerbaru = Pemesanan::with('layanan')
            ->orderByDesc('id_pemesanan')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalLayanan',
            'totalPesanan',
            'pesananLunas',
            'pesananPending',
            'pesananTerbaru'
        ));
    }
}

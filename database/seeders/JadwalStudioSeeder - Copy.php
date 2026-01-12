<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalStudio;
use App\Models\Admin;
use Carbon\Carbon;

class JadwalStudioSeeder extends Seeder
{
    public function run()
{
    // --- TAMBAHKAN INI: Hapus semua jadwal yang tanggalnya kurang dari hari ini ---
    App\Models\JadwalStudio::where('tanggal', '<', \Carbon\Carbon::today())->delete();

    // 1. Pastikan ada Admin
    $admin = \App\Models\Admin::first() ?? \App\Models\Admin::create([
        'username' => 'admin',
        'password' => bcrypt('password')
    ]);

    // 2. TENTUKAN RENTANG TANGGAL (Ubah dari 7 menjadi 60 hari agar Januari terisi)
    $startDate = \Carbon\Carbon::today();
    $endDate = \Carbon\Carbon::today()->addDays(30); 

    // 3. Loop setiap hari
    for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
        
        $jamMulai = [10, 12, 14, 16, 18]; 

        foreach ($jamMulai as $jam) {
            // Gunakan updateOrCreate agar data tidak duplikat jika seeder dijalankan ulang
            \App\Models\JadwalStudio::updateOrCreate(
                [
                    'tanggal'   => $date->format('Y-m-d'),
                    'jam_mulai' => \Carbon\Carbon::createFromTime($jam, 0, 0)->format('H:i:s'),
                ],
                [
                    'id_admin'    => $admin->id_admin,
                    'jam_selesai' => \Carbon\Carbon::createFromTime($jam + 1, 0, 0)->format('H:i:s'),
                    'status'      => 'tersedia',
                ]
            );
        }
    }
}
}
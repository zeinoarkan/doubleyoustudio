<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalStudio; // Import model di sini
use App\Models\Admin;        // Import model di sini
use Carbon\Carbon;

class JadwalStudioSeeder extends Seeder
{
    public function run()
    {
        // Gunakan \ di depan App atau cukup panggil nama class-nya karena sudah di-import di atas
        JadwalStudio::where('tanggal', '<', Carbon::today())->delete();

        // 1. Pastikan ada Admin
        $admin = Admin::first() ?? Admin::create([
            'username' => 'admin',
            'password' => bcrypt('password')
        ]);

        // 2. TENTUKAN RENTANG TANGGAL
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(30); 

        // 3. Loop setiap hari
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            
            $jamMulai = [10, 12, 14, 16, 18]; 

            foreach ($jamMulai as $jam) {
                // updateOrCreate akan membuat data baru jika belum ada
                JadwalStudio::updateOrCreate(
                    [
                        'tanggal'   => $date->format('Y-m-d'),
                        'jam_mulai' => Carbon::createFromTime($jam, 0, 0)->format('H:i:s'),
                    ],
                    [
                        'id_admin'    => $admin->id_admin,
                        'jam_selesai' => Carbon::createFromTime($jam + 1, 0, 0)->format('H:i:s'),
                        'status'      => 'tersedia',
                    ]
                );
            }
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin; // Pastikan model Admin di-import

class LayananSeeder extends Seeder
{
    public function run()
    {
        // 1. Ambil data admin pertama dari database
        $admin = Admin::first();

        // Cek jika admin belum ada, buat satu (opsional, untuk mencegah error)
        if (!$admin) {
            $admin = Admin::create([
                'username' => 'admin',
                'password' => bcrypt('password')
            ]);
        }

        // 2. Masukkan data layanan dengan menyertakan id_admin
        DB::table('layanan')->insert([
            [
                'id_admin'     => $admin->id_admin, // Tambahkan ini
                'nama_layanan' => 'K – Cut Package',
                'harga'        => 50000,
                'gambar'       => 'kcut.png',
                'warna_btn'    => 'bg-[#cc0000] text-white'
            ],
            [
                'id_admin'     => $admin->id_admin, // Tambahkan ini
                'nama_layanan' => 'Basic Package',
                'harga'        => 75000,
                'gambar'       => 'basic.png',
                'warna_btn'    => 'bg-[#ffcc00] text-black'
            ],
            [
                'id_admin'     => $admin->id_admin, // Tambahkan ini
                'nama_layanan' => 'Self Pass Photo',
                'harga'        => 40000,
                'gambar'       => 'self.png',
                'warna_btn'    => 'bg-[#66cc66] text-white'
            ],
        ]);
    }
}
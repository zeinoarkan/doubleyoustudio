<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // 1. Tentukan nama tabel sesuai di database Anda
    protected $table = 'pelanggan';

    // 2. Tentukan primary key-nya
    protected $primaryKey = 'id_pelanggan';

    // 3. Matikan timestamps jika tabel tidak memiliki kolom created_at/updated_at
    public $timestamps = false;

    // 4. Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'nama',
        'whatsapp',
    ];

    /**
     * Relasi ke tabel Pemesanan (Satu pelanggan bisa punya banyak pesanan)
     */
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
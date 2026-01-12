<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalStudio extends Model
{
    use HasFactory;

    // 1. Beritahu Laravel nama tabelnya (karena bukan 'jadwal_studios')
    protected $table = 'jadwal_studio';

    // 2. Beritahu Laravel nama Primary Key-nya
    protected $primaryKey = 'id_jadwal';

    // 3. Kolom mana saja yang boleh diisi (Mass Assignment)
    // Sesuai dengan kolom di studio.sql Anda
    public $timestamps = false;
    
    protected $fillable = [
        'id_admin',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    /**
     * Relasi ke tabel Pemesanan
     * Satu jadwal bisa memiliki satu atau banyak pemesanan (tergantung sistem Anda)
     */
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_jadwal', 'id_jadwal');
    }
}
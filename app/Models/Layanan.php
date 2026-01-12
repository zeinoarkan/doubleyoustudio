<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // 1. Beritahu Laravel nama tabelnya
    protected $table = 'layanan';

    // 2. Beritahu nama Primary Key-nya
    protected $primaryKey = 'id_layanan';

    // 3. Matikan timestamps karena di SQL Anda tidak ada kolom created_at/updated_at
    public $timestamps = false;

    // 4. Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'id_admin',
        'nama_layanan',
        'harga',
        'durasi',
        'gambar',
    ];

    /**
     * Relasi: Satu layanan dimiliki oleh satu admin
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    /**
     * Relasi: Satu layanan bisa memiliki banyak pemesanan
     */
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_layanan', 'id_layanan');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // 1. Tentukan nama tabel (karena di DB namanya 'pemesanan')
    protected $table = 'pemesanan';

    // 2. Tentukan Primary Key-nya
    protected $primaryKey = 'id_pemesanan';

    // 3. Matikan timestamps jika di tabel SQL Anda tidak ada kolom created_at & updated_at
    public $timestamps = false;

    // 4. Daftarkan kolom yang bisa diisi (Mass Assignment)
    // Sesuai dengan data yang Anda kirim di fungsi confirmBooking()
    protected $fillable = [
    'id_jadwal',
    'id_layanan',
    'id_pelanggan', // Jika menggunakan relasi ke tabel pelanggan
    'jumlah_customer',
    'total_harga',
    'status_pemesanan',
    'tanggal_pesan',
];

    /**
     * RELASI: Pemesanan ini punya siapa (Layanan/Paket)
     */
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }

    /**
     * RELASI: Pemesanan ini di jadwal yang mana
     */
    public function jadwal()
    {
        return $this->belongsTo(JadwalStudio::class, 'id_jadwal', 'id_jadwal');
    }

    // Tambahkan ini di dalam class Pemesanan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

}
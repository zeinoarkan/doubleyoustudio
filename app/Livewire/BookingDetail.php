<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JadwalStudio;
use App\Models\Layanan;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;

class BookingDetail extends Component
{
    public $jadwalId, $paketId;
    public $jadwal, $paket;
    public $nama_pelanggan, $no_wa;

    public function mount($jadwal, $paket)
    {
        $this->jadwalId = $jadwal;
        $this->paketId = $paket;

        // Ambil data untuk ditampilkan di ringkasan
        $this->jadwal = JadwalStudio::findOrFail($jadwal);
        $this->paket = Layanan::where('id_layanan', $paket)->first();
    }

    public $jumlah_orang = 0; // Default 0 orang tambahan
    public function confirmBooking()
    {
        $this->validate([
            'nama_pelanggan' => 'required|min:3',
            'no_wa' => 'required|digits_between:10,15',
            'jumlah_orang' => 'required|integer',
        ]);

        // 🔒 CEK JADWAL MASIH TERSEDIA
        if ($this->jadwal->status !== 'tersedia') {
            session()->flash('error', 'Jadwal sudah dipesan.');
            return;
        }

        $total_harga = $this->paket->harga + ($this->jumlah_orang * 30000);

        try {
            DB::beginTransaction();

            // 1️⃣ SIMPAN / UPDATE PELANGGAN
            $pelanggan = \App\Models\Pelanggan::updateOrCreate(
                ['whatsapp' => $this->no_wa],
                ['nama' => $this->nama_pelanggan]
            );

            // 2️⃣ SIMPAN PEMESANAN
            $pemesanan = Pemesanan::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_layanan' => $this->paketId,
                'id_jadwal' => $this->jadwalId,
                'jumlah_customer' => $this->jumlah_orang,
                'total_harga' => $total_harga,
                'status_pemesanan' => 'pending',
                'tanggal_pesan' => now(),
            ]);

            // 3️⃣ 🔴 INI DIA — UPDATE STATUS JADWAL
            JadwalStudio::where('id_jadwal', $this->jadwalId)
                ->update(['status' => 'dipesan']);

            // 4️⃣ MIDTRANS CONFIG (tidak mengubah DB)
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => 'INV-' . $pemesanan->id_pemesanan . '-' . time(),
                    'gross_amount' => (int) $total_harga,
                ],
                'customer_details' => [
                    'first_name' => $this->nama_pelanggan,
                    'phone' => $this->no_wa,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            DB::commit();

            $this->dispatch(
                'pay-with-midtrans',
                snapToken: $snapToken,
                id_pemesanan: $pemesanan->id_pemesanan
            );

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
        }
    }

    public function finish(Request $request)
    {
        $orderIdParam = $request->query('order_id');

        if (!$orderIdParam) {
            return redirect()->route('home')->with('error', 'ID Pesanan tidak ditemukan.');
        }

        try {
            // Ambil ID dari string: INV-ID-TIME
            $parts = explode('-', $orderIdParam);
            $id_pemesanan = $parts[1]; 

            $pemesanan = Pemesanan::with(['pelanggan', 'layanan', 'jadwal'])->findOrFail($id_pemesanan);

            // Verifikasi ke server Midtrans
            $status = Transaction::status($orderIdParam);
            $transactionStatus = $status->transaction_status;

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                
                if ($pemesanan->status_pemesanan !== 'success') {
                    $pemesanan->update(['status_pemesanan' => 'success']);
                    
                    // Update jadwal jadi booked
                    JadwalStudio::where('id_jadwal', $pemesanan->id_jadwal)
                        ->update(['status' => 'booked']);

                    // KIRIM WA OTOMATIS
                    $this->notifikasiWhatsappSukses($pemesanan);
                }

                return view('booking-success', compact('pemesanan'));
            } 

            return redirect()->route('home')->with('error', 'Pembayaran belum diselesaikan.');

        } catch (\Exception $e) {
            Log::error("Midtrans Error: " . $e->getMessage());
            return redirect()->route('home')->with('error', 'Gagal memverifikasi pembayaran.');
        }
    }

    private function notifikasiWhatsappSukses($pemesanan)
    {
        try {
            // FIX: Gunakan 'whatsapp' bukan 'no_hp'
            $nomor = $pemesanan->pelanggan->whatsapp; 
            $pesan = "Halo *{$pemesanan->pelanggan->nama}*,\n\nBooking Anda #{$pemesanan->id_pemesanan} BERHASIL dibayar! ✅\n\n📅 Tanggal: " . date('d/m/Y', strtotime($pemesanan->jadwal->tanggal)) . "\n⏰ Jam: {$pemesanan->jadwal->jam_mulai}\n\nSampai jumpa di Studio!";

            $this->sendWhatsapp($nomor, $pesan);
        } catch (\Exception $e) {
            Log::error("Gagal kirim WA: " . $e->getMessage());
        }
    }

    private function sendWhatsapp($nomor, $pesan) 
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $nomor,
                'message' => $pesan,
                'countryCode' => '62', 
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Z4RJR27QU6JaxbXVAt2a'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function render()
    {
        return view('livewire.booking-detail')->layout('layouts.app');
    }
}

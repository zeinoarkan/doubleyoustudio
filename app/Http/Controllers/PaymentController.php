<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\JadwalStudio;

use Midtrans\Config;
use Midtrans\Transaction;

class PaymentController extends Controller
{
    public function receive(Request $request)
    {
        // 1. Ambil data dari Midtrans
        $status = $request->transaction_status;
        $orderId = $request->order_id; // Ini biasanya berisi id_pemesanan

        // 2. Cari data pemesanan di database
        $pemesanan = Pemesanan::find($orderId);

        if (!$pemesanan) return response()->json(['message' => 'Not Found'], 404);

        // 3. Logika jika pembayaran BERHASIL (settlement atau capture)
        if ($status == 'settlement' || $status == 'capture') {
            
            // Update status pemesanan
            $pemesanan->update(['status_pemesanan' => 'lunas']);

            // UPDATE JADWAL MENJADI BOOKED
            // Kita gunakan relasi yang sudah Anda buat di model Pemesanan
            JadwalStudio::where('id_jadwal', $pemesanan->id_jadwal)
                ->update(['status' => 'booked']);
        } 
        
        // 4. Logika jika pembayaran GAGAL/Expired
        elseif ($status == 'expire' || $status == 'cancel') {
            $pemesanan->update(['status_pemesanan' => 'batal']);
            
            // Kembalikan jadwal menjadi tersedia lagi
            JadwalStudio::where('id_jadwal', $pemesanan->id_jadwal)
                ->update(['status' => 'tersedia']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function __construct()
    {
        // Pastikan key ini sesuai dengan di file .env Anda
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function finish(Request $request)
    {
        $orderIdParam = $request->query('order_id');

        if (!$orderIdParam) {
            return redirect()->route('home')->with('error', 'ID Pesanan tidak ditemukan.');
        }

        try {
            // Memecah Order ID (Contoh: INV-83-1768138893)
            $parts = explode('-', $orderIdParam);
            $id_pemesanan = $parts[1]; // Mengambil angka 83 sebagai ID

            // Memuat relasi agar data pelanggan tersedia untuk WA
            $pemesanan = Pemesanan::with(['pelanggan', 'layanan', 'jadwal'])->findOrFail($id_pemesanan);

            // Cek status ke server Midtrans
            $status = Transaction::status($orderIdParam);
            $transactionStatus = $status->transaction_status;

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                
                // Pastikan WA hanya terkirim sekali jika status baru berubah
                if ($pemesanan->status_pemesanan !== 'success') {
                    $pemesanan->update(['status_pemesanan' => 'success']);
                    
                    JadwalStudio::where('id_jadwal', $pemesanan->id_jadwal)
                        ->update(['status' => 'booked']);

                    // EKSEKUSI KIRIM WHATSAPP
                    $this->sendWhatsappSuccess($pemesanan);
                }

                // Redirect ke halaman sukses (resources/views/booking-success.blade.php)
                return view('booking-success', compact('pemesanan'));
            } 

            return redirect()->route('home')->with('error', 'Pembayaran belum berhasil.');

        } catch (\Exception $e) {
            Log::error("Payment Error: " . $e->getMessage());
            return redirect()->route('home')->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
    }

    private function sendWhatsappSuccess($pemesanan)
    {
        // Berdasarkan file .env dan Livewire, kolom Anda adalah 'whatsapp' 
        $nomor = $pemesanan->pelanggan->whatsapp; 
        
        $pesan = "Halo Kak *{$pemesanan->pelanggan->nama}*,\n\n";
        $pesan .= "Pembayaran untuk booking studio *BERHASIL!* ✅\n\n";
        $pesan .= "*Detail Booking:*\n";
        $pesan .= "📅 Tanggal: " . date('d/m/Y', strtotime($pemesanan->jadwal->tanggal)) . "\n";
        $pesan .= "⏰ Jam: {$pemesanan->jadwal->jam_mulai} WIB\n";
        $pesan .= "📸 Paket: {$pemesanan->layanan->nama_layanan}\n\n";
        $pesan .= "Terima kasih, sampai jumpa di studio! ✨";

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

}
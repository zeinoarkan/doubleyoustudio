<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // Wajib ada baris ini!
use App\Livewire\BookingDetail; // Import komponen baru nanti
use App\Models\Pemesanan;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\LayananController;

// Hapus rute '/' yang lama, pakai yang ini saja
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', function () {
    return view('pages.gallery');
})->name('gallery');
Route::get('/paket', function () {
    return view('pages.paket');
})->name('paket');
Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');
Route::get('/booking', function () {
    return view('pages.booking');
})->name('booking');
Route::get('/booking/detail/{jadwal}/{paket}', BookingDetail::class)->name('booking.detail');
Route::get('/midtrans-test', function () {
    \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
    \Midtrans\Config::$isProduction = false;

    $params = [
        'transaction_details' => [
            'order_id' => 'TEST-' . time(),
            'gross_amount' => 10000,
        ],
    ];

    return \Midtrans\Snap::getSnapToken($params);
});
Route::get('/booking/success/{id_pemesanan}', function ($id_pemesanan) {
    // Memuat data pemesanan beserta relasi pelanggan dan layanan
    $pemesanan = \App\Models\Pemesanan::with(['pelanggan', 'layanan'])->findOrFail($id_pemesanan);
    return view('booking-succes', compact('pemesanan'));
})->name('booking.success');
// routes/api.php
Route::post('/midtrans-callback', [PaymentController::class, 'receive']);
Route::post('/midtrans/webhook', [PaymentController::class, 'notify']);

// 🌐 HALAMAN USER
Route::get('/booking/success/{id}', [PaymentController::class, 'success'])
    ->name('booking.success');

    // Tambahkan ini di web.php
Route::get('/booking/finish', [PaymentController::class, 'finish'])->name('booking.finish');

Route::get('/booking/pending/{id}', [PaymentController::class, 'pending']);
Route::get('/booking/failed/{id}', [PaymentController::class, 'failed']);

Route::get('/pesanan/berhasil/{id}', function ($id) {

    $pesanan = \App\Models\Pemesanan::findOrFail($id);

    // 1️⃣ Update status pemesanan
    $pesanan->update([
        'status_pemesanan' => 'berhasil'
    ]);

    // 2️⃣ KUNCI JADWAL (INI YANG PENTING)
    \App\Models\JadwalStudio::where('id_jadwal', $pesanan->id_jadwal)
        ->update([
            'status' => 'dipesan'
        ]);

    return redirect()->route('booking.success', $id);
})->name('pesanan.berhasil');

Route::prefix('admin')->group(function () {

    // AUTH
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // PROTECTED
    Route::middleware('admin.auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // LAYANAN
        Route::get('/layanan', [LayananController::class, 'index'])
            ->name('admin.layanan');

        Route::get('/layanan/create', [LayananController::class, 'create'])
            ->name('admin.layanan.create');

        Route::post('/layanan', [LayananController::class, 'store'])
            ->name('admin.layanan.store');

        Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])
            ->name('admin.layanan.edit');

        // ✅ FIX UTAMA DI SINI
        Route::put('/layanan/{id}', [LayananController::class, 'update'])
            ->name('admin.layanan.update');

        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])
            ->name('admin.layanan.delete');

        // PESANAN
        Route::get('/pesanan', [PesananController::class, 'index'])
            ->name('admin.pesanan');

        Route::get('/pesanan/{id}', [PesananController::class, 'show'])
            ->name('admin.pesanan.show');

        Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])
            ->name('admin.pesanan.delete');

        Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])
            ->name('admin.pesanan.status');
    });
});
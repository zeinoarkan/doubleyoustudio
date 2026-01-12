<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\JadwalStudio;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;

class BookingCalendar extends Component
{
    public $selectedMonth;
    public $selectedYear;
    public $selectedDate;
    public $availableSlots = [];
    public $selectedSlotId;
    public $layananList = []; // Akan diisi data dari DB
    public $selectedLayananId;

    public $nama_pelanggan;
    public $no_wa;

    public function mount()
    {
        $this->selectedMonth = now()->month;
        $this->selectedYear = now()->year;

        // 1. Ambil semua data layanan dari database agar tombol paket muncul
        $this->layananList = DB::table('layanan')->get();

        // 2. Tangkap ID paket dari URL (?paket=ID)
        $this->selectedLayananId = request()->query('paket');
    }

    // 3. Tambahkan fungsi untuk memilih layanan secara manual
    public function selectLayanan($id)
    {
        $this->selectedLayananId = $id;
        // Reset tanggal dan slot jika ganti paket (opsional)
        $this->selectedDate = null;
        $this->selectedSlotId = null;
    }

    public function goToNextMonth()
    {
        $date = Carbon::create($this->selectedYear, $this->selectedMonth, 1)->addMonth();
        $this->selectedMonth = $date->month;
        $this->selectedYear = $date->year;
    }

    public function goToPreviousMonth()
    {
        $date = Carbon::create($this->selectedYear, $this->selectedMonth, 1)->subMonth();
        $this->selectedMonth = $date->month;
        $this->selectedYear = $date->year;
    }

    public function selectDate($day)
    {
        // 1. Tentukan tanggal yang dipilih
        $this->selectedDate = Carbon::create(
        $this->selectedYear,
        $this->selectedMonth,
        $day
    )->format('Y-m-d');

        // 2. Mulai Query untuk mencari slot yang tersedia
        $query = JadwalStudio::where('tanggal', $this->selectedDate)
            ->where('status', 'tersedia');

        // 3. LOGIKA PENTING: Jika tanggal yang dipilih adalah hari ini, 
        // pastikan jam_mulai lebih besar dari jam sekarang
        if ($this->selectedDate === now()->toDateString()) {
            $query->where('jam_mulai', '>', now()->toTimeString());
        }

        // 4. Ambil data slots dan reset pilihan
        $this->availableSlots = JadwalStudio::where('tanggal', $this->selectedDate)
        ->where('status', 'tersedia') // ⬅️ WAJIB
        ->orderBy('jam_mulai')
        ->get();
        $this->selectedSlotId = null;
    }
    public function selectSlot($id)
    {
        $this->selectedSlotId = $id;
    }

    public function confirmBooking()
    {
        JadwalStudio::where('id_jadwal', $this->jadwalId)
            ->update([
                'status_jadwal' => 'reserved'
            ]);
        $this->validate([
            'selectedLayananId' => 'required',
            'nama_pelanggan' => 'required|min:3',
            'no_wa' => 'required|numeric|min:10',
            'selectedSlotId' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $pelanggan = Pelanggan::create([
                'nama' => $this->nama_pelanggan,
                'whatsapp' => $this->no_wa,
            ]);

            $pemesanan = Pemesanan::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'id_layanan' => $this->selectedLayananId,
                'id_jadwal' => $this->selectedSlotId,
                'jumlah_customer' => $this->jumlah_orang ?? 1,
                'total_harga' => $this->total_harga,
                'status_pemesanan' => 'pending', // Masih pending
                'tanggal_pesan' => now(),
            ]);

            // OPSIONAL: Tandai jadwal sebagai 'pending' agar tidak bisa diklik orang lain sementara waktu
            JadwalStudio::where('id_jadwal', $this->selectedSlotId)
                ->update(['status' => 'pending']);

            DB::commit();

            // Di sini Anda panggil Midtrans Snap Token dan arahkan ke pembayaran
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function render()
    {
        $date = Carbon::create($this->selectedYear, $this->selectedMonth, 1);

        $availableDates = DB::table('jadwal_studio')
            ->whereYear('tanggal', $this->selectedYear)
            ->whereMonth('tanggal', $this->selectedMonth)
            ->where('status', 'tersedia') // ⬅️ WAJIB
            ->where('tanggal', '>=', now()->toDateString())
            ->pluck('tanggal')
            ->toArray();


        return view('livewire.booking-calendar', [
            'monthName' => $date->format('F'),
            'daysInMonth' => $date->daysInMonth,
            'startDayOfWeek' => $date->startOfMonth()->dayOfWeekIso,
            'availableDates' => $availableDates,
        ]);
    }

    public function goToDetails()
    {
        // Validasi sederhana agar tidak ada data yang kosong
        if (!$this->selectedSlotId || !$this->selectedLayananId) {
            session()->flash('error', 'Pilih paket dan jadwal terlebih dahulu.');
            return;
        }

        // Alihkan ke rute 'booking.detail' dengan parameter
        return redirect()->route('booking.detail', [
            'jadwal' => $this->selectedSlotId,
            'paket' => $this->selectedLayananId
        ]);
    }


}
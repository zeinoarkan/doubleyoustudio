<div class="bg-[#0b0b45] text-white rounded-[3rem] flex flex-col md:flex-row w-full max-w-5xl shadow-2xl overflow-hidden border border-white/10">

    {{-- SISI KIRI: BRANDING & RINGKASAN --}}
    <div class="w-full md:w-1/3 p-10 md:p-12 bg-gradient-to-b from-[#1a1a5a] to-[#0b0b45] flex flex-col items-center justify-between text-center border-b md:border-b-0 md:border-r border-white/10">
        <div class="w-full">
            <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center mb-6 mx-auto rotate-3 shadow-xl overflow-hidden">
                <img src="{{ asset('images/bg/booking.jpg') }}" alt="Logo Studio" class="w-full h-full object-cover -rotate-3 scale-110">
            </div>
            <h1 class="text-2xl font-bold tracking-tight mb-2">Double You Studio</h1>
            <p class="text-white/50 text-xs uppercase tracking-[0.2em] mb-8">Self Photo Experience</p>
        </div>

        <div class="w-full space-y-4">
            <div class="bg-white/5 p-6 rounded-3xl border border-white/10 backdrop-blur-sm text-left">
                <p class="text-[10px] text-white/40 uppercase tracking-widest mb-3 text-center">Ringkasan Pesanan</p>
                
                <div class="space-y-3">
                    {{-- Info Paket --}}
                    <div>
                        <p class="text-[9px] text-amber-500 uppercase font-bold tracking-tighter">Paket Terpilih</p>
                        @php $layanan = collect($layananList)->firstWhere('id_layanan', $selectedLayananId); @endphp
                        <p class="text-white text-xs font-medium">{{ $layanan->nama_layanan ?? '-' }}</p>
                    </div>

                    {{-- Info Waktu --}}
                    <div>
                        <p class="text-[9px] text-amber-500 uppercase font-bold tracking-tighter">Waktu & Jam</p>
                        @if($selectedSlotId && $selectedDate)
                            @php $slot = collect($availableSlots)->firstWhere('id_jadwal', $selectedSlotId); @endphp
                            <p class="text-white text-xs font-medium">
                                {{ \Carbon\Carbon::parse($selectedDate)->format('d M') }} | {{ date('H:i', strtotime($slot['jam_mulai'])) }} WIB
                            </p>
                        @else
                            <p class="text-white/40 text-xs italic">Belum dipilih</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SISI KANAN: KONTEN UTAMA --}}
    <div class="w-full md:w-2/3 p-8 md:p-12 bg-[#0b0b45]/30 overflow-y-auto max-h-[800px]">
        
        {{-- 1. PILIHAN LAYANAN (AMBIL DARI DB) --}}
        <div class="mb-10">
            <h3 class="text-xs font-bold uppercase tracking-widest text-white/60 mb-6 flex items-center gap-3">
                <span class="h-[1px] w-8 bg-amber-500"></span>
                Pilih Paket
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($layananList as $item)
                    <button wire:click="selectLayanan({{ $item->id_layanan }})"
                        class="p-4 rounded-2xl border transition-all duration-300 text-left group
                        {{ $selectedLayananId == $item->id_layanan 
                            ? 'bg-white text-[#0b0b45] border-white shadow-xl scale-[1.02]' 
                            : 'bg-white/5 border-white/10 hover:border-white/40 text-white' }}">
                        <p class="text-xs font-black uppercase tracking-tight">{{ $item->nama_layanan }}</p>
                        <p class="text-[10px] mt-1 {{ $selectedLayananId == $item->id_layanan ? 'text-[#0b0b45]/70' : 'text-white/40' }}">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>
                    </button>
                @endforeach
            </div>
        </div>

        <hr class="border-white/5 mb-10">

        {{-- 2. HEADER KALENDER --}}
        <div class="flex items-center justify-between mb-10 {{ !$selectedLayananId ? 'opacity-20 pointer-events-none' : '' }}">
            <div>
                <h2 class="text-2xl font-bold">{{ $monthName }}</h2>
                <p class="text-white/40 text-sm">{{ $selectedYear }}</p>
            </div>
            <div class="flex gap-3">
                <button wire:click="goToPreviousMonth" class="w-10 h-10 flex items-center justify-center hover:bg-white/10 border border-white/10 rounded-xl transition-all">◀</button>
                <button wire:click="goToNextMonth" class="w-10 h-10 flex items-center justify-center hover:bg-white/10 border border-white/10 rounded-xl transition-all">▶</button>
            </div>
        </div>

        {{-- 3. GRID KALENDER --}}
        <div class="mb-10 {{ !$selectedLayananId ? 'opacity-20 pointer-events-none' : '' }}">
            <div class="grid grid-cols-7 gap-2 mb-4 text-center text-amber-500/80 text-[10px] font-black uppercase tracking-widest">
                <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
            </div>

            <div class="grid grid-cols-7 gap-2 md:gap-4 text-center">
                @for ($i = 1; $i < $startDayOfWeek; $i++) <div></div> @endfor

                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php 
                        $currentLoopDate = \Carbon\Carbon::create($selectedYear, $selectedMonth, $day)->format('Y-m-d');
                        $isAvailable = in_array($currentLoopDate, $availableDates); 
                        $isSelected = ($selectedDate === $currentLoopDate);
                    @endphp
                    <div class="relative py-1">
                        <button wire:click="selectDate({{ $day }})" @disabled(!$isAvailable)
                            class="relative z-10 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-2xl text-sm transition-all duration-300
                            {{ $isSelected ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/40 scale-110 font-bold' : '' }}
                            {{ $isAvailable && !$isSelected ? 'bg-white/5 hover:bg-white/20 border border-white/10' : '' }}
                            {{ !$isAvailable ? 'opacity-10 cursor-not-allowed' : '' }}">
                            {{ $day }}
                        </button>
                        @if($isAvailable && !$isSelected)
                            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 bg-amber-500 rounded-full"></div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        {{-- 4. BAGIAN JAM --}}
        <div class="mt-12 transition-all duration-500 {{ !$selectedDate ? 'opacity-0' : 'opacity-100' }}">
            <h3 class="text-sm font-bold uppercase tracking-widest text-white/60 mb-6 flex items-center gap-3">
                <span class="h-[1px] w-8 bg-amber-500"></span>
                Tersedia pada {{ $selectedDate ? \Carbon\Carbon::parse($selectedDate)->format('d M') : '' }}
            </h3>
            
            @if(count($availableSlots) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach($availableSlots as $slot)
                        <button wire:click="selectSlot({{ $slot['id_jadwal'] }})"
                            class="py-4 px-4 rounded-2xl border transition-all duration-300 text-xs font-bold
                            {{ $selectedSlotId == $slot['id_jadwal'] 
                                ? 'bg-white text-[#0b0b45] border-white shadow-xl scale-105' 
                                : 'bg-white/5 border-white/10 hover:border-white/40 text-white/80' }}">
                            {{ date('H:i', strtotime($slot['jam_mulai'])) }}
                        </button>
                    @endforeach
                </div>
                @endif
                {{-- 5. FORM DATA DIRI & KONFIRMASI (MUNCUL JIKA JAM DIPILIH) --}}
                @if($selectedSlotId)
    <div class="mt-10 p-6 bg-white/5 rounded-3xl border border-white/10 space-y-4 animate-in fade-in slide-in-from-bottom-4 duration-500">
        <button wire:click="goToDetails" class="w-full bg-amber-500 hover:bg-amber-400 text-[#0b0b45] py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-2xl transition-all active:scale-95 flex items-center justify-center gap-2">
            Isi Data Diri 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
@endif
        </div>
    </div>
</div>
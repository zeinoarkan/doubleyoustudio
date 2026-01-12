@extends('layouts.app')

@section('content')

    {{-- HERO SECTION --}}
    <section class="w-full relative overflow-hidden">
        <div class="relative h-[380px] md:h-[500px] bg-cover bg-center flex items-center justify-center"
             style="background-image: url('{{ asset('images/bg/gradasi.png') }}'), url('{{ asset('images/bg/studio.webp') }}'); background-blend-mode: overlay;">
            <div class="absolute inset-0 bg-indigo-900/30"></div>
            <div class="relative z-10 text-center px-4">
                <img src="{{ asset('logo/logo.png') }}" class="w-72 md:w-[450px] mx-auto drop-shadow-2xl" alt="Double You Studio">
            </div>
        </div>
    </section>

    {{-- DESKRIPSI --}}
    <section class="max-w-4xl mx-auto py-16 px-8 text-center">
        <p class="text-gray-500 italic text-lg leading-relaxed font-serif">
            “Double You Studio adalah layanan self-photo modern yang memberikan
            ruang privat, nyaman, dan mudah di-booking untuk membantu Anda
            menghasilkan foto berkualitas tinggi tanpa fotografer.”
        </p>
    </section>

    {{-- SECTION PAKET (NAVY BLUE BOX) --}}
    <section class="max-w-5xl mx-auto px-4 mb-24">
        <div class="bg-[#1e1b4b] rounded-[2.5rem] p-8 md:p-12 shadow-2xl relative">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-8 text-center text-white">
                
                @foreach ($layanan as $item)
                    <div class="flex flex-col items-center">
                        {{-- Image Container --}}
                        <div class="h-44 flex items-center justify-center mb-4 transition-transform duration-500 hover:scale-110">
                            {{-- Memuat gambar dari folder public/images/paket/ sesuai database --}}
                            @if($item->gambar)
                                <img src="{{ asset('images/paket/' . $item->gambar) }}" alt="{{ $item->nama_layanan }}" class="max-h-full object-contain">
                            @else
                                <img src="{{ asset('images/paket/default.png') }}" alt="Default" class="max-h-full object-contain">
                            @endif
                        </div>

                        {{-- Garis Pemisah --}}
                        <div class="w-full h-[1px] bg-white/20 my-4"></div>

                        <h3 class="font-medium text-lg tracking-wide">{{ $item->nama_layanan }}</h3>
                        <p class="text-white/50 text-xs mt-1">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

                        {{-- Tombol Booking (Sekarang seragam berwarna Kuning Emas) --}}
                        <a href="{{ route('booking', ['paket' => $item->id_layanan]) }}" 
                           class="bg-[#ffcc00] text-black mt-6 px-10 py-2.5 rounded-xl font-bold text-sm shadow-lg transition-all duration-300 hover:bg-white hover:-translate-y-1 active:scale-95 text-center inline-block">
                            Booking Now
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- TESTIMONI CUSTOMER --}}
    <section class="max-w-6xl mx-auto px-6 mb-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">Testimoni Customer</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ([
                ['Najwa Alifa', 'najwa.jpg', 'Pelayanannya ramah bangettt, sukak deh, hasil fotonya juga cakep'],
                ['Syafan', 'syafan.jpg', 'Tempatnya bersih, wangi dan pelayanannya top banget!!!'],
                ['Aji Khoirull', 'aji.jpg', 'Pelayanannya ramah bangettt, sukak deh, hasil fotonya juga cakep'],
                ['Emil rizki', 'emil.jpg', 'bakal mampir lagi sih, masnya baik banget dan sabar bantu dari awal wkwk'],
                ['Hazna Salwa', 'hazna.jpg', 'Rekomen banget buat yang ngga punya waktu banyak, sat set langsung jadi'],
                ['Gufron Nugroho', 'gufron.jpg', 'hasilnya bagus bangetttt, next bakal kesini lagi hehe'],
            ] as [$nama, $foto, $komen])

                <div class="border-[1.5px] border-indigo-200 rounded-[2rem] p-6 bg-white flex flex-col items-start text-left shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ asset('images/testimoni/' . $foto) }}" class="w-12 h-12 rounded-full object-cover border border-gray-100 shadow-sm" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($nama) }}'">
                        <div>
                            <h4 class="font-bold text-gray-900 leading-none">{{ $nama }}</h4>
                            <div class="flex text-yellow-400 text-sm mt-1.5">
                                @for($i=0; $i<5; $i++) <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-[13px] leading-relaxed">
                        {{ $komen }}
                    </p>
                </div>
            @endforeach
        </div>
    </section>

@endsection
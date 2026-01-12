@extends('layouts.app')

@section('content')

    <section class="bg-white py-10 min-h-screen w-full font-sans">

        {{-- HEADER SECTION --}}
        <div class="max-w-6xl mx-auto px-6 text-center mb-16 mt-10">
            <h1 class="text-5xl md:text-6xl text-gray-400 font-light">
                <span class="opacity-40">_</span>Pricelist <span class="text-amber-600 font-medium font-serif">Double You.</span>
            </h1>
        </div>

        <div class="max-w-6xl mx-auto px-6 space-y-12">

            {{-- 1. K - CUT PACKAGE --}}
            <div class="bg-[#FFFBF2] rounded-[3rem] shadow-lg p-8 md:p-12 relative overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

                    {{-- LEFT: TEXT CONTENT --}}
                    <div class="md:col-span-5">
                        <h2 class="text-3xl font-serif text-gray-900 mb-6">K - Cut Package</h2>
                        <ul class="text-sm text-gray-700 space-y-2.5">
                            @foreach([
                                '10 menit sesi foto ( tanpa fotografer dengan remot khusus )',
                                '10 menit sesi memilih foto',
                                'Minimal 2 orang, Maksimal 5 orang',
                                'Menggunakan background foto yang sedang terpasang',
                                'Free semua soft file',
                                'Bonus hasil cetaknya yang sama untuk setiap orang (Frame A) '
                            ] as $item)
                                <li class="flex items-start gap-3">
                                    <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                    <span class="leading-relaxed">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- CENTER: PRICE --}}
                    <div class="md:col-span-4 flex flex-col justify-center items-center md:items-start pl-0 md:pl-10 border-t md:border-t-0 md:border-l border-amber-100 pt-6 md:pt-0">
                        <div class="grid grid-cols-3 md:flex md:flex-col gap-x-4 items-center w-full">
                            <span class="text-amber-500 font-serif text-lg col-span-1 md:mb-2">Price :</span>

                            <div class="col-span-2 text-left">
                                <div class="mb-4">
                                    <p class="text-4xl font-serif text-amber-500">20K <span class="text-base font-sans text-amber-500">/Orang</span></p>
                                    <p class="text-xs text-amber-600 mt-1">Senin - Jumat ( Weekday )</p>
                                </div>
                                <div>
                                    <p class="text-4xl font-serif text-amber-500">25K <span class="text-base font-sans text-amber-500">/Orang</span></p>
                                    <p class="text-xs text-amber-600 mt-1">Sabtu - Minggu ( Weekend )</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: IMAGE --}}
                    <div class="md:col-span-3 flex flex-col items-center">
                        <div class="transform rotate-3 hover:rotate-0 transition duration-500">
                            {{-- Ganti src ini dengan gambar contoh Frame A Anda --}}
                            <img src="{{ asset('images/paket/kcut.png') }}" alt="Frame A Example" class="w-32 md:w-40 shadow-md rounded">
                        </div>
                        <p class="text-xs text-gray-500 mt-3">( Frame A )</p>
                    </div>

                </div>
            </div>

            {{-- 2. BASIC PACKAGE --}}
            <div class="bg-[#FFFBF2] rounded-[3rem] shadow-lg p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

                    {{-- LEFT: TEXT --}}
                    <div class="md:col-span-5">
                        <h2 class="text-3xl font-serif text-gray-900 mb-6">Basic Package</h2>
                        <ul class="text-sm text-gray-700 space-y-2.5">
                            @foreach([
                                '15 menit sesi foto ( tanpa fotografer dengan remot khusus )',
                                '10 menit sesi memilih foto',
                                'Minimal 2 orang, Maksimal 5 orang( Frame A )',
                                'Bisa memilih warna background foto yang tersedia',
                                'Free semua soft file',
                                'Bonus hasil cetaknya yang sama untuk setiap orang ( Frame A/B/C/D )'
                            ] as $item)
                                <li class="flex items-start gap-3">
                                    <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                    <span class="leading-relaxed">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- CENTER: PRICE --}}
                    <div class="md:col-span-3 flex flex-col justify-center items-center md:items-start pl-0 md:pl-10 border-t md:border-t-0 md:border-l border-amber-100 pt-6 md:pt-0">
                        <div class="grid grid-cols-3 md:flex md:flex-col gap-x-4 items-center w-full">
                            <span class="text-amber-500 font-serif text-lg col-span-1 md:mb-2">Price :</span>
                            <div class="col-span-2 text-left">
                                <div class="mb-4">
                                    <p class="text-4xl font-serif text-amber-500">30K <span class="text-base font-sans text-amber-500">/Orang</span></p>
                                    <p class="text-xs text-amber-600 mt-1">Senin - Jumat ( Weekday )</p>
                                </div>
                                <div>
                                    <p class="text-4xl font-serif text-amber-500">35K <span class="text-base font-sans text-amber-500">/Orang</span></p>
                                    <p class="text-xs text-amber-600 mt-1">Sabtu - Minggu ( Weekend )</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: IMAGES (GRID) --}}
                    <div class="md:col-span-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <img src="{{ asset('images/paket/basic-1.png') }}" class="h-24 mx-auto shadow-sm" alt="A">
                                <p class="text-[10px] text-gray-500 mt-1">( Frame A )</p>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('images/paket/basic-2.png') }}" class="h-24 mx-auto shadow-sm" alt="B">
                                <p class="text-[10px] text-gray-500 mt-1">( Frame B )</p>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('images/paket/basic-3.png') }}" class="h-24 mx-auto shadow-sm" alt="C">
                                <p class="text-[10px] text-gray-500 mt-1">( Frame C )</p>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('images/paket/basic-4.png') }}" class="h-24 mx-auto shadow-sm" alt="D">
                                <p class="text-[10px] text-gray-500 mt-1">( Frame D )</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 3. SELF PASS PHOTO --}}
            <div class="bg-[#FFFBF2] rounded-[3rem] shadow-lg p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

                    {{-- LEFT: TEXT --}}
                    <div class="md:col-span-5">
                        <h2 class="text-3xl font-serif text-gray-900 mb-6">Self Pass Photo</h2>
                        <ul class="text-sm text-gray-700 space-y-2.5">
                            @foreach([
                                '5 menit sesi foto (tanpa fotografer dengan remot khusus)',
                                '10 menit sesi memilih foto',
                                'Bisa untuk 1 orang',
                                'Bebas pilih warna background ( Merah/Biru/Putih )',
                                'Tersedia kelengkapan jas dan dasi',
                                'Free semua soft file',
                                'Bonus hasil cetaknya satu set print foto (pilih salah satu ukuran)',
                                'Basic edit crop & brightness (no retouch/ganti background)'
                            ] as $item)
                                <li class="flex items-start gap-3">
                                    <span class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                    <span class="leading-relaxed">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- CENTER: PRICE --}}
                    <div class="md:col-span-3 flex items-center justify-center md:justify-start pl-0 md:pl-10 border-t md:border-t-0 md:border-l border-amber-100 pt-6 md:pt-0">
                        <div class="flex items-baseline gap-3">
                            <span class="text-amber-500 font-serif text-lg">Price:</span>
                            <p class="text-5xl font-serif text-amber-500">40K <span class="text-base font-sans text-amber-500">/Orang</span></p>
                        </div>
                    </div>

                    {{-- RIGHT: IMAGES --}}
                    <div class="md:col-span-4">
                        <div class="flex flex-wrap justify-center gap-6 items-end">
                            <div class="text-center">
                                <img src="{{ asset('images/paket/pass-photo-1.png') }}" class="w-16 shadow-sm mx-auto" alt="2x3">
                                <p class="text-[10px] text-gray-500 mt-1">( 2x3 )</p>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('images/paket/pass-photo-2.png') }}" class="w-16 shadow-sm mx-auto" alt="3x4">
                                <p class="text-[10px] text-gray-500 mt-1">( 3x4 )</p>
                            </div>
                            <div class="text-center">
                                <img src="{{ asset('images/paket/pass-photo-3.png') }}" class="w-20 shadow-sm mx-auto" alt="4x6">
                                <p class="text-[10px] text-gray-500 mt-1">( 4x6 )</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 4. ADDITIONAL --}}
            <div class="bg-[#FFFBF2] rounded-[3rem] shadow-lg p-8 md:p-12 mb-20">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div>
                        <h2 class="text-3xl font-serif text-gray-900 mb-6">Additional Print</h2>
                        <ul class="text-base text-gray-700 space-y-2 pl-4">
                            <li class="flex items-center gap-3">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                4R = 10k / Lembar
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-3xl font-serif text-gray-900 mb-6">Additional Time</h2>
                        <ul class="text-base text-gray-700 space-y-2 pl-4">
                            <li class="flex items-center gap-3">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                5 Menit = 20k
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection

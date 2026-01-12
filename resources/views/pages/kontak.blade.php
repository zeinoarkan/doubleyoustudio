@extends('layouts.app')

@section('content')
    <section class="bg-white min-h-screen flex flex-col font-sans overflow-x-hidden">

        {{-- Header Section --}}
        <div class="w-full pt-16 md:pt-24 px-6 text-center">
            <h1 class="text-4xl md:text-6xl text-gray-400 font-light tracking-tight">
                <span class="opacity-30">_</span>Contact <span class="text-amber-600 font-medium font-serif italic">Double You.</span>
            </h1>
            <p class="mt-4 md:mt-6 text-sm md:text-lg text-gray-400 max-w-xl mx-auto leading-relaxed">
                Punya pertanyaan atau ingin kolaborasi? <br class="hidden md:block"> Jangan ragu untuk menghubungi tim kami yaa!
            </p>
        </div>

        {{-- Grid Contact Section --}}
        <div class="flex-grow flex items-center justify-center py-12 md:py-20">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-16 md:gap-x-12 text-center w-full">

                {{-- Jam Operasional --}}
                <div class="flex flex-col items-center group">
                    <div class="mb-6 p-4 bg-gray-50 rounded-3xl transition-all group-hover:bg-amber-50">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm md:text-lg font-bold text-gray-900 mb-2 uppercase tracking-wider">Jam Buka</h3>
                    <p class="text-xs md:text-sm text-gray-500 leading-tight mb-1">Setiap Hari</p>
                    <p class="text-sm md:text-base font-bold text-amber-600">11:00 – 21:00</p>
                </div>

                {{-- WhatsApp --}}
                <div class="flex flex-col items-center group">
                    <div class="mb-6 p-4 bg-gray-50 rounded-3xl transition-all group-hover:bg-green-50">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm md:text-lg font-bold text-gray-900 mb-4 uppercase tracking-wider">Hubungi Kami</h3>
                    <a href="https://wa.me/6285641509533" target="_blank" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-green-500 text-green-600 rounded-full hover:bg-green-500 hover:text-white transition-all text-xs md:text-sm font-bold shadow-sm">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-4 h-4" alt="WA">
                        Hubungi Kami
                    </a>
                </div>

                {{-- Google Maps --}}
                <div class="flex flex-col items-center group">
                    <div class="mb-6 p-4 bg-gray-50 rounded-3xl transition-all group-hover:bg-blue-50">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm md:text-lg font-bold text-gray-900 mb-4 uppercase tracking-wider">Lokasi Studio</h3>
                    <a href="https://share.google/fur4axYC7qUsK1P4b" target="_blank" 
                       class="inline-flex items-center gap-2 px-6 py-2.5 border-2 border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition-all text-xs md:text-sm font-bold shadow-sm">
                        Google Maps
                    </a>
                </div>

                {{-- Email / Partnership --}}
                <div class="flex flex-col items-center group">
                    <div class="mb-6 p-4 bg-gray-50 rounded-3xl transition-all group-hover:bg-gray-200">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm md:text-lg font-bold text-gray-900 mb-2 uppercase tracking-wider">Partnership</h3>
                    <p class="text-xs md:text-sm text-gray-500 mb-2">Kerjasama bisnis?</p>
                    <a href="mailto:doubleyou@mail.com" class="text-sm md:text-base font-bold text-gray-800 hover:text-amber-600 transition-colors underline decoration-amber-200 underline-offset-4">
                        Email Kami
                    </a>
                </div>

            </div>
        </div>
    </section>
@endsection
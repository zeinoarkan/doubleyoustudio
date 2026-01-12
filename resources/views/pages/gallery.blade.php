@extends('layouts.app')

@section('content')

{{-- SECTION JUDUL (PUTIH) --}}
<section class="bg-white py-16 mb-10">
    <br>
    <br>
    <div class="max-w-6xl mx-auto px-6 text-center mb-20">
        <h1 class="text-5xl md:text-6xl text-gray-400 font-light">
            <span class="opacity-40">_</span>Gallery <span class="text-amber-600 font-medium font-serif">Double You.</span>
        </h1>
        <p class="mt-3 text-sm text-gray-400 max-w-xl mx-auto mb-5">
            "Here lies a catalog of photographs, where every captured moment breathes with
            memories that refuse to die."
        </p>
    </div>
</section>

{{-- SECTION GALLERY (ABU-ABU) --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image1.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image2.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image3.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image4.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image5.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image6.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image7.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image8.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image9.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image10.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image11.png" class="w-full h-auto object-cover" alt="">
            </div>

            <div class="p-4 shadow-sm">
                <img src="/images/gallery/image12.png" class="w-full h-auto object-cover" alt="">
            </div>

        </div>
    </div>
</section>

@endsection

@extends('layouts.layout')
@section('title', 'Selamat Datang di Inigadget')

@section('content')
    {{-- Hero Section --}}
    <div class="bg-blue-600 text-white py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight">
                Temukan Gadget Impianmu di Inigadget
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-blue-200 mb-8">
                Produk terbaru dan terbaik dari brand ternama. Dapatkan promo spesial hari ini!
            </p>
            <a href="{{ route('products') }}"
               class="inline-block bg-white text-blue-600 font-bold py-3 px-6 sm:px-8 rounded-full text-sm sm:text-base hover:bg-gray-100 transition duration-300">
                Belanja Sekarang
            </a>
        </div>
    </div>

    {{-- Produk Unggulan --}}
    @if(isset($featuredProducts) && $featuredProducts->count())
        <section class="py-16 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-10">Produk Unggulan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">

                    @foreach ($featuredProducts as $product)
                        <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                            <div class="bg-white rounded-xl shadow hover:shadow-lg transition-all duration-300 h-full flex flex-col">
                                <div class="w-full h-48 sm:h-52 md:h-56 lg:h-60 overflow-hidden rounded-t-xl">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                </div>
                                <div class="flex-grow flex flex-col p-4">
                                    <h3 class="font-semibold text-lg sm:text-xl text-gray-800 flex-grow line-clamp-2">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="mt-2 text-sm text-gray-500">
                                        {{ $product->brand->name }} • {{ $product->osType->name }}
                                    </div>
                                    <p class="text-blue-600 font-bold mt-2 text-base sm:text-lg">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </section>
    @endif
@endsection

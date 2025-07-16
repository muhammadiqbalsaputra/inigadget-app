@extends('layouts.layout')
@section('title', 'Selamat Datang di Inigadget')

@section('content')
    {{-- Hero Section --}}
    <div class="bg-blue-600 text-white py-20 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Temukan Gadget Impianmu di Inigadget</h1>
            <p class="text-lg md:text-xl text-blue-200 mb-8">
                Produk terbaru dan terbaik dari brand ternama. Dapatkan promo spesial hari ini!
            </p>
            <a href="{{ route('products') }}"
               class="bg-white text-blue-600 font-bold py-3 px-8 rounded-full text-lg hover:bg-gray-200 transition duration-300">
                Belanja Sekarang
            </a>
        </div>
    </div>

    {{-- Produk Unggulan --}}
    @if(isset($featuredProducts) && $featuredProducts->count())
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Produk Unggulan</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                    {{-- Perulangan untuk setiap produk unggulan --}}
                    @foreach ($featuredProducts as $product)
                        {{-- LINK INI SELALU MENGARAH KE DETAIL PRODUK --}}
                        <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                            {{-- Isi Kartu Produk --}}
                            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-all duration-300 h-full flex flex-col">
                                <div class="w-full h-48 mb-4">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-md">
                                </div>
                                <div class="flex-grow flex flex-col">
                                    <h3 class="font-semibold text-lg flex-grow">{{ $product->name }}</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">{{ $product->brand->name }} - {{ $product->osType->name }}</p>
                                        <p class="text-blue-600 font-bold mt-1 text-lg">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
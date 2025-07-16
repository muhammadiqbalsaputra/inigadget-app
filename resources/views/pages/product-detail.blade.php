@extends('layouts.layout')
@section('title', $product->name)

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <div class="flex flex-col md:flex-row gap-8">
        {{-- Gambar Produk --}}
        <div class="md:w-1/2">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-auto rounded shadow">
        </div>

        {{-- Detail Produk --}}
        <div class="md:w-1/2">
            <h1 class="text-3xl font-bold mb-3">{{ $product->name }}</h1>
            <p class="text-gray-600 mb-2">Brand: <strong>{{ $product->brand->name }}</strong></p>
            <p class="text-gray-600 mb-2">OS Type: <strong>{{ $product->osType->name }}</strong></p>
            <p class="text-gray-600 mb-2">Stok Tersedia: <strong>{{ $product->stock }}</strong> unit</p>
            <p class="text-blue-600 text-2xl font-bold mb-4">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </p>
            
            {{-- ======================================================= --}}
            {{--          KODE UNTUK FITUR TAMBAH KERANJANG          --}}
            {{-- ======================================================= --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6 border-t pt-6">
                @csrf
                <div class="flex items-center gap-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                               class="w-20 rounded border-gray-300 text-center shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
            
                    <div class="flex-grow">
                        <button type="submit"
                                class="w-full bg-green-500 text-white font-bold px-8 py-3 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                            + Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </form>
            {{-- ======================================================= --}}
            {{--                   AKHIR KODE KERANJANG                  --}}
            {{-- ======================================================= --}}
            
            <div class="mt-8">
                <h2 class="text-lg font-semibold">Deskripsi:</h2>
                <p class="text-gray-700 mt-1">{{ $product->description }}</p>
            </div>
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('products') }}"
               class="mt-6 inline-block text-blue-600 hover:text-blue-800 transition">
               ← Kembali ke Daftar Produk
            </a>
        </div>
    </div>
</div>


{{-- Produk Rekomendasi --}}
@if($relatedProducts->count())
    <div class="max-w-7xl mx-auto mt-16 px-4 sm:px-6 lg:px-8"> {{-- Tambah padding agar tidak terlalu mepet --}}
        <h2 class="text-2xl font-bold mb-6">Rekomendasi Produk Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->id) }}">
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">
                        <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-full h-40 object-cover rounded">
                        <h3 class="mt-2 font-semibold text-base md:text-lg">{{ $related->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $related->brand->name }} - {{ $related->osType->name }}</p>
                        <p class="text-blue-600 font-bold mt-1 text-sm md:text-base">
                            Rp{{ number_format($related->price, 0, ',', '.') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
@endsection
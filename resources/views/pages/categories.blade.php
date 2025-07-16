@extends('layouts.layout')
@section('title', 'Kategori')

@section('content')
    <div class="py-10">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-8 text-center">Kategori Produk</h2>

        {{-- === Brand Section === --}}
        <div class="mb-12">
            <h3 class="text-xl font-semibold mb-4 text-blue-600">Brand</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse ($brands as $brand)
                    <div class="bg-white border rounded-xl shadow hover:shadow-lg transition p-4 text-center">
                        <img src="{{ $brand->image_url }}" alt="{{ $brand->name }}"
                             class="w-16 h-16 mx-auto object-contain mb-2">
                        <p class="font-semibold text-gray-800 text-sm sm:text-base">{{ $brand->name }}</p>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500 text-center">Belum ada data brand.</p>
                @endforelse
            </div>
        </div>

        {{-- === OS Type Section === --}}
        <div>
            <h3 class="text-xl font-semibold mb-4 text-blue-600">Sistem Operasi</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @forelse ($osTypes as $os)
                    <div class="bg-white border rounded-xl shadow hover:shadow-lg transition p-4 text-center">
                        <img src="{{ $os->image_url }}" alt="{{ $os->name }}"
                             class="w-16 h-16 mx-auto object-contain mb-2">
                        <p class="font-semibold text-gray-800 text-sm sm:text-base">{{ $os->name }}</p>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500 text-center">Belum ada data OS.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

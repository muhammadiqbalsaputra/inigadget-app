@extends('layouts.layout')
@section('title', 'Kategori')

@section('content')
<h2 class="text-2xl font-bold mb-6">Kategori Produk</h2>

{{-- === Brand Section === --}}
<h3 class="text-xl font-semibold mb-3 text-blue-600">Brand</h3>
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 mb-10">
    @forelse ($brands as $brand)
        <div class="bg-white border rounded-xl shadow hover:shadow-md transition p-4 text-center">
            <img src="{{ $brand->image_url }}" alt="{{ $brand->name }}" class="w-16 h-16 mx-auto object-contain mb-2">
            <p class="font-semibold text-gray-800">{{ $brand->name }}</p>
        </div>
    @empty
        <p class="col-span-full text-gray-500">Belum ada data brand.</p>
    @endforelse
</div>

{{-- === OS Type Section === --}}
<h3 class="text-xl font-semibold mb-3 text-blue-600">Sistem Operasi</h3>
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
    @forelse ($osTypes as $os)
        <div class="bg-white border rounded-xl shadow hover:shadow-md transition p-4 text-center">
            <img src="{{ $os->image_url }}" alt="{{ $os->name }}" class="w-16 h-16 mx-auto object-contain mb-2">
            <p class="font-semibold text-gray-800">{{ $os->name }}</p>
        </div>
    @empty
        <p class="col-span-full text-gray-500">Belum ada data OS.</p>
    @endforelse
</div>
@endsection

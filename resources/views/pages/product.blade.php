@extends('layouts.layout')
@section('title', 'Daftar Produk')

@section('content')
<div class="max-w-7xl mx-auto mt-10 p-4 sm:p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center sm:text-left">Daftar Produk</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('products') }}"
          class="mb-8 bg-white rounded-xl shadow p-4 flex flex-col sm:flex-row sm:items-end sm:space-x-4 space-y-4 sm:space-y-0">

        <div class="w-full sm:w-1/3">
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <select name="brand" id="brand" class="w-full border rounded-md px-3 py-2">
                <option value="">Semua Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full sm:w-1/3">
            <label for="os" class="block text-sm font-medium text-gray-700">Sistem Operasi</label>
            <select name="os" id="os" class="w-full border rounded-md px-3 py-2">
                <option value="">Semua OS</option>
                @foreach($ostypes as $os)
                    <option value="{{ $os->id }}" {{ request('os') == $os->id ? 'selected' : '' }}>
                        {{ $os->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex space-x-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                Filter
            </button>

            @if(request('brand') || request('os'))
                <a href="{{ route('products') }}"
                   class="px-4 py-2 text-gray-600 hover:text-gray-800 hover:underline text-sm">
                    Reset Filter
                </a>
            @endif
        </div>
    </form>

    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="block h-full group">
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition-all duration-300 h-full flex flex-col">
                        <div class="w-full h-48 mb-4 overflow-hidden">
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover rounded-md transform group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="flex-grow flex flex-col">
                            <h3 class="font-semibold text-lg flex-grow">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $product->brand->name }} - {{ $product->osType->name }}</p>
                            <p class="text-blue-600 font-bold mt-2 text-lg">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 py-16">Tidak ada produk yang ditemukan.</p>
    @endif
</div>
@endsection

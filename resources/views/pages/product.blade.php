@extends('layouts.layout')
@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto mt-10 p-4 sm:p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Produk</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('products') }}" class="mb-6 flex flex-wrap gap-4">
        <div>
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <select name="brand" id="brand" class="border rounded-md px-3 py-2">
                <option value="">Semua Brand</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="os" class="block text-sm font-medium text-gray-700">OS Type</label>
            <select name="os" id="os" class="border rounded-md px-3 py-2">
                <option value="">Semua OS</option>
                @foreach($ostypes as $os)
                    <option value="{{ $os->id }}" {{ request('os') == $os->id ? 'selected' : '' }}>
                        {{ $os->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filter
            </button>
        </div>

        @if(request('brand') || request('os'))
            <div class="flex items-end">
                <a href="{{ route('products') }}" class="text-sm text-gray-500 hover:underline">Reset Filter</a>
            </div>
        @endif
    </form>

    @if(isset($products) && $products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="block h-full">
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
    @else
        <p class="text-center text-gray-500 py-10">Tidak ada produk yang ditemukan.</p>
    @endif
</div>
@endsection

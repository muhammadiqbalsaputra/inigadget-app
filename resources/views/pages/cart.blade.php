@extends('layouts.layout')
@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mx-auto mt-10 p-4 sm:p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Keranjang Belanja Anda</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4">Produk</th>
                        <th scope="col" class="px-6 py-4">Harga Satuan</th>
                        <th scope="col" class="px-6 py-4 text-center">Jumlah</th>
                        <th scope="col" class="px-6 py-4 text-right">Subtotal</th>
                        <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <tr class="bg-white border-b hover:bg-gray-50 align-middle">
                            <td class="px-6 py-4 font-semibold text-gray-900 flex items-center gap-4">
                                <img src="{{ $details['image_url'] }}" alt="{{ $details['name'] }}" class="w-16 h-16 object-cover rounded">
                                <span>{{ $details['name'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format($details['price']) }}
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex justify-center items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" 
                                           class="w-16 text-center border rounded-md py-1" min="1">
                                    <button type="submit" class="text-xs text-blue-500 hover:text-blue-700 ml-2 font-semibold uppercase" title="Update jumlah">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold">
                                Rp{{ number_format($details['price'] * $details['quantity']) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:text-red-800" title="Hapus item">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex flex-col md:flex-row justify-between items-start">
            <a href="{{ route('products') }}" class="text-blue-600 hover:underline mb-4 md:mb-0">
                ← Lanjut Belanja
            </a>
            <div class="text-right w-full md:w-auto bg-gray-50 p-6 rounded-lg">
                <p class="text-lg text-gray-600">Total Belanja</p>
                <p class="text-3xl font-bold text-gray-900">Rp{{ number_format($total) }}</p>
                
                {{-- Tombol ini akan mengarah ke halaman checkout nanti --}}
                <a href="#" class="inline-block mt-4 w-full text-center bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                    Lanjutkan ke Checkout →
                </a>
            </div>
        </div>

    @else
        <div class="text-center py-20 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Keranjang Anda Kosong</h2>
            <p class="text-gray-500 mb-6">Sepertinya Anda belum menambahkan produk apapun.</p>
            <a href="{{ route('products') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Mulai Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
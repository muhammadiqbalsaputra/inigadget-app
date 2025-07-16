@extends('layouts.layout')
@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mx-auto mt-10 p-4 sm:p-6">
    <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-800">Keranjang Belanja Anda</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-500">
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
                        @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-900 flex items-center gap-4">
                                <img src="{{ $details['image_url'] }}" alt="{{ $details['name'] }}"
                                     class="w-16 h-16 object-cover rounded">
                                <span class="text-sm sm:text-base">{{ $details['name'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format($details['price'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex justify-center items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                                           class="w-16 text-center border rounded-md py-1" min="1">
                                    <button type="submit"
                                            class="text-xs text-blue-500 hover:text-blue-700 ml-2 font-semibold uppercase"
                                            title="Update jumlah">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold">
                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-sm font-medium text-red-600 hover:text-red-800"
                                            title="Hapus item">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total & Checkout --}}
        <div class="mt-8 flex flex-col md:flex-row justify-between items-start gap-4">
            <a href="{{ route('products') }}" class="text-blue-600 hover:underline text-sm sm:text-base">
                ← Lanjut Belanja
            </a>

            <div class="bg-gray-50 p-6 rounded-lg w-full md:w-1/3 shadow">
                <p class="text-base text-gray-600 mb-1">Total Belanja</p>
                <p class="text-2xl font-bold text-gray-900 mb-4">
                    Rp{{ number_format($total, 0, ',', '.') }}
                </p>
                <a href="#"
                   class="block w-full text-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    Lanjutkan ke Checkout →
                </a>
            </div>
        </div>
    @else
        {{-- Jika kosong --}}
        <div class="text-center py-20 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">Keranjang Anda Kosong</h2>
            <p class="text-gray-500 mb-6">Sepertinya Anda belum menambahkan produk apapun.</p>
            <a href="{{ route('products') }}"
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Mulai Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection

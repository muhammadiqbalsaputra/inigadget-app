<x-layouts.app :title="__('Daftar Produk')">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-white">Daftar Produk</h1>
    </div>

    @if(session('successMessage'))
        <div class="p-4 bg-green-100 text-green-800 rounded mb-4">
            {{ session('successMessage') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <form methoAd="get" action="{{ route('product1.index') }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                class="border rounded px-3 py-2" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
        </form>

        <a href="{{ route('product1.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            + Tambah Produk
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded overflow-hidden">
            <thead>
                <tr class="bg-blue-600 text-white text-left">
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">SKU</th>
                    <th class="px-4 py-3">Brand</th>
                    <th class="px-4 py-3">OS</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3">On/Off</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product1 as $index => $item)
                    <tr
                        class="{{ $loop->odd ? 'bg-gray-50' : 'bg-white' }}  text-black hover:bg-blue-50 transition-colors duration-200">
                        <td class="px-4 py-3">{{ $product1->firstItem() + $index }}</td>

                        {{-- Gambar --}}
                        <td class="px-4 py-3">
                            @if($item->image)
                                <img src="{{ $item->image }}" alt="Gambar {{ $item->name }}"
                                    class="w-16 h-16 object-cover rounded border" />
                            @else
                                <span class="inline-block bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">N/A</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->name }}</td>
                        <td class="px-4 py-3 text-gray-600 text-sm">{{ $item->slug }}</td>
                        <td class="px-4 py-3 text-black">{{ $item->sku }}</td>
                        <td class="px-4 py-3 text-black">{{ $item->brand->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-black">{{ $item->ostype->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-blue-700 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">{{ $item->stock }}</td>
                        <!-- <td class="px-4 py-3">
                                @if($item->is_active)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-semibold">On</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm font-semibold">Off</span>
                                @endif
                            </td> -->
                        <td>
                            <form id="sync-product-{{ $item->id }}" action="{{ route('products.sync', $item->id) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="is_active"
                                    value="@if($item->hub_product_id) 1 @else 0 @endif">
                                @if($item->hub_product_id)
                                    <flux:switch checked
                                        onchange="document.getElementById('sync-product-{{ $item->id }}').submit()" />
                                @else
                                    <flux:switch
                                        onchange="document.getElementById('sync-product-{{ $item->id }}').submit()" />
                                @endif
                            </form>
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('product1.edit', $item->id) }}"
                                class="inline-block text-sm bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>

                            <form action="{{ route('product1.destroy', $item->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-block text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="mt-4">
        {{ $product1->links() }}
    </div>
</x-layouts.app>
<x-layouts.app :title="__('Brands')">
    @push('head')

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(to right, #e0f2f1, #f3e5f5);
            }
        </style>
    @endpush

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Brands</h1>
        <p class="text-gray-600">Manajemen Brand Produk</p>
    </div>

    @if(session('successMessage'))
        <div class="p-4 bg-green-100 text-green-800 rounded mb-4">
            {{ session('successMessage') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-3">
        <form method="get" action="{{ route('brand.index') }}" class="flex w-full md:w-auto">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari Brand..."
                class="border border-gray-300 rounded-l px-4 py-2 w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r hover:bg-blue-700 transition">
                Cari
            </button>
        </form>

        <a href="{{ route('brand.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            + Tambah Brand
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full text-sm text-left text-gray-800">
            <thead class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Gambar</th> <!-- Dipindahkan -->
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3">On/Off</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($brand as $key => $item)
                    <tr class="{{ $loop->odd ? 'bg-gray-50' : 'bg-white' }} hover:bg-purple-500 transition duration-150">
                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $brand->firstItem() + $key }}
                        </td>

                        <td class="px-6 py-4"> <!-- Gambar dipindahkan ke sini -->
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                    class="w-12 h-12 rounded object-cover border shadow">
                            @else
                                <span class="inline-block bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">N/A</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 font-semibold text-indigo-700">
                            {{ $item->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600 max-w-sm truncate">
                            {{ \Illuminate\Support\Str::limit($item->description, 100) }}
                        </td>

                        <td class="">
                            <form id="sync-category-{{ $item->id }}" action="{{ route('category.sync', $item->id) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="is_active" value="{{ $item->hub_category_id ? 1 : 0 }}">
                                <input type="checkbox" {{ $item->hub_category_id ? 'checked' : '' }}
                                    class="w-6 h-6 rounded-full border {{ $item->hub_category_id ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600' }}"
                                    onchange="document.getElementById('sync-category-{{ $item->id }}').submit()" />

                            </form>
                        </td>

                        <td class="px-6 py-4 relative text-sm" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="p-1 bg-gray-100 rounded hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-400">
                                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm7-2a2 2 0 100 4 2 2 0 000-4zm-7 4a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute z-20 right-0 mt-2 w-36 bg-white border border-gray-200 rounded shadow-md"
                                x-cloak>
                                <a href="{{ route('brand.edit', $item->id) }}"
                                    class="flex items-center gap-2 px-4 py-2 text-indigo-600 hover:bg-indigo-100">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('brand.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus brand ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-2 w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="mt-6">
        {{ $brand->links('pagination::tailwind') }}
    </div>
</x-layouts.app>
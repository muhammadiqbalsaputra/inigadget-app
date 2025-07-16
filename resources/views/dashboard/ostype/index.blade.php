<x-layouts.app :title="__('Daftar OS Type')">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar OS Type</h1>
    </div>

    @if(session('successMessage'))
        <div class="p-4 bg-green-100 text-green-800 rounded mb-4">
            {{ session('successMessage') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <form method="get" action="{{ route('ostype.index') }}">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari OS..."
                   class="border rounded px-3 py-2 shadow-sm focus:ring focus:border-blue-300" />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Cari
            </button>
        </form>

        <a href="{{ route('ostype.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            + Tambah OS
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded overflow-hidden">
            <thead>
                <tr class="bg-blue-600 text-white text-left">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Dibuat Pada</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ostype as $index => $item)
                    <tr class="{{ $loop->odd ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition duration-200">
                        <td class="px-4 py-3 text-gray-800">{{ $ostype->firstItem() + $index }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->name }}</td>
                        <td class="px-4 py-3">
                            @if($item->image_url)
                                <img src="{{ $item->image_url }}"
                                     alt="Gambar OS"
                                     class="w-12 h-12 object-cover rounded border">
                            @else
                                <span class="inline-block bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">N/A</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-600 text-sm">
                            {{ $item->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('ostype.edit', $item->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm transition">
                                    Edit
                                </a>

                                <form action="{{ route('ostype.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus OS ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $ostype->links() }}
    </div>
</x-layouts.app>

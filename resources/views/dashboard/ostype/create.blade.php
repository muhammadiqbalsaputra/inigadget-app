<x-layouts.app :title="__('Tambah OS Type')">
    <h1 class="text-2xl font-bold mb-4">Tambah OS Type</h1>

    @if(session('errorMessage'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('errorMessage') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('ostype.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-semibold">Nama OS</label>
            <input
                type="text"
                name="name"
                id="name"
                class="border rounded w-full p-2"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block font-semibold">URL Gambar</label>
            <input
                type="url"
                name="image"
                id="image"
                class="border rounded w-full p-2"
                value="{{ old('image') }}"
                placeholder="https://example.com/image.png"
                required
            >
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>

            <a href="{{ route('ostype.index') }}" class="text-gray-600 hover:underline self-center">
                Batal
            </a>
        </div>
    </form>
</x-layouts.app>
<x-layouts.app :title="('Tambah Brand')">
    <h1 class="text-2xl font-bold mb-4">Tambah Brand</h1>

    @if(session('errorMessage'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('errorMessage') }}
        </div>
    @endif

    <form method="POST" action="{{ route('brand.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block">Nama Brand</label>
            <input type="text" name="name" class="border rounded w-full p-2" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="slug" class="block">Slug</label>
            <input type="text" name="slug" class="border rounded w-full p-2" value="{{ old('slug') }}">
            @error('slug') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block">Deskripsi</label>
            <textarea name="description" class="border rounded w-full p-2">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block">Image URL (opsional)</label>
            <input type="url" name="image" placeholder="https://contoh.com/logo.png" class="border rounded w-full p-2"
                value="{{ old('image') }}">
            @error('image') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>


        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</x-layouts.app>

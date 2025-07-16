<x-layouts.app :title="__('Edit Produk')">
    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

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

    <form method="POST" action="{{ route('product1.update', $product1->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product1->name) }}" class="border rounded w-full p-2">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">SKU</label>
            <input type="text" name="sku" value="{{ old('sku', $product1->sku) }}" class="border rounded w-full p-2">
            @error('sku') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="description" class="border rounded w-full p-2">{{ old('description', $product1->description) }}</textarea>
            @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Harga</label>
            <input type="number" name="price" value="{{ old('price', $product1->price) }}" step="0.01" class="border rounded w-full p-2">
            @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Stok</label>
            <input type="number" name="stock" value="{{ old('stock', $product1->stock) }}" class="border rounded w-full p-2">
            @error('stock') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">URL Gambar</label>
            <input type="url" name="image_url" value="{{ old('image_url', $product1->image_url) }}" class="border rounded w-full p-2">
            @error('image_url') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Brand</label>
            <select name="brand_id" class="border rounded w-full p-2">
                <option value="">-- Pilih Brand --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $product1->brand_id) == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">OS Type</label>
            <select name="os_type_id" class="border rounded w-full p-2">
                <option value="">-- Pilih OS --</option>
                @foreach($osTypes as $os)
                    <option value="{{ $os->id }}" {{ old('os_type_id', $product1->os_type_id) == $os->id ? 'selected' : '' }}>
                        {{ $os->name }}
                    </option>
                @endforeach
            </select>
            @error('os_type_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Status Aktif</label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" class="mr-2"
                    {{ old('is_active', $product1->is_active) ? 'checked' : '' }}>
                <span>Aktifkan Produk</span>
            </label>
            @error('is_active') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Perbarui</button>
        <a href="{{ route('product1.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
    </form>
</x-layouts.app>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product1;
use App\Models\Brand;
use App\Models\OsType;
use Illuminate\Support\Str;

class Product1Controller extends Controller
{
    public function index(Request $request)
    {
        $product1 = Product1::with(['brand', 'ostype']);

        if ($request->filled('search')) {
            $product1->where('name', 'like', '%' . $request->search . '%');
        }

        return view('dashboard.product1.index', [
            'product1' => $product1->paginate(10),
        ]);
    }

    public function create()
    {
        $brands = Brand::all();
        $osTypes = OsType::all(); // ← pastikan variabel ini bernama osTypes

        return view('dashboard.product1.create', [
            'brands' => $brands,
            'osTypes' => $osTypes, // ← kirim dengan nama yang sama seperti di view
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'brand_id' => 'required|exists:brands,id',
            'os_type_id' => 'required|exists:os_types,id',
            'image_url' => 'nullable|url',
            'is_active' => 'required|boolean',
        ]);

        $product1 = new Product1;
        $product1->name = $request->name;
        $product1->slug = Str::slug($request->name);
        $product1->sku = 'PRD-' . now()->format('YmdHis') . strtoupper(Str::random(3)); // ← auto SKU
        $product1->description = $request->description;
        $product1->price = $request->price;
        $product1->stock = $request->stock;
        $product1->brand_id = $request->brand_id;
        $product1->os_type_id = $request->os_type_id;
        $product1->image_url = $request->image_url;
        $product1->is_active = $request->is_active;
        $product1->save();

        return redirect()->route('product1.index')->with('successMessage', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $product1 = Product1::findOrFail($id);
        $brands = Brand::all();
        $osTypes = OsType::all();

        return view('dashboard.product1.edit', [
            'product1' => $product1,
            'brands' => $brands,
            'osTypes' => $osTypes,
        ]);
        
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'brand_id' => 'required|exists:brands,id',
            'os_type_id' => 'required|exists:os_types,id',
            'image_url' => 'nullable|url',
            'is_active' => 'required|boolean',
        ]);

        $product1 = Product1::findOrFail($id);
        $product1->name = $request->name;
        $product1->slug = Str::slug($request->name);
        $product1->description = $request->description;
        $product1->price = $request->price;
        $product1->stock = $request->stock;
        $product1->brand_id = $request->brand_id;
        $product1->os_type_id = $request->os_type_id;
        $product1->image_url = $request->image_url;
        $product1->is_active = $request->is_active;
        $product1->save();

        return redirect()->route('product1.index')->with('successMessage', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $product1 = Product1::findOrFail($id);
        $product1->delete();

        return redirect()->route('product1.index')->with('successMessage', 'Produk berhasil dihapus.');
    }
}
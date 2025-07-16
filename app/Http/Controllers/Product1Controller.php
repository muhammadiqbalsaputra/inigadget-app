<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product1;
use App\Models\Brand;
use App\Models\OsType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


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
        $osTypes = OsType::all();

        return view('dashboard.product1.create', [
            'brands' => $brands,
            'osTypes' => $osTypes,
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

    public function sync($id, Request $request)
    {
        $product = Product1::findOrFail($id);

        $response = Http::post('https://api.phb-umkm.my.id/api/product/sync', [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'seller_product_id' => (string) $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
            'sku' => $product->sku,
            'image_url' => $product->image_url,
            'weight' => $product->weight,
            'is_active' => $request->is_active == 1 ? false : true,
            'category_id' => (string) $product->brand->hub_category_id,
        ]);

        if ($response->successful() && isset($response['product_id'])) {
            $product->hub_product_id = $request->is_active == 1 ? null : $response['product_id'];
            $product->save();
        }

        session()->flash('successMessage', 'Product Synced Successfully');
        return redirect()->back();
    }
}

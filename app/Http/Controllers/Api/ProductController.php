<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return new ProductResource($products, 200, 'List Produk');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'sku' => 'required|string|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'os_type_id' => 'required|exists:os_types,id',
            'image_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = new Product($request->only(
            'name',
            'slug',
            'sku',
            'price',
            'stock',
            'description',
            'brand_id',
            'os_type_id'
        ));

        // Simpan gambar dari URL jika diberikan
        if ($request->image_url) {
            try {
                $imageContent = file_get_contents($request->image_url);
                $extension = pathinfo(parse_url($request->image_url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                $filename = 'uploads/products/' . uniqid() . '.' . $extension;
                \Storage::disk('public')->put($filename, $imageContent);
                $product->image_url = $filename;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal mengunduh gambar dari URL'], 422);
            }
        }

        $product->save();

        return new ProductResource($product, 201, 'Produk berhasil dibuat');
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product, 200, 'Detail Produk');
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'sku' => 'required|string|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'os_type_id' => 'required|exists:os_types,id',
            'image_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = new Product($request->only(
            'name',
            'slug',
            'sku',
            'price',
            'stock',
            'description',
            'brand_id',
            'os_type_id'
        ));

        // Simpan gambar dari URL jika diberikan
        if ($request->image_url) {
            try {
                $imageContent = file_get_contents($request->image_url);
                $extension = pathinfo(parse_url($request->image_url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                $filename = 'uploads/products/' . uniqid() . '.' . $extension;
                \Storage::disk('public')->put($filename, $imageContent);
                $product->image_url = $filename;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal mengunduh gambar dari URL'], 422);
            }
        }

        $product->save();

        return new ProductResource($product, 201, 'Produk berhasil dibuat');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
    }
}

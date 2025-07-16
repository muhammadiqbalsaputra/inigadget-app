<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\OsType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // app/Http/Controllers/ProductController.php
    // ProductController.php
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'osType']);

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->filled('os')) {
            $query->where('os_type_id', $request->os);
        }

        $products = $query->get();

        // Ambil semua brand dan os untuk filter
        $brands = \App\Models\Brand::all();
        $ostypes = \App\Models\OsType::all();

        return view('pages.product', compact('products', 'brands', 'ostypes'));
    }

    public function show($id)
    {
        $product = Product::with(['brand', 'osType'])->findOrFail($id);

        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('brand_id', $product->brand_id)
                    ->orWhere('os_type_id', $product->os_type_id);
            })
            ->limit(4)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }
}
?>
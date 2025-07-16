<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Http;

class ProductBrandsController extends Controller
{
    public function index(Request $request)
    {
        $brand = Brand::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%');
            })
            ->paginate(10);

        return view('dashboard.brand.index', [
            'brand' => $brand,
            'q' => $request->q,
        ]);
    }

    public function create()
    {
        return view('dashboard.brand.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug',
            'description' => 'required',
            'image' => 'nullable|url', // ✅ gambar opsional
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('errorMessage', 'Validasi Error, Silahkan lengkapi data terlebih dahulu');
        }

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->description = $request->description;
        $brand->image_url = $request->image; // null juga boleh
        $brand->save();

        return redirect()->route('brand.index')->with('successMessage', 'Brand berhasil disimpan.');
    }



    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('dashboard.brand.detail', ['brand' => $brand]);
    }

    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('dashboard.brand.edit', ['brand' => $brand]);
    }

    public function update(Request $request, string $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,' . $id,
            'description' => 'required',
            'image' => 'nullable|url', // ✅ gambar opsional
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('errorMessage', 'Validasi Error, Silahkan lengkapi data terlebih dahulu');
        }

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->description = $request->description;
        $brand->image_url = $request->image; // null juga boleh
        $brand->save();

        return redirect()->route('brand.index')->with('successMessage', 'Data brand berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->back()->with('successMessage', 'Data berhasil dihapus.');
    }

    public function sync($id, Request $request)
      {
          $brand = brand::findOrFail($id);
          
          $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
              'client_id' => env('CLIENT_ID'),
              'client_secret' => env('CLIENT_SECRET'),
              'seller_product_category_id' => (string) $brand->id,
              'name' => $brand->name,
              'description' => $brand->description,
              'is_active' => $request->is_active == 1 ? false : true,
          ]);
  
          if ($response->successful() && isset($response['product_category_id'])) {
              $brand->hub_category_id = $request->is_active == 1 ? null : $response['product_category_id'];
              $brand->save();
          }
  
          session()->flash('successMessage', 'Category Synced Successfully');
          return redirect()->back();
      }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\Brand;
use App\Models\OsType;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Ambil 8 produk terbaru untuk ditampilkan di halaman utama
        $featuredProducts = Product::latest()->take(8)->get();

        // Ambil semua data Brand dan OS Type untuk ditampilkan di homepage
        $brands = Brand::all();
        $osTypes = OsType::all();

        // Kirim data ke view 'pages.home' dengan nama variabel yang sesuai
        return view('pages.home', compact('featuredProducts', 'brands', 'osTypes'));
    }

    public function categories()
    {
        $brands = Brand::all();
        $osTypes = OsType::all();
        return view('pages.categories', compact('brands', 'osTypes'));
    }

    public function about()
    {
        return view('pages.about');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product; // <--- PASTIKAN INI ADA
use Illuminate\Http\Request;
use \App\Models\Brand;
use \App\Models\OsType;

class PageController extends Controller
{
    public function home()
    {
        // Ambil 8 produk terbaru untuk ditampilkan di halaman utama
        $featuredProducts = Product::latest()->take(8)->get();

        // Kirim data ke view dengan nama variabel 'featuredProducts'
        return view('pages.home', compact('featuredProducts'));
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



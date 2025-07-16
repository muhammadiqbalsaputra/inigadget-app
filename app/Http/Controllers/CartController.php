<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);
        
        // Kirim data ke view 'pages.cart'
        return view('pages.cart', compact('cart'));
    }

    /**
     * Menambah produk ke dalam keranjang.
     */
    public function add(Request $request, Product $product)
    {
        // Validasi input kuantitas
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        // Ambil keranjang dari session, jika tidak ada, buat array kosong
        $cart = session()->get('cart', []);
        
        // Cek apakah produk sudah ada di keranjang
        if (isset($cart[$product->id])) {
            // Jika sudah ada, tambahkan jumlahnya saja
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            // Jika belum ada, tambahkan sebagai item baru
            $cart[$product->id] = [
                "name"      => $product->name,
                "quantity"  => $request->quantity,
                "price"     => $product->price,
                "image_url" => $product->image_url
            ];
        }
        
        // Simpan kembali keranjang yang sudah diperbarui ke dalam session
        session()->put('cart', $cart);

        // Arahkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Memperbarui kuantitas produk di dalam keranjang.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari keranjang.
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan halaman utama untuk user
    public function index()
    {
        $products = Product::all(); // Mengambil semua produk
        return view('user.home', compact('products'));
    }

    // Menambahkan produk ke keranjang
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Logika untuk menambahkan produk ke keranjang (misalnya disimpan di sesi atau database)
        $cart = session()->get('cart', []);
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity ?? 1,
        ];
        session()->put('cart', $cart);

        return redirect()->route('user.cart')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Melihat isi keranjang
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }

    // Checkout produk di keranjang
    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Logika checkout (misalnya simpan ke database transaksi)
        session()->forget('cart');

        return redirect('/')->with('success', 'Pesanan berhasil diproses!');
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Menambahkan produk ke keranjang
    public function addToCart($id, Request $request)
    {
        $cart = session('cart', []);
        $cart[$id] = [
            'quantity' => $request->quantity,
            'product_id' => $id
        ];

        session(['cart' => $cart]);

        return redirect()->route('user.cart');
    }

    // Menampilkan keranjang
    public function viewCart()
    {
        $cart = session('cart', []);
        return view('user.cart', compact('cart'));
    }

    // Menghapus produk dari keranjang
    public function removeFromCart($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);

        session(['cart' => $cart]);

        return redirect()->route('user.cart');
    }

    // Checkout dan halaman transaksi
    public function checkout()
    {
        // Proses checkout (misalnya: simpan transaksi ke database)
        session()->forget('cart');  // Mengosongkan keranjang setelah checkout

        return redirect()->route('user.transaction');
    }

    // Menampilkan halaman transaksi
    public function transaction()
    {
        return view('user.transaction');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    // Menampilkan halaman profil user
    public function profile()
    {
        return view('user.profile');
    }

    // Mengupdate profil user
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar upload
        ]);

        $user = Auth::user();

        // Update name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Store the new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            
            // Delete old avatar if exists
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            // Update avatar path
            $user->avatar = $avatarPath;
        }

        // Save changes
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}

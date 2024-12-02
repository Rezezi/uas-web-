<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari input
        $search = $request->input('search');

        // Jika ada query pencarian, filter produk berdasarkan nama atau kategori
        if ($search) {
            $products = Product::where('name', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%')
                ->get();
        } else {
            // Jika tidak ada pencarian, tampilkan semua produk
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }

    // Menampilkan form untuk menambahkan produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required|string|max:500',
            ]);

            // Simpan file gambar
            $imagePath = $request->file('image')->store('products', 'public');

            // Simpan ke database
            Product::create([
                'name' => $validated['name'],
                'category' => $validated['category'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'image' => $imagePath,
                'description' => $validated['description'],
            ]);

            return redirect()->route('products.index')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Menemukan produk berdasarkan ID
        return view('products.edit', compact('product')); // Mengirim data produk ke view edit
    }

    // Menyimpan perubahan produk ke database
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar bersifat opsional saat update
                'description' => 'required|string|max:500',
            ]);

            $product = Product::findOrFail($id); // Menemukan produk berdasarkan ID

            // Jika ada gambar baru, simpan gambar dan perbarui path gambar
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                Storage::delete('public/' . $product->image);  // <-- Menggunakan Storage disini
                
                // Simpan gambar baru
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath; // Perbarui path gambar
            }

            // Perbarui data produk
            $product->update([
                'name' => $validated['name'],
                'category' => $validated['category'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'description' => $validated['description'],
            ]);

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // Menghapus produk dari database
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id); // Menemukan produk berdasarkan ID

            // Hapus gambar terkait jika ada
            Storage::delete('public/' . $product->image);  // <-- Menggunakan Storage disini

            // Hapus produk dari database
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

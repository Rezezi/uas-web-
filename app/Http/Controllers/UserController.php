<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Tampilkan daftar buku yang tersedia
    public function index()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('user.books', compact('books'));
    }

    // Pinjam buku
    public function borrow($id)
    {
        $book = Book::findOrFail($id);

        if ($book->stock > 0) {
            $book->decrement('stock');

            Borrow::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'borrowed_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        }

        return redirect()->back()->with('error', 'Stok buku habis.');
    }

    // Kembalikan buku
    public function returnBook($id)
    {
        $borrow = Borrow::where('user_id', Auth::id())
                        ->where('book_id', $id)
                        ->whereNull('returned_at')
                        ->first();

        if ($borrow) {
            $book = $borrow->book;
            $book->increment('stock');
            $borrow->update(['returned_at' => now()]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        }

        return redirect()->back()->with('error', 'Buku tidak ditemukan atau sudah dikembalikan.');
    }

    // Tampilkan buku yang sedang dipinjam oleh pengguna
    public function borrowedBooks()
    {
        $borrows = Borrow::where('user_id', Auth::id())
                         ->whereNull('returned_at')
                         ->with('book')
                         ->get();

        return view('user.borrowed_books', compact('borrows'));
    }

    // Tampilkan riwayat peminjaman buku oleh pengguna
    public function borrowHistory()
    {
        $borrows = Borrow::where('user_id', Auth::id())
                         ->with('book')
                         ->get();

        return view('user.borrow_history', compact('borrows'));
    }

    // Tampilkan riwayat pengembalian buku oleh pengguna
    public function returnHistory()
    {
        $returns = Borrow::where('user_id', Auth::id())
                         ->whereNotNull('returned_at')
                         ->with('book')
                         ->get();

        return view('user.return_history', compact('returns'));
    }

    // Tampilkan halaman keranjang
    public function cart()
    {
        $borrows = Borrow::where('user_id', Auth::id())
                         ->whereNull('returned_at')
                         ->with('book')
                         ->get();

        return view('user.cart', compact('borrows'));
    }
}

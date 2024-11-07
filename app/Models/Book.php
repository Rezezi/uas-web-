<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'year', 'stock', 'genre'];

    // Relasi dengan model Borrow
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Memeriksa apakah buku sedang dipinjam oleh pengguna tertentu
    public function isBorrowedByUser($userId)
    {
        return $this->borrows()->where('user_id', $userId)->whereNull('returned_at')->exists();
    }
}

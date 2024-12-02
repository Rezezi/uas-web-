<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel 'products'.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk
            $table->text('description'); // Deskripsi produk
            $table->decimal('price', 10, 2); // Harga produk
            $table->integer('stock'); // Stok produk
            $table->string('category'); // Kategori produk
            $table->string('image')->nullable(); // Kolom untuk menyimpan nama file foto (opsional)
            $table->timestamps(); // Tanggal dibuat dan diupdate
        });
    }

    /**
     * Hapus tabel 'products' jika migrasi di-rollback.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

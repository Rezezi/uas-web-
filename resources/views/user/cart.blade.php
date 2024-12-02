@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-3">Keranjang Belanja</h3>

    @if(session('cart') && count(session('cart')) > 0)
    <div class="row">
        @foreach(session('cart') as $id => $item)
        @php
            // Ambil produk berdasarkan ID
            $product = \App\Models\Product::find($id);
        @endphp

        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4">
                        <!-- Gambar produk -->
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                            <p class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div class="d-flex align-items-center">
                                    <!-- Menampilkan jumlah -->
                                    <span class="me-3">Jumlah: {{ $item['quantity'] }}</span>
                                </div>
                                <a href="{{ route('user.remove_from_cart', $id) }}" class="btn btn-danger btn-sm">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tombol Checkout -->
    <div class="text-end mt-4">
        <form action="{{ route('user.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
    </div>
    @else
    <p class="text-center text-muted">Keranjang Anda kosong.</p>
    @endif
</div>
@endsection

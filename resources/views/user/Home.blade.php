@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Bagian Header -->
    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
        <h4 class="fw-bold text-primary mb-0">Zezistore</h4>
        <div class="d-flex align-items-center">
            <!-- Keranjang Belanja -->
            <a href="{{ url('/cart') }}" class="me-3 text-decoration-none position-relative">
                <i class="bi bi-cart4 text-primary fs-4"></i>
                @if(session('cart') && count(session('cart')) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart')) }}
                </span>
                @endif
            </a>

            <!-- Chart Icon -->
            <a href="{{ url('/chart') }}" class="me-3 text-decoration-none position-relative">
                <i class="bi bi-bar-chart-line text-primary fs-4"></i>
                <!-- Optional: Add badge here if needed -->
                <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span> -->
            </a>

            <!-- Cek apakah pengguna sudah login -->
            @auth
                <a href="{{ url('/profile') }}" class="btn btn-outline-primary me-2">Profil</a>
                <a href="{{ url('/logout') }}" class="btn btn-warning text-white">Logout</a>
            @else
                <a href="{{ url('/login') }}" class="btn btn-warning text-white">Login</a>
            @endauth
        </div>
    </div>

    <!-- Pencarian Produk -->
    <div class="bg-light py-3 px-4 rounded mt-3 shadow-sm">
        <form method="GET" action="{{ url('/') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <!-- Daftar Produk -->
    <div class="row mt-4">
        @forelse ($products as $product)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary fw-bold">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                    <p class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <form action="{{ route('user.add_to_cart', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <div class="mb-3">
                            <label for="quantity_{{ $product->id }}" class="form-label">Jumlah</label>
                            <input type="number" name="quantity" id="quantity_{{ $product->id }}" class="form-control" min="1" value="1">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center text-muted">Produk tidak ditemukan.</p>
        </div>
        @endforelse
    </div>

    <!-- Bagian Profil Pengguna di Sisi Kiri -->
    @auth
    <div class="row mt-5">
        <!-- Profil Pengguna di Sisi Kiri -->
        <div class="col-md-4">
            <div class="bg-white rounded shadow-sm p-4">
                <h3 class="fw-bold text-primary mb-3">Profil Pengguna</h3>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle me-4" style="width: 100px; height: 100px; object-fit: cover;">
                    <div>
                        <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-1">{{ Auth::user()->email }}</p>
                        <p class="text-muted">Bergabung sejak: {{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <a href="{{ url('/profile') }}" class="btn btn-outline-primary mt-3">Edit Profil</a>
            </div>
        </div>
    </div>
    @endauth
</div>
@endsection

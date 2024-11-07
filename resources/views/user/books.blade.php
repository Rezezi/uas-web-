@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Navbar with Login/Logout, History, and Cart Buttons -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
    <a class="navbar-brand" href="#">Library</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <!-- Borrowed Books Button -->
            <li class="nav-item">
                <a href="{{ url('user/borrowed-books') }}" class="btn btn-outline-info mr-2">Borrowed Books</a>
            </li>
            <!-- Cart Button -->
            <li class="nav-item">
                <a href="{{ route('user.cart') }}" class="btn btn-outline-success mr-2">Cart</a>
            </li>
            @if (Auth::check())
                <!-- Logout Button -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </li>
            @else
                <!-- Login Button -->
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>


        <h1>Daftar Buku</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-lg border-0">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">Penulis: {{ $book->author }}</p>
                            <p class="card-text text-muted">Tahun: {{ $book->year }}</p>
                            <p class="card-text text-muted">Genre: {{ $book->genre }}</p>
                            <p class="card-text text-muted">Stok: {{ $book->stock }}</p>

                            <!-- Borrow Book Button -->
                            <form action="{{ route('user.borrow', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100 py-2">Pinjam Buku</button>
                            </form>

                            <!-- Return Book Button if the book is borrowed by the user -->
                            @if ($book->isBorrowedByUser(auth()->id()))
                                <form action="{{ route('user.return', $book->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100 py-2">Kembalikan Buku</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        /* Container padding */
        .container {
            padding: 40px 20px;
        }

        /* Title styling */
        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 3rem;
            color: #212529;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: #007bff;
            margin: 10px auto 0;
        }

        /* Book card styling */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 30px;
        }

        /* Card title styling */
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 10px;
        }

        /* Text for book details */
        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Button styles */
        .btn {
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 10px 20px rgba(0, 123, 255, 0.4);
        }

        .btn-outline-danger {
            border: 2px solid #dc3545;
            color: #dc3545;
            background-color: transparent;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        /* New button styles */
        .btn-outline-info {
            border: 2px solid #17a2b8;
            color: #17a2b8;
            background-color: transparent;
        }

        .btn-outline-info:hover {
            background-color: #17a2b8;
            color: white;
        }

        .btn-outline-success {
            border: 2px solid #28a745;
            color: #28a745;
            background-color: transparent;
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .card {
                margin-bottom: 20px;
            }
        }
    </style>
@endsection

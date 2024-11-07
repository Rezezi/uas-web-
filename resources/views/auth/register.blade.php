@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4">Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-block py-2">Register</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login di sini</a></p>
        </div>
    </div>
</div>

<style>
    /* Latar belakang gradien (Sama dengan halaman login) */
    body {
        background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Container auth (sama dengan login) */
    .auth-container {
        max-width: 450px;
        width: 100%;
        margin: 0 auto;
    }

    /* Card styling */
    .card {
        background-color: #fff;
        border-radius: 15px;
        border: none;
        padding: 30px;
    }

    /* H2 styling */
    h2 {
        color: #2c3e50;
        font-weight: 700;
        font-size: 2rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    /* Input styling */
    .form-control {
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 1rem;
        border: 1px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #4e54c8;
        box-shadow: none;
    }

    /* Tombol register */
    .btn-primary {
        background-color: #4e54c8;
        border: none;
        border-radius: 30px;
        font-size: 1.2rem;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #3b42a7;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Link login */
    .text-primary {
        color: #4e54c8 !important;
        font-weight: 500;
    }

    .text-primary:hover {
        text-decoration: underline;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .auth-container {
            padding: 20px;
        }

        h2 {
            font-size: 1.8rem;
        }
    }
</style>
@endsection

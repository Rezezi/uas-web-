@extends('layouts.app')

@section('content')
<div class="auth-container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%;">
        <h2 class="text-center mb-4 text-secondary">Library Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary py-2">Login</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Register here</a></p>
        </div>
    </div>
</div>

<style>
    /* Background styling for a library-themed look */
    body {
        background: linear-gradient(135deg, #6a4c93, #b87333);
        font-family: 'Georgia', serif;
    }

    /* Card styling */
    .card {
        background-color: #fdfdfd;
        border: none;
        border-radius: 10px;
    }

    /* Header styling */
    h2 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #4b3832;
        letter-spacing: 1px;
    }

    /* Button styling */
    .btn-primary {
        background-color: #6a4c93;
        border-color: #6a4c93;
    }

    .btn-primary:hover {
        background-color: #5c3a80;
        border-color: #5c3a80;
    }

    /* Link styling */
    .text-primary {
        color: #6a4c93 !important;
    }

    .text-primary:hover {
        color: #5c3a80 !important;
    }
</style>
@endsection

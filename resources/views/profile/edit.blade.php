<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold text-primary mb-4">Edit Profil</h3>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Avatar -->
        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <div class="d-flex align-items-center">
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle me-4" style="width: 100px; height: 100px; object-fit: cover;">
                <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
            </div>
            @error('avatar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection

<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold text-primary mb-4">Profil Saya</h3>

    <div class="d-flex align-items-center">
        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle me-4" style="width: 100px; height: 100px; object-fit: cover;">
        <div>
            <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
            <p class="text-muted">{{ Auth::user()->email }}</p>
            <p class="text-muted">Bergabung sejak: {{ Auth::user()->created_at->format('d M Y') }}</p>
        </div>
    </div>
    
    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary mt-3">Edit Profil</a>
</div>
@endsection

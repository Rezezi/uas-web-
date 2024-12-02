<!-- resources/views/user/profile.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil User</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 text-center">
            <h4>Foto Profil</h4>
            <!-- Menampilkan foto profil jika ada -->
            <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : 'https://via.placeholder.com/150' }}" 
                 alt="Avatar" 
                 class="img-fluid rounded-circle" 
                 style="width: 150px; height: 150px; object-fit: cover;">
            <p class="mt-2">Nama: {{ Auth::user()->name }}</p>
        </div>
        <div class="col-md-8">
            <h4>Informasi Akun</h4>
            <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                    <small class="form-text text-muted">Pilih gambar untuk mengganti foto profil.</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Profil</button>
            </form>
        </div>
    </div>
</div>
@endsection

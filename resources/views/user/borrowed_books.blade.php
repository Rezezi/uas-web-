@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buku yang Sedang Dipinjam</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Tanggal Pinjam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrows as $borrow)
                <tr>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->book->author }}</td>
                    <td>{{ $borrow->book->year }}</td>
                    <td>{{ $borrow->borrowed_at }}</td>
                    <td>
                        <form action="{{ route('user.return', $borrow->book->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success">Kembalikan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

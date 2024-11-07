@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Keranjang Peminjaman Buku</h2>
        @if($borrows->isEmpty())
            <p>Keranjang Anda kosong.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrows as $borrow)
                        <tr>
                            <td>{{ $borrow->book->title }}</td>
                            <td>{{ $borrow->borrowed_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <form action="{{ route('user.returnBook', $borrow->book->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger">Kembalikan Buku</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

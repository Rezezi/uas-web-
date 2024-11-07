@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riwayat Peminjaman Buku</h2>
        @if($borrows->isEmpty())
            <p>Belum ada riwayat peminjaman buku.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrows as $borrow)
                        <tr>
                            <td>{{ $borrow->book->title }}</td>
                            <td>{{ $borrow->borrowed_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

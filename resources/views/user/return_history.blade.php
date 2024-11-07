@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riwayat Pengembalian Buku</h2>
        @if($returns->isEmpty())
            <p>Belum ada riwayat pengembalian buku.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($returns as $return)
                        <tr>
                            <td>{{ $return->book->title }}</td>
                            <td>{{ $return->returned_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

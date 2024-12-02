@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <h3 class="fw-bold text-success mb-4">Transaksi Sukses!</h3>
                    <div class="mb-4">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    <p class="lead text-muted mb-4">Terima kasih telah melakukan pembelian! Anda akan segera menerima konfirmasi lebih lanjut melalui email atau SMS.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-2">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

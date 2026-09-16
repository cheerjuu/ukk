@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h3>Dashboard</h3>
    <p class="text-muted">Ringkasan sistem penggajian</p>
</div>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">Jumlah Karyawan</h6>
                <h2>{{ $jumlahKaryawan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">Jumlah Penggajian</h6>
                <h2>{{ $jumlahPenggajian }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">Total Gaji Bersih</h6>
                <h4>
                    Rp {{ number_format($totalGaji, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>

</div>

<div class="card mt-2">
    <div class="card-body">
        <h5>Selamat Datang</h5>
        <p class="text-muted mb-0">
            Silakan pilih menu Data Karyawan atau Penggajian pada sidebar.
        </p>
    </div>
</div>

@endsection
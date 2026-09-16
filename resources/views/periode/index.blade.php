@extends('layouts.app')

@section('title', 'Data Periode')

@section('content')

<div class="mb-4">
    <h3>Data Periode</h3>

    <p class="text-muted mb-0">
        Kelola periode penggajian karyawan.
    </p>
</div>


{{-- TAMBAH PERIODE --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <h5 class="mb-4">
            Tambah Periode
        </h5>

        <form action="{{ route('periode.store') }}"
              method="POST">

            @csrf

            <div class="row">

                <div class="col-md-5 mb-3">

                    <label class="form-label">
                        Bulan
                    </label>

                    <select name="month"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Bulan --
                        </option>

                        @foreach ([
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember'
                        ] as $nomor => $nama)

                            <option value="{{ $nomor }}"
                                {{ old('month') == $nomor ? 'selected' : '' }}>

                                {{ $nama }}

                            </option>

                        @endforeach

                    </select>

                    @error('month')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <div class="col-md-5 mb-3">

                    <label class="form-label">
                        Tahun
                    </label>

                    <input type="number"
                           name="year"
                           class="form-control"
                           value="{{ old('year', date('Y')) }}"
                           min="2000"
                           max="2100"
                           required>

                    @error('year')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                <div class="col-md-2 mb-3 d-flex align-items-end">

                    <button type="submit"
                            class="btn btn-primary w-100">

                        Simpan

                    </button>

                </div>

            </div>


            <small class="text-muted">
                Sistem otomatis menggunakan tanggal
                <strong>25</strong> sampai tanggal
                <strong>25 bulan berikutnya</strong>.
            </small>

        </form>

    </div>

</div>



{{-- DAFTAR PERIODE --}}
<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h5 class="mb-3">
            Daftar Periode
        </h5>

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($periode as $data)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $data->period_name }}
                                </strong>
                            </td>

                            <td>
                                {{ $data->start_date->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ $data->end_date->format('d-m-Y') }}
                            </td>

                            <td>

                                @if ($data->status === 'active')

                                    <span class="badge bg-success">
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>

<td>

    <div class="d-flex gap-1 flex-wrap">

        @if ($data->status === 'active')

            <form action="{{ route(
                'periode.nonaktif',
                $data->id
            ) }}"
                  method="POST">

                @csrf
                @method('PATCH')

                <button type="submit"
                        class="btn btn-warning btn-sm">

                    Nonaktifkan

                </button>

            </form>

        @else

            <form action="{{ route(
                'periode.aktif',
                $data->id
            ) }}"
                  method="POST">

                @csrf
                @method('PATCH')

                <button type="submit"
                        class="btn btn-primary btn-sm">

                    Aktifkan

                </button>

            </form>

        @endif


        @if (!$data->salarySlips()->exists())

            <form action="{{ route(
                'periode.destroy',
                $data->id
            ) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus periode ini?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-outline-danger btn-sm">

                    Hapus

                </button>

            </form>

        @endif

    </div>

</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted">

                                Belum ada data periode.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
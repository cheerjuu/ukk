@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3>Data Karyawan</h3>
        <p class="text-muted mb-0">Daftar data karyawan</p>
    </div>

    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
        + Tambah Karyawan
    </a>
</div>

<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Gaji Pokok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($karyawan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->employee_code }}</td>
                            <td>{{ $data->employee_name }}</td>
                            <td>{{ $data->position }}</td>
                            <td>{{ $data->phone_number }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                Rp {{ number_format($data->basic_salary, 0, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('karyawan.edit', $data->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('karyawan.destroy', $data->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Belum ada data karyawan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
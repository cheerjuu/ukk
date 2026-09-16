<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Karyawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h3>Tambah Karyawan</h3>

    <form action="{{ route('karyawan.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="text"
                   name="employee_code"
                   class="form-control"
                   value="{{ old('employee_code') }}">

            @error('employee_code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Karyawan</label>
            <input type="text"
                   name="employee_name"
                   class="form-control"
                   value="{{ old('employee_name') }}">

            @error('employee_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text"
                   name="position"
                   class="form-control"
                   value="{{ old('position') }}">

            @error('position')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text"
                   name="phone_number"
                   class="form-control"
                   value="{{ old('phone_number') }}">

            @error('phone_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}">

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Gaji Pokok</label>
            <input type="number"
                   name="basic_salary"
                   class="form-control"
                   value="{{ old('basic_salary') }}">

            @error('basic_salary')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">
            Kembali
        </a>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

    </form>

</div>

</body>
</html>
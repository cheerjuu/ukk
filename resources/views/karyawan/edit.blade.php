<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Karyawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h3>Edit Karyawan</h3>

    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="text" name="employee_code" class="form-control"
                   value="{{ old('employee_code', $karyawan->employee_code) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Karyawan</label>
            <input type="text" name="employee_name" class="form-control"
                   value="{{ old('employee_name', $karyawan->employee_name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="position" class="form-control"
                   value="{{ old('position', $karyawan->position) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="phone_number" class="form-control"
                   value="{{ old('phone_number', $karyawan->phone_number) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $karyawan->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Gaji Pokok</label>
            <input type="number" name="basic_salary" class="form-control"
                   value="{{ old('basic_salary', $karyawan->basic_salary) }}">
        </div>

        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">
            Kembali
        </a>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

    </form>

</div>

</body>
</html>
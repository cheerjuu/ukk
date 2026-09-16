@extends('layouts.app')

@section('title', 'Riwayat Penggajian')

@section('content')

<div class="mb-4">

    <h3>
        Riwayat Penggajian
    </h3>

    <p class="text-muted mb-0">
        Daftar data penggajian yang sudah disimpan.
    </p>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Periode</th>
                        <th>Gaji Pokok</th>
                        <th>Lembur</th>
                        <th>Pinjaman</th>
                        <th>Gaji Bersih</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($riwayatGaji as $data)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <td>

                                <strong>
                                    {{ $data->employee->employee_name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    {{ $data->employee->employee_code }}
                                </small>

                            </td>


                            <td>

                                @if ($data->payrollPeriod)

                                    {{ $data->payrollPeriod->period_name }}

                                @else

                                    -

                                @endif

                            </td>


                            <td>

                                Rp
                                {{ number_format(
                                    $data->employee->basic_salary,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            <td>

                                Rp
                                {{ number_format(
                                    $data->overtime,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            <td>

                                Rp
                                {{ number_format(
                                    $data->employee_loan,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            <td>

                                <strong>

                                    Rp
                                    {{ number_format(
                                        $data->net_salary,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </strong>

                            </td>


                            <td>

                                <div class="d-flex gap-1 flex-wrap">

                                    <a href="{{ route(
                                        'penggajian.pdf',
                                        $data->id
                                    ) }}"
                                       target="_blank"
                                       class="btn btn-danger btn-sm">

                                        PDF

                                    </a>


                                    <form action="{{ route(
                                        'penggajian.email',
                                        $data->id
                                    ) }}"
                                          method="POST">

                                        @csrf

                                        <button type="submit"
                                                class="btn btn-primary btn-sm">

                                            Email

                                        </button>

                                    </form>


                                    <form action="{{ route(
                                        'penggajian.whatsapp',
                                        $data->id
                                    ) }}"
                                          method="POST">

                                        @csrf

                                        <button type="submit"
                                                class="btn btn-success btn-sm">

                                            WhatsApp

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center text-muted">

                                Belum ada riwayat penggajian.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Slip Gaji
    </title>

</head>

<body>

<h2>
    Slip Gaji Karyawan
</h2>


<p>
    Halo {{ $gaji->employee->employee_name }},
</p>


<p>
    Berikut informasi gaji Anda:
</p>


@if ($gaji->payrollPeriod)

<p>

    <strong>
        Periode:
    </strong>

    {{ $gaji->payrollPeriod->start_date->format('d-m-Y') }}

    -

    {{ $gaji->payrollPeriod->end_date->format('d-m-Y') }}

</p>

@endif


<table cellpadding="8">

    <tr>

        <td>
            Gaji Pokok
        </td>

        <td>

            Rp
            {{ number_format(
                $gaji->employee->basic_salary,
                0,
                ',',
                '.'
            ) }}

        </td>

    </tr>


    <tr>

        <td>
            Lembur
        </td>

        <td>

            Rp
            {{ number_format(
                $gaji->overtime,
                0,
                ',',
                '.'
            ) }}

        </td>

    </tr>


    <tr>

        <td>
            Total Penghasilan
        </td>

        <td>

            Rp
            {{ number_format(
                $gaji->total_income,
                0,
                ',',
                '.'
            ) }}

        </td>

    </tr>


    <tr>

        <td>
            Pinjaman
        </td>

        <td>

            Rp
            {{ number_format(
                $gaji->employee_loan,
                0,
                ',',
                '.'
            ) }}

        </td>

    </tr>


    <tr>

        <td>
            Total Potongan
        </td>

        <td>

            Rp
            {{ number_format(
                $gaji->total_deduction,
                0,
                ',',
                '.'
            ) }}

        </td>

    </tr>


    <tr>

        <td>
            <strong>
                Gaji Bersih
            </strong>
        </td>

        <td>

            <strong>

                Rp
                {{ number_format(
                    $gaji->net_salary,
                    0,
                    ',',
                    '.'
                ) }}

            </strong>

        </td>

    </tr>

</table>


<p>
    Terima kasih.
</p>

</body>

</html>
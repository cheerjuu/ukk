<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <style>

        @page {
            margin: 25px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .slip {
            width: 100%;
        }

        .judul {
            text-align: center;
            margin-bottom: 5px;
        }

        .judul h2 {
            margin: 0;
            font-size: 20px;
        }

        .periode {
            text-align: center;
            margin-bottom: 25px;
            font-size: 12px;
            font-weight: bold;
        }

        .identitas {
            margin-bottom: 20px;
        }

        .baris-identitas {
            width: 100%;
            margin-bottom: 7px;
        }

        .label-identitas {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        .kolom {
            width: 100%;
            margin-bottom: 15px;
        }

        .kotak {
            width: 47%;
            display: inline-block;
            vertical-align: top;
        }

        .kotak-kanan {
            margin-left: 5%;
        }

        .judul-bagian {
            text-align: center;
            font-weight: bold;
            padding: 7px;
            border: 1px solid #555;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 7px;
            border-bottom: 1px solid #ddd;
        }

        .nilai {
            text-align: right;
        }

        .total {
            font-weight: bold;
            border-top: 1px solid #555;
        }

        .gaji-bersih {
            border: 1px solid #555;
            padding: 12px;
            margin-top: 20px;
            font-weight: bold;
            font-size: 15px;
        }

        .gaji-bersih-nilai {
            float: right;
        }

        .captcha {
            margin-top: 25px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 250px;
        }

        .footer {
            margin-top: 40px;
            font-size: 10px;
            color: #777;
        }

    </style>

</head>


<body>

<div class="slip">


    {{-- JUDUL --}}

    <div class="judul">

        <h2>
            SLIP GAJI KARYAWAN
        </h2>

    </div>


    {{-- PERIODE --}}

    <div class="periode">

        @if ($gaji->payrollPeriod)

            PERIODE

            {{ $gaji->payrollPeriod->start_date->format('d F Y') }}

            -

            {{ $gaji->payrollPeriod->end_date->format('d F Y') }}

        @endif

    </div>



    {{-- IDENTITAS --}}

    <div class="identitas">

        <div class="baris-identitas">

            <span class="label-identitas">
                NAMA
            </span>

            :
            {{ $gaji->employee->employee_name }}

        </div>


        <div class="baris-identitas">

            <span class="label-identitas">
                NIK
            </span>

            :
            {{ $gaji->employee->employee_code }}

        </div>


        <div class="baris-identitas">

            <span class="label-identitas">
                JABATAN
            </span>

            :
            {{ $gaji->employee->position }}

        </div>

    </div>



    {{-- PENGHASILAN + POTONGAN --}}

    <div class="kolom">


        {{-- PENGHASILAN --}}

        <div class="kotak">

            <div class="judul-bagian">
                PENGHASILAN
            </div>

            <table>

                <tr>

                    <td>
                        Gaji Pokok
                    </td>

                    <td class="nilai">

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

                    <td class="nilai">

                        Rp
                        {{ number_format(
                            $gaji->overtime,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>

                </tr>


                <tr class="total">

                    <td>
                        Total Penghasilan
                    </td>

                    <td class="nilai">

                        Rp
                        {{ number_format(
                            $gaji->total_income,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>

                </tr>

            </table>

        </div>



        {{-- POTONGAN --}}

        <div class="kotak kotak-kanan">

            <div class="judul-bagian">
                POTONGAN
            </div>

            <table>

                <tr>

                    <td>
                        Pinjaman Karyawan
                    </td>

                    <td class="nilai">

                        Rp
                        {{ number_format(
                            $gaji->employee_loan,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>

                </tr>


                <tr class="total">

                    <td>
                        Total Potongan
                    </td>

                    <td class="nilai">

                        Rp
                        {{ number_format(
                            $gaji->total_deduction,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>

                </tr>

            </table>

        </div>

    </div>



    {{-- GAJI BERSIH --}}

    <div class="gaji-bersih">

        GAJI BERSIH

        <span class="gaji-bersih-nilai">

            Rp
            {{ number_format(
                $gaji->net_salary,
                0,
                ',',
                '.'
            ) }}

        </span>

    </div>



    <div class="footer">

        Slip gaji ini dibuat secara otomatis oleh
        Sistem Penggajian.

    </div>


</div>

</body>

</html>
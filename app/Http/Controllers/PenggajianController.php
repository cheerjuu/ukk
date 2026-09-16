<?php

namespace App\Http\Controllers;

use App\Mail\SlipGajiMail;
use App\Models\Employee;
use App\Models\PayrollPeriod;
use App\Models\SalarySlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PenggajianController extends Controller
{
    public function index()
    {
        $periode =
            PayrollPeriod::where('status', 'active')
                ->orderBy('start_date', 'desc')
                ->get();

        return view(
            'penggajian.index',
            compact('periode')
        );
    }


    public function create(Request $request)
    {
        $periode =
            PayrollPeriod::where('status', 'active')
                ->orderBy('start_date', 'desc')
                ->get();

        $periodeDipilih = null;

        if ($request->periode) {

            $periodeDipilih =
                PayrollPeriod::where(
                    'id',
                    $request->periode
                )
                ->where('status', 'active')
                ->first();
        }

        $karyawan =
            Employee::orderBy('employee_name')
                ->get();

        $angka1 = rand(1, 10);
        $angka2 = rand(1, 10);

        session([
            'captcha_jawaban' =>
                $angka1 * $angka2
        ]);

        return view(
            'penggajian.form',
            compact(
                'periode',
                'periodeDipilih',
                'karyawan',
                'angka1',
                'angka2'
            )
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id' =>
                'required|exists:employees,id',

            'payroll_period_id' =>
                'required|exists:payroll_periods,id',

            'overtime' =>
                'required|numeric|min:0',

            'employee_loan' =>
                'required|numeric|min:0',

            'captcha' =>
                'required|numeric',
        ]);


        if (
            $request->captcha !=
            session('captcha_jawaban')
        ) {

            return back()
                ->withErrors([
                    'captcha' =>
                        'Jawaban verifikasi salah.'
                ])
                ->withInput();
        }


        $periode =
            PayrollPeriod::where(
                'id',
                $request->payroll_period_id
            )
            ->where(
                'status',
                'active'
            )
            ->first();


        if (!$periode) {

            return back()
                ->with(
                    'error',
                    'Periode tidak aktif atau tidak ditemukan.'
                )
                ->withInput();
        }


        $karyawan =
            Employee::findOrFail(
                $request->employee_id
            );


        $totalPenghasilan =
            $karyawan->basic_salary +
            $request->overtime;


        $totalPotongan =
            $request->employee_loan;


        $gajiBersih =
            $totalPenghasilan -
            $totalPotongan;


        SalarySlip::create([

            'employee_id' =>
                $karyawan->id,

            'payroll_period_id' =>
                $periode->id,

            'overtime' =>
                $request->overtime,

            'employee_loan' =>
                $request->employee_loan,

            'total_income' =>
                $totalPenghasilan,

            'total_deduction' =>
                $totalPotongan,

            'net_salary' =>
                $gajiBersih,
        ]);


        return redirect()
            ->route(
                'riwayat.index'
            )
            ->with(
                'success',
                'Penggajian berhasil disimpan.'
            );
    }


    public function riwayat()
    {
        $riwayatGaji =
            SalarySlip::with([
                'employee',
                'payrollPeriod'
            ])
            ->latest()
            ->get();

        return view(
            'riwayat.index',
            compact('riwayatGaji')
        );
    }


    public function pdf($id)
    {
        $gaji =
            SalarySlip::with([
                'employee',
                'payrollPeriod'
            ])
            ->findOrFail($id);


        $pdf =
            \Barryvdh\DomPDF\Facade\Pdf::loadView(
                'penggajian.pdf',
                compact('gaji')
            );


        return $pdf->stream(
            'slip-gaji-' .
            $gaji->employee->employee_code .
            '.pdf'
        );
    }


    public function email($id)
    {
        $gaji =
            SalarySlip::with([
                'employee',
                'payrollPeriod'
            ])
            ->findOrFail($id);


        Mail::to(
            $gaji->employee->email
        )->send(
            new SlipGajiMail($gaji)
        );


        return back()->with(
            'success',
            'Slip gaji berhasil dikirim ke email.'
        );
    }


    public function whatsapp($id)
    {
        $gaji =
            SalarySlip::with([
                'employee',
                'payrollPeriod'
            ])
            ->findOrFail($id);


        $nomor =
            preg_replace(
                '/[^0-9]/',
                '',
                $gaji->employee->phone_number
            );


        if (
            str_starts_with(
                $nomor,
                '0'
            )
        ) {

            $nomor =
                '62' .
                substr($nomor, 1);
        }


        $periode =
            $gaji->payrollPeriod
                ? $gaji->payrollPeriod->period_name
                : '-';


        $pesan =
            'Halo ' .
            $gaji->employee->employee_name .
            ",\n\n" .

            'Berikut informasi gaji Anda.' .
            "\n\n" .

            'Periode: ' .
            $periode .
            "\n" .

            'Gaji Pokok: Rp ' .
            number_format(
                $gaji->employee->basic_salary,
                0,
                ',',
                '.'
            ) .
            "\n" .

            'Lembur: Rp ' .
            number_format(
                $gaji->overtime,
                0,
                ',',
                '.'
            ) .
            "\n" .

            'Pinjaman: Rp ' .
            number_format(
                $gaji->employee_loan,
                0,
                ',',
                '.'
            ) .
            "\n" .

            'Gaji Bersih: Rp ' .
            number_format(
                $gaji->net_salary,
                0,
                ',',
                '.'
            ) .
            "\n\n" .

            'Terima kasih.';


$response = Http::withoutVerifying()
    ->withHeaders([
        'Authorization' => env('FONNTE_TOKEN'),
    ])
    ->post(
                'https://api.fonnte.com/send',
                [
                    'target' =>
                        $nomor,

                    'message' =>
                        $pesan,

                    'countryCode' =>
                        '62',
                ]
            );


        if (!$response->successful()) {

            return back()->with(
                'error',
                'WhatsApp gagal dikirim. Periksa token Fonnte.'
            );
        }


        $hasil =
            $response->json();


        if (
            isset($hasil['status']) &&
            $hasil['status'] === false
        ) {

            return back()->with(
                'error',
                'WhatsApp gagal dikirim.'
            );
        }


        return back()->with(
            'success',
            'Pesan WhatsApp berhasil dikirim.'
        );
    }
}
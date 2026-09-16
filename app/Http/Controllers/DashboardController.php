<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalarySlip;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKaryawan = Employee::count();

        $jumlahPenggajian = SalarySlip::count();

        $totalGaji = SalarySlip::sum('net_salary');

        return view('dashboard', compact(
            'jumlahKaryawan',
            'jumlahPenggajian',
            'totalGaji'
        ));
    }
}
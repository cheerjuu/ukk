<?php

namespace App\Http\Controllers;

use App\Models\PayrollPeriod;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = PayrollPeriod::orderBy(
            'start_date',
            'desc'
        )->get();

        return view(
            'periode.index',
            compact('periode')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
        ]);

        $startDate = Carbon::create(
            $request->year,
            $request->month,
            25
        );

        $endDate = $startDate->copy()->addMonth();

        $periodName =
            $startDate->format('d') .
            ' ' .
            $startDate->translatedFormat('F Y') .
            ' - ' .
            $endDate->format('d') .
            ' ' .
            $endDate->translatedFormat('F Y');

        $sudahAda = PayrollPeriod::whereDate(
            'start_date',
            $startDate
        )->exists();

        if ($sudahAda) {
            return back()->with(
                'error',
                'Periode tersebut sudah tersedia.'
            );
        }

        PayrollPeriod::create([
            'period_name' => $periodName,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'inactive',
        ]);

        return back()->with(
            'success',
            'Periode berhasil ditambahkan. Silakan aktifkan periode yang ingin digunakan.'
        );
    }

    public function aktif($id)
    {
        $periode = PayrollPeriod::findOrFail($id);

        $periode->update([
            'status' => 'active'
        ]);

        return back()->with(
            'success',
            'Periode berhasil diaktifkan.'
        );
    }

    public function nonaktif($id)
    {
        $periode = PayrollPeriod::findOrFail($id);

        $periode->update([
            'status' => 'inactive'
        ]);

        return back()->with(
            'success',
            'Periode berhasil dinonaktifkan.'
        );
    }

    public function destroy($id)
    {
        $periode = PayrollPeriod::findOrFail($id);

        if ($periode->salarySlips()->exists()) {
            return back()->with(
                'error',
                'Periode tidak dapat dihapus karena sudah digunakan pada data penggajian.'
            );
        }

        $periode->delete();

        return back()->with(
            'success',
            'Periode berhasil dihapus.'
        );
    }
}
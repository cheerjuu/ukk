<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Employee::all();

        return view('karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        return view('karyawan.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_code' => 'required|unique:employees,employee_code',
            'employee_name' => 'required',
            'position' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        Employee::create([
            'employee_code' => $request->employee_code,
            'employee_name' => $request->employee_name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'basic_salary' => $request->basic_salary,
        ]);

        return redirect()->route('karyawan.index')
                         ->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $karyawan = Employee::findOrFail($id);

        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_code' => 'required|unique:employees,employee_code,' . $id,
            'employee_name' => 'required',
            'position' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'basic_salary' => 'required|numeric|min:0',
        ]);

        $karyawan = Employee::findOrFail($id);

        $karyawan->update([
            'employee_code' => $request->employee_code,
            'employee_name' => $request->employee_name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'basic_salary' => $request->basic_salary,
        ]);

        return redirect()->route('karyawan.index')
                         ->with('success', 'Data karyawan berhasil diubah.');
    }
    public function destroy($id)
{
    $karyawan = Employee::findOrFail($id);

    $karyawan->delete();

    return redirect()->route('karyawan.index')
                     ->with('success', 'Data karyawan berhasil dihapus.');
}
}
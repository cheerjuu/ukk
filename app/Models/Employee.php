<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'employee_name',
        'position',
        'phone_number',
        'email',
        'basic_salary',
    ];

    public function salarySlips(): HasMany
    {
        return $this->hasMany(SalarySlip::class);
    }
}
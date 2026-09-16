<?php

namespace App\Mail;

use App\Models\SalarySlip;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlipGajiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gaji;

    public function __construct(SalarySlip $gaji)
    {
        $this->gaji = $gaji;
    }

    public function build()
    {
        return $this
            ->subject('Slip Gaji - ' . $this->gaji->employee->employee_name)
            ->view('email.slip-gaji');
    }
}
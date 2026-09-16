<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('salary_slips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->onDelete('cascade');

            $table->decimal('overtime', 15, 2)->default(0);
            $table->decimal('employee_loan', 15, 2)->default(0);
            $table->decimal('total_income', 15, 2);
            $table->decimal('total_deduction', 15, 2);
            $table->decimal('net_salary', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_slips');
    }
};
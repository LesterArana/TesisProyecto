<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payroll_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_id')->constrained('payrolls')->onDelete('cascade'); // Relación con la planilla
            $table->foreignId('employee_id')->constrained('employees')->onDelete('restrict'); // Relación con el empleado
            $table->decimal('base_salary', 15, 2); // Salario base del empleado
            $table->decimal('total_hours', 8, 2)->nullable(); // Total de horas trabajadas en el período
            $table->decimal('overtime_hours', 8, 2)->nullable(); // Horas extras
            $table->decimal('deductions', 15, 2)->nullable(); // Deducciones específicas
            $table->decimal('bonuses', 15, 2)->nullable(); // Bonificaciones específicas
            $table->decimal('net_pay', 15, 2); // Pago neto calculado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('payroll_details');
    }
};

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
        Schema::create('number_of_hours', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('amount', 8, 2);
            $table->boolean('type_of_hours')->nullable();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('restrict');
            $table->timestamps();

            // Índice compuesto para evitar duplicados por employee_id y date
            $table->unique(['employee_id', 'date'], 'unique_employee_date');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('number_of_hours');
    }
};

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
            $table->string('description');
            $table->boolean('type_of_hours')->nullable();
            $table->foreignId('employee_id')->unique()->constrained('employees')->onDelete('restrict');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('restrict');
            $table->timestamps();
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

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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_number')->unique();
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->boolean('status')->default(1);
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('restrict');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};

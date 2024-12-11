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
        Schema::create('assists', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('activity');
            $table->boolean('status')->default(1);
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('restrict');
            $table->foreignId('destination_plant')->constrained('destination_plants')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

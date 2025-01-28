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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->date('start_date'); // Fecha de inicio del período
            $table->date('end_date'); // Fecha de fin del período
            $table->decimal('total_amount', 15, 2)->nullable(); // Monto total de la planilla
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict'); // Usuario que genera la planilla
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

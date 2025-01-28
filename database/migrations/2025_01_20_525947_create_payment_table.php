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
<<<<<<<< Updated upstream:database/migrations/2024_07_20_230702_create_destination_plants_table.php
        Schema::create('destination_plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->boolean('status')->default(1);
========
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_id')->constrained()->onDelete('cascade');
            $table->foreignId('payroll_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2); // Monto pagado
>>>>>>>> Stashed changes:database/migrations/2025_01_20_525947_create_payment_table.php
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< Updated upstream:database/migrations/2024_07_20_230702_create_destination_plants_table.php
        Schema::dropIfExists('destination_plants');
========
        Schema::dropIfExists('payments');
>>>>>>>> Stashed changes:database/migrations/2025_01_20_525947_create_payment_table.php
    }
};

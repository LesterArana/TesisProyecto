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
        Schema::table('payroll_details', function (Blueprint $table) {
            $table->integer('worked_days')->default(0)->after('total_hours');
            $table->decimal('daytime_overtime', 8, 2)->after('worked_days')->default(0);
            $table->decimal('night_overtime', 8, 2)->after('daytime_overtime')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payroll_details', function (Blueprint $table) {
            $table->dropColumn('worked_days');
            $table->dropColumn('daytime_overtime');
            $table->dropColumn('night_overtime');
        });
    }
};

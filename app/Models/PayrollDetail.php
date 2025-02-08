<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_id',
        'employee_id',
        'base_salary',
        'total_hours',
        'worked_days',
        'night_overtime',
        'daytime_overtime',
        'overtime_hours',
        'deductions',
        'deductions_credits',
        'bonuses',
        'net_pay',
    ];



    public function payroll()
    {
        return $this->belongsTo(Payroll::class, 'payroll_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }


    public function calculateNetPay()
    {
        return $this->base_salary + ($this->overtime_hours * 50) + $this->bonuses - $this->deductions;
    }


    public function scopeWithinDateRange($query, $start_date, $end_date)
    {
        return $query->whereHas('payroll', function ($q) use ($start_date, $end_date) {
            $q->whereBetween('start_date', [$start_date, $end_date])
                ->orWhereBetween('end_date', [$start_date, $end_date]);
        });
    }
}

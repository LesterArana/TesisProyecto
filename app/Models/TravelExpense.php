<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelExpense extends Model
{
    use HasFactory;
    
    protected $table = 'travel_expenses';

    protected $fillable = [
        'amount',
        'voucher_number',
        'description',
        'status',
        'employee_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

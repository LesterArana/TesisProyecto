<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'payment_type',
        'total_amount',
        'user_id',
    ];

    public function details()
    {
        return $this->hasMany('App\Models\PayrollDetail', 'payroll_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

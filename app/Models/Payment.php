<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['credit_id', 'payroll_id', 'amount'];

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
}

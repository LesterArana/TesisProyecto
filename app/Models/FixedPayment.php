<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_to_iggs_payment',
        'bonus_incentive',
    ];
}

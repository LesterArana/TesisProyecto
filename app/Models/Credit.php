<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'amount', 'installments', 'remaining_amount'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}

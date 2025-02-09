<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberOfHour extends Model
{
    use HasFactory;

    protected $table = 'number_of_hours';

    protected $fillable = [
        'date',
        'amount',
        'type_of_hours',
        'employee_id',
    ];

    /**
     * Relación con el modelo Employee.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function assists()
    {
        return $this->hasMany(Assist::class);
    }
}

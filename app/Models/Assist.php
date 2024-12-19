<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assist extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'activity',
        'status',
        'employee_id',
        'projet_id',
        'user_id',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getStatusTextAttribute()
    {
        return $this->status ? 'Activo' : 'Inactivo';
    }


    public function getActivityTextAttribute()
    {
        return $this->activity ? 'Entrada' : 'Salida';
    }
}

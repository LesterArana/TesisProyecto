<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'salary',
        'night_extra_hour',
        'daytime_overtime',
        'status',
    ];


    protected $casts = [
        'salary' => 'decimal:2',
        'night_extra_hour' => 'decimal:2',
        'daytime_overtime' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

}

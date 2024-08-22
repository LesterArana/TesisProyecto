<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'salario_hora', 
        'salario_dia', 
        'salario_quincena', 
        'salario_mes'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $fillable = [
        'empleado_id',
        'puesto_id',
        'tipo_pago',
        'horas_trabajadas',
        'dias_trabajados',
        'horas_extras',
        'valor_hora_extra',
        'total_pago',
        'deducciones',
        'salario_neto',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    public function deducciones()
    {
        return $this->belongsToMany(Deduccion::class, 'deduccion_nomina');
    }
}


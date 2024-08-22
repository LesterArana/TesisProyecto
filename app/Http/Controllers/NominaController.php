<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomina;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Deduccion;

class NominaController extends Controller
{
    public function index(Request $request)
    {
        $query = Nomina::query();

        // Filtrar por fechas si están presentes en la solicitud
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $nominas = $query->with('empleado', 'puesto')->get();

        return view('nominas.index', compact('nominas'));
    }

    public function show($id)
    {
        $nomina = Nomina::with('empleado', 'puesto', 'deducciones')->findOrFail($id);
        return view('nominas.show', compact('nomina'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        $deducciones = Deduccion::all();
        return view('nominas.create', compact('empleados', 'deducciones'));
    }

    public function destroy($id)
    {
        $nomina = Nomina::findOrFail($id);
        $nomina->delete();

        return redirect()->route('nominas.index')->with('success', 'Nómina eliminada exitosamente.');
    }

    public function store(Request $request)
{
    $request->validate([
        'empleado_id' => 'required|exists:empleados,id',
        'tipo_pago' => 'required|in:hora,dia,quincena,mes',
        'horas_trabajadas' => 'nullable|numeric',
        'dias_trabajados' => 'nullable|numeric',
        'horas_extras' => 'nullable|numeric',
        'valor_hora_extra' => 'nullable|numeric',
        'deducciones' => 'nullable|array',
        'deducciones.*' => 'exists:deducciones,id',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

    $empleado = Empleado::findOrFail($request->empleado_id);
    $puesto = $empleado->puesto;

    // Lógica de cálculo dependiendo del tipo de pago
    switch ($request->tipo_pago) {
        case 'hora':
            $total_pago = $puesto->salario_hora * $request->horas_trabajadas;
            break;
        case 'dia':
            $total_pago = $puesto->salario_dia * $request->dias_trabajados;
            break;
        case 'quincena':
            $total_pago = $puesto->salario_quincena;
            break;
        case 'mes':
            $total_pago = $puesto->salario_mes;
            break;
    }

    // Agregar pago por horas extras
    if ($request->horas_extras && $request->valor_hora_extra) {
        $total_pago += $request->valor_hora_extra * $request->horas_extras;
    }

    // Calcular deducciones
    $deducciones_totales = 0;
    if ($request->has('deducciones')) {
        foreach ($request->deducciones as $deduccion_id) {
            $deduccion = Deduccion::findOrFail($deduccion_id);
            if ($deduccion->es_porcentaje) {
                $deducciones_totales += ($total_pago * ($deduccion->monto / 100));
            } else {
                $deducciones_totales += $deduccion->monto;
            }
        }
    }

    $salario_neto = $total_pago - $deducciones_totales;

    // Crear la nómina
    $nomina = Nomina::create([
        'empleado_id' => $request->empleado_id,
        'puesto_id' => $puesto->id,
        'tipo_pago' => $request->tipo_pago,
        'horas_trabajadas' => $request->horas_trabajadas,
        'dias_trabajados' => $request->dias_trabajados,
        'horas_extras' => $request->horas_extras,
        'valor_hora_extra' => $request->valor_hora_extra,
        'total_pago' => $total_pago,
        'deducciones' => $deducciones_totales,
        'salario_neto' => $salario_neto,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
    ]);

    // Asocia las deducciones a la nómina
    if ($request->has('deducciones')) {
        $nomina->deducciones()->attach($request->deducciones);
    }

    return redirect()->route('nominas.index')->with('success', 'Nómina creada exitosamente.');
}

    
}


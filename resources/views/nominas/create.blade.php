@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Crear Nueva Nómina</h2>

    <form action="{{ route('nominas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="empleado_id" class="form-label">Empleado</label>
            <select name="empleado_id" class="form-control" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_pago" class="form-label">Tipo de Pago</label>
            <select class="form-control" id="tipo_pago" name="tipo_pago" required onchange="togglePagoFields()">
                <option value="hora">Por Hora</option>
                <option value="dia">Por Día</option>
                <option value="quincena">Quincenal</option>
                <option value="mes">Mensual</option>
            </select>
        </div>

        <div id="horas_trabajadas_field" class="mb-3">
            <label for="horas_trabajadas" class="form-label">Horas Trabajadas</label>
            <input type="number" name="horas_trabajadas" id="horas_trabajadas" class="form-control" value="0" min="0">
        </div>

        <div id="dias_trabajados_field" class="mb-3" style="display:none;">
            <label for="dias_trabajados" class="form-label">Días Trabajados</label>
            <input type="number" name="dias_trabajados" id="dias_trabajados" class="form-control" value="0" min="0">
        </div>

        <div class="mb-3">
            <label for="horas_extras" class="form-label">Horas Extras</label>
            <input type="number" name="horas_extras" class="form-control" value="0" min="0">
        </div>

        <div class="mb-3">
            <label for="valor_hora_extra" class="form-label">Valor Hora Extra</label>
            <input type="number" name="valor_hora_extra" class="form-control" value="0" step="0.01">
        </div>

        <div class="mb-3">
            <label for="deducciones" class="form-label">Deducciones</label>
            <select name="deducciones[]" class="form-control" multiple>
                @foreach($deducciones as $deduccion)
                    <option value="{{ $deduccion->id }}">{{ $deduccion->descripcion }} - 
                        @if($deduccion->es_porcentaje)
                            {{ $deduccion->monto }}%
                        @else
                            ${{ $deduccion->monto }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Nómina</button>
    </form>
</div>

<script>
    function togglePagoFields() {
        const tipoPago = document.getElementById('tipo_pago').value;
        const horasField = document.getElementById('horas_trabajadas_field');
        const diasField = document.getElementById('dias_trabajados_field');

        horasField.style.display = 'none';
        diasField.style.display = 'none';

        if (tipoPago === 'hora') {
            horasField.style.display = 'block';
        } else if (tipoPago === 'dia') {
            diasField.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        togglePagoFields(); // Inicializar los campos cuando la página se carga
    });

    document.getElementById('tipo_pago').addEventListener('change', togglePagoFields);
</script>
@endsection

@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Editar Empleado</h2>

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $empleado->nombres }}" required>
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $empleado->apellidos }}" required>
        </div>

        <div class="mb-3">
            <label for="dpi" class="form-label">DPI</label>
            <input type="text" class="form-control" id="dpi" name="dpi" value="{{ $empleado->dpi }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="{{ $empleado->fecha_contratacion }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $empleado->email }}" required>
        </div>
        
        

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $empleado->direccion }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
            <input type="text" class="form-control" id="tipo_sangre" name="tipo_sangre" value="{{ $empleado->tipo_sangre }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_contrato" class="form-label">Tipo de Contrato</label>
            <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato" value="{{ $empleado->tipo_contrato }}" required>
        </div>

        <div class="mb-3">
            <label for="puesto" class="form-label">Puesto</label>
            <select class="form-control" id="puesto" name="puesto_id">
                @foreach($puestos as $puesto)
                    <option value="{{ $puesto->id }}" {{ $empleado->puesto_id == $puesto->id ? 'selected' : '' }}>
                        {{ $puesto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Botón de guardar cambios -->
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection

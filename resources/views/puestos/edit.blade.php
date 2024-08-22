@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Editar Puesto</h2>

    <form action="{{ route('puestos.update', $puesto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Puesto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $puesto->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="salario_hora" class="form-label">Salario por Hora</label>
            <input type="number" class="form-control" id="salario_hora" name="salario_hora" value="{{ $puesto->salario_hora }}">
        </div>

        <div class="mb-3">
            <label for="salario_dia" class="form-label">Salario por Día</label>
            <input type="number" class="form-control" id="salario_dia" name="salario_dia" value="{{ $puesto->salario_dia }}">
        </div>

        <div class="mb-3">
            <label for="salario_mes" class="form-label">Salario por Mes</label>
            <input type="number" class="form-control" id="salario_mes" name="salario_mes" value="{{ $puesto->salario_mes }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Puesto</button>
    </form>
</div>
@endsection

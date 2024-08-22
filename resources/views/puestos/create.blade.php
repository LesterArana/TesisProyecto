@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Agregar Nuevo Puesto</h2>

    <form action="{{ route('puestos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Puesto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="salario_hora" class="form-label">Salario por Hora</label>
            <input type="number" step="0.01" class="form-control" id="salario_hora" name="salario_hora">
        </div>

        <div class="mb-3">
            <label for="salario_dia" class="form-label">Salario por Día</label>
            <input type="number" step="0.01" class="form-control" id="salario_dia" name="salario_dia">
        </div>

        <div class="mb-3">
            <label for="salario_quincena" class="form-label">Salario por Quincena</label>
            <input type="number" step="0.01" class="form-control" id="salario_quincena" name="salario_quincena">
        </div>

        <div class="mb-3">
            <label for="salario_mes" class="form-label">Salario por Mes</label>
            <input type="number" step="0.01" class="form-control" id="salario_mes" name="salario_mes">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

@extends('layouts.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Listado de Nóminas</h2>

    <!-- Formulario para filtrar por fechas y generar la planilla -->
    <form action="{{ route('nominas.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio" value="{{ request('fecha_inicio') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha Fin" value="{{ request('fecha_fin') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
            </div>
            <div class="col-md-2">
                <button type="submit" name="generar_planilla" value="1" class="btn btn-success btn-block">Generar Planilla</button>
            </div>
        </div>
    </form>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('nominas.create') }}" class="btn btn-success">Crear Nómina <i class="fas fa-plus-circle"></i></a>
        <div>
            <!-- Puedes agregar un botón adicional aquí si es necesario -->
        </div>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Total Pago (Q)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nominas as $nomina)
            <tr>
                <td>{{ $nomina->id }}</td>
                <td>{{ $nomina->empleado->nombres }} {{ $nomina->empleado->apellidos }}</td>
                <td>Q {{ number_format($nomina->salario_neto, 2) }}</td>
                <td class="d-flex">
                    <a href="{{ route('nominas.show', $nomina->id) }}" class="btn btn-info btn-sm mr-2">Ver</a>
                    
                    <!-- Botón de eliminar -->
                    <form action="{{ route('nominas.destroy', $nomina->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta nómina?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

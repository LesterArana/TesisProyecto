@extends('layouts.index')


@section('content')
<div class="container">
    <h2>Listado de Nóminas</h2>

    <!-- Formulario para filtrar por fechas -->
    <form action="{{ route('nominas.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio" value="{{ request('fecha_inicio') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha Fin" value="{{ request('fecha_fin') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <a href="{{ route('nominas.create') }}" class="btn btn-primary mb-3">Crear Nómina</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Total Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nominas as $nomina)
            <tr>
                <td>{{ $nomina->id }}</td>
                <td>{{ $nomina->empleado->nombres }} {{ $nomina->empleado->apellidos }}</td>
                <td>{{ $nomina->salario_neto }}</td>
                <td>
                    <a href="{{ route('nominas.show', $nomina->id) }}" class="btn btn-info">Ver</a>
                    
                    <!-- Botón de eliminar -->
                    <form action="{{ route('nominas.destroy', $nomina->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nómina?');">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


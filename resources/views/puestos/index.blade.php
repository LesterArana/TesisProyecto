@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Listado de Puestos</h2>

    <a href="{{ route('puestos.create') }}" class="btn btn-primary mb-3">Agregar Puesto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Salario por Hora</th>
                <th>Salario por Día</th>
                <th>Salario por Mes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($puestos as $puesto)
                <tr>
                    <td>{{ $puesto->id }}</td>
                    <td>{{ $puesto->nombre }}</td>
                    <td>{{ $puesto->salario_hora }}</td>
                    <td>{{ $puesto->salario_dia }}</td>
                    <td>{{ $puesto->salario_mes }}</td>
                    <td>
                        <a href="{{ route('puestos.edit', $puesto->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('puestos.destroy', $puesto->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este puesto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

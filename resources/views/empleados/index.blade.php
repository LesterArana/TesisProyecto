@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Listado de Empleados</h2>

    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Agregar Empleado</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Puesto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->nombres }}</td>
                <td>{{ $empleado->apellidos }}</td>
                <td>{{ $empleado->puesto->nombre ?? 'N/A' }}</td>
                <td>
                    <!-- Botón para ver detalles del empleado -->
                    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info btn-sm">Ver</a>

                    <!-- Botón para editar empleado -->
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary btn-sm">Editar</a>

                    <!-- Botón para eliminar empleado -->
                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline-block;">
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

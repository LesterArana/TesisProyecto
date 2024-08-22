@extends('layouts.index')

@section('content')
    <div class="container">
        <h2>Listado de Deducciones</h2>
        <a href="{{ route('deducciones.create') }}" class="btn btn-primary mb-3">Agregar Deducción</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Tipo</th>
                    <th>Es Porcentaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deducciones as $deduccion)
                    <tr>
                        <td>{{ $deduccion->id }}</td>
                        <td>{{ $deduccion->descripcion }}</td>
                        <td>{{ $deduccion->monto }}</td>
                        <td>{{ $deduccion->tipo }}</td>
                        <td>{{ $deduccion->es_porcentaje ? 'Sí' : 'No' }}</td>
                        <td>
                            <a href="{{ route('deducciones.edit', $deduccion->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('deducciones.destroy', $deduccion->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

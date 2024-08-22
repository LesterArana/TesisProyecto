@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Documentación</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('documentaciones.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Agregar Documentación</a>

    @foreach ($documentaciones->groupBy('empleado_id') as $empleado_id => $documentos)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $documentos->first()->empleado->nombres }} {{ $documentos->first()->empleado->apellidos }}</strong>
            </div>
            <div class="card-body">
                <p><strong>Documentos:</strong></p>
                <ul>
                    @foreach ($documentos as $documento)
                        <li class="d-flex align-items-center justify-content-between mb-2">
                            <span>{{ $documento->nombre }}</span>
                            <div class="d-flex">
                                <a href="{{ route('documentaciones.show', $documento->id) }}" class="btn btn-info btn-sm mr-2">Ver documento</a>

                                <form action="{{ route('documentaciones.destroy', $documento->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach

</div>
@endsection

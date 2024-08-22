@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Documentación de {{ $documentacion->empleado->nombres }} {{ $documentacion->empleado->apellidos }}</h2>
    
    <div class="card mb-3">
        <div class="card-header">
            Documento
        </div>
        <div class="card-body">
            @php
                $fileExtension = pathinfo($documentacion->file_path, PATHINFO_EXTENSION);
            @endphp

            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$documentacion->file_path) }}" alt="Documento" class="img-fluid">
                </div>
            @endif

            <div class="mb-3">
                <a href="{{ asset('storage/'.$documentacion->file_path) }}" target="_blank" class="btn btn-primary">Ver documento</a>
            </div>
            
            <div class="mb-3">
                <a href="{{ asset('storage/'.$documentacion->file_path) }}" download class="btn btn-success">Descargar documento</a>
            </div>

            <form action="{{ route('documentaciones.destroy', $documentacion->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection

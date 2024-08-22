@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Detalles del Empleado</h2>

    <div class="card mb-3">
        <div class="card-header">
            <strong>{{ $empleado->nombres }} {{ $empleado->apellidos }}</strong>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $empleado->id }}</p>
            <p><strong>Nombres:</strong> {{ $empleado->nombres }}</p>
            <p><strong>Apellidos:</strong> {{ $empleado->apellidos }}</p>
            <p><strong>DPI:</strong> {{ $empleado->dpi }}</p>
            <p><strong>Fecha de Contratación:</strong> {{ $empleado->fecha_contratacion }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $empleado->email }}</p>
            <p><strong>Dirección:</strong> {{ $empleado->direccion }}</p>
            <p><strong>Tipo de Sangre:</strong> {{ $empleado->tipo_sangre }}</p>
            <p><strong>Tipo de Contrato:</strong> {{ $empleado->tipo_contrato }}</p>
            <p><strong>Puesto:</strong> {{ $empleado->puesto->nombre ?? 'N/A' }}</p>
        </div>
    </div>

   
        </tbody>
    </table>
</div>
@endsection

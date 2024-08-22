@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Agregar Nuevo Empleado</h2>
    <form action="{{ url('/empleados') }}" method="POST">
        @csrf    
        <div class="row">
            <div class="col-md-10">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los datos</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombres" placeholder="Nombre del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Fecha de Contratación</label>
                            <input type="date" class="form-control" name="fecha_contratacion" placeholder="Fecha de contratación">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">DPI</label>
                            <input type="text" class="form-control" name="dpi" placeholder="DPI del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Tipo de Sangre</label>
                            <input type="text" class="form-control" name="tipo_sangre" placeholder="Tipo de sangre">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="email" placeholder="Correo electrónico">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" placeholder="Dirección">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Tipo Paga</label>
                            <input type="text" class="form-control" name="tipo_contrato" placeholder="Tipo de contrato">
                        </div>
                        <div class="mb-3">
                            <label for="puesto_id" class="form-label">Puesto</label>
                            <select class="form-control" name="puesto_id">
                                @foreach($puestos as $puesto)
                                    <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

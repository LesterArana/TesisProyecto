<div class="flex justify-center my-6">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Detalles de la Asistencia</h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Información del Empleado</h3>
            <p><strong>Nombre:</strong> {{ $assist->employee->person->name }}</p>
            <p><strong>DPI:</strong> {{ $assist->employee->person->dpi }}</p>
            <p><strong>Teléfono:</strong> {{ $assist->employee->person->phone_number }}</p>
            <p><strong>Puesto:</strong> {{ $assist->employee->position->name }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Información del Proyecto</h3>
            <p><strong>Proyecto:</strong> {{ $assist->projet->name }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Detalles de la Asistencia</h3>
            <p><strong>Fecha:</strong> {{ $assist->start_date }}</p>
            <p><strong>Estado:</strong> {{ $assist->status ? 'Activo' : 'Inactivo' }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Información Adicional</h3>
            <p><strong>Registrado por:</strong> {{ $assist->user->name }}</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('assists.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

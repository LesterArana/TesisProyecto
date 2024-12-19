<div class="flex justify-center my-6">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Detalles del Empleado</h2>

        <!-- Información Personal -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Información Personal</h3>
            <p><strong>Nombre:</strong> {{ $employee->person->name }}</p>
            <p><strong>Dirección:</strong> {{ $employee->person->address }}</p>
            <p><strong>DPI:</strong> {{ $employee->person->dpi }}</p>
            <p><strong>Teléfono:</strong> {{ $employee->person->phone_number }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $employee->person->email ?? 'No registrado' }}</p>
            <p><strong>Estado:</strong> {{ $employee->person->status ? 'Activo' : 'Inactivo' }}</p>
        </div>

        <!-- Información del Puesto -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Información del Puesto</h3>
            <p><strong>Puesto:</strong> {{ $employee->position->name }}</p>
            <p><strong>Salario Base:</strong> Q. {{ number_format($employee->position->salary, 2) }}</p>
        </div>

        <!-- Código QR -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Código QR</h3>
            <div class="qr-code flex justify-center">
                {!! $employee->generateQrCode() !!}
            </div>
            <div class="flex justify-center mt-4">
                <a href="{{ route('employees.download-qr', $employee->id) }}" class="px-4 py-2 bg-green-500 text-white rounded">
                    Descargar QR
                </a>
            </div>
        </div>


        <!-- Botón Volver -->
        <div class="flex justify-end">
            <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

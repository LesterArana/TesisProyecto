<div class="flex justify-center my-6">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Detalles de las Horas</h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Detalles</h3>
            <p><strong>Fecha:</strong> {{ $numberOfHours->date }}</p>
            <p><strong>Monto:</strong> Q. {{ number_format($numberOfHours->amount, 2) }}</p>
            <p><strong>Tipo de Horas:</strong> {{ $numberOfHours->type_of_hours ? 'Extraordinarias' : 'Regulares' }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Empleado</h3>
            <p><strong>Nombre:</strong> {{ $numberOfHours->employee->person->name }}</p>
            <p><strong>Teléfono:</strong> {{ $numberOfHours->employee->person->phone_number }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $numberOfHours->employee->person->email ?? 'No registrado' }}</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('number-of-hours.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

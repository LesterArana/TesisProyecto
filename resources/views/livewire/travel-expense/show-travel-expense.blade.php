<div class="flex justify-center my-6">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Detalles del Gasto de Viaje</h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Información General</h3>
            <p><strong>Monto:</strong> Q {{ number_format($expense->amount, 2) }}</p>
            <p><strong>Número de Comprobante:</strong> {{ $expense->voucher_number }}</p>
            <p><strong>Descripción:</strong> {{ $expense->description }}</p>
            <p><strong>Estado:</strong> {{ $expense->status ? 'Activo' : 'Inactivo' }}</p>
            <p><strong>Fecha de Registro:</strong> {{ $expense->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Empleado Asociado</h3>
            <p><strong>Nombre:</strong> {{ $expense->employee->person->name }}</p>
            <p><strong>Puesto:</strong> {{ $expense->employee->position->name }}</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('travel-expenses.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

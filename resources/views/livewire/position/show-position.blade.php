<div class="flex justify-center my-6">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Detalles del Puesto</h2>

        <div class="mb-4">
            <p><strong>Nombre del Puesto:</strong> {{ $position->name }}</p>
        </div>

        @if ($position->description)
            <div class="mb-4">
                <p><strong>Descripción:</strong> {{ $position->description }}</p>
            </div>
        @endif

        <div class="mb-4">
            <p><strong>Salario Base:</strong> Q. {{ number_format($position->salary, 2) }}</p>
        </div>

        <div class="mb-4">
            <p><strong>Hora Extra Nocturna:</strong> Q. {{ number_format($position->night_extra_hour, 2) }}</p>
        </div>

        <div class="mb-4">
            <p><strong>Hora Extra Diurna:</strong> Q. {{ number_format($position->daytime_overtime, 2) }}</p>
        </div>

        <div class="mb-4">
            <p><strong>Estado:</strong> {{ $position->status ? 'Activo' : 'Inactivo' }}</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('positions.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

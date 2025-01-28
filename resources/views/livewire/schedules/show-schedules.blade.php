<div class="flex justify-center my-6">
    <div class="bg-white p-9 rounded-lg shadow-md space-y-5 w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-gray-900">Detalles del Horario</h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Hora de Inicio</h3>
            <p class="text-gray-900">{{ $schedule->start }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Hora de Fin</h3>
            <p class="text-gray-900">{{ $schedule->end }}</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('schedules.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

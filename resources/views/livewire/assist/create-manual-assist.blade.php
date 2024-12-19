<div class="flex justify-center my-6">
    <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg" wire:submit.prevent="store">
        <h2 class="text-2xl font-bold mb-4">Registrar Asistencia (Manual)</h2>

        <!-- Selección de Empleado -->
        <div class="mb-6">
            <label for="employee_id" class="block text-gray-700">Empleado</label>
            <select id="employee_id" wire:model="employee_id" class="block w-full p-2 border border-gray-300 rounded">
                <option value="">Seleccione un empleado</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->person->name }}</option>
                @endforeach
            </select>
            @error('employee_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Selección de Proyecto -->
        <div class="mb-6">
            <label for="projet_id" class="block text-gray-700">Proyecto</label>
            <select id="projet_id" wire:model="projet_id" class="block w-full p-2 border border-gray-300 rounded">
                <option value="">Seleccione un proyecto</option>
                @foreach ($projets as $projet)
                    <option value="{{ $projet->id }}">{{ $projet->name }}</option>
                @endforeach
            </select>
            @error('projet_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Actividad -->
        <div class="mb-6">
            <label for="activity" class="block text-gray-700">Actividad</label>
            <select id="activity" wire:model="activity" class="block w-full p-2 border border-gray-300 rounded">
                <option value="">Seleccione la actividad</option>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>
            @error('activity') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha de Inicio -->
        <div class="mb-6">
            <label for="start_date" class="block text-gray-700">Fecha de Inicio</label>
            <input type="datetime-local" id="start_date" wire:model="start_date" class="block w-full p-2 border border-gray-300 rounded">
            @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha de Fin -->
        @if ($activity === 'salida')
            <div class="mb-6">
                <label for="end_date" class="block text-gray-700">Fecha de Fin</label>
                <input type="datetime-local" id="end_date" wire:model="end_date" class="block w-full p-2 border border-gray-300 rounded">
                @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        @endif

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">
            Registrar Asistencia
        </button>
    </form>
</div>

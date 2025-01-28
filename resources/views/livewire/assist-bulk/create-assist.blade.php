<div class="flex justify-center my-6">
    <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-3xl" wire:submit.prevent="save">
        <h2 class="text-2xl font-bold mb-4">Volcado de Asistencia</h2>

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

        <div class="mb-6 grid grid-cols-2 gap-4">
            <div>
                <label for="start_week" class="block text-gray-700">Inicio de Semana</label>
                <input type="date" id="start_week" wire:model="start_week" disabled class="block w-full p-2 border border-gray-300 rounded bg-gray-200">
                @error('start_week') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="end_week" class="block text-gray-700">Fin de Semana</label>
                <input type="date" id="end_week" wire:model="end_week" disabled class="block w-full p-2 border border-gray-300 rounded bg-gray-200">
                @error('end_week') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700">Días de la Semana</label>
            <div class="grid grid-cols-4 gap-4">
                @foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'] as $day)
                    <label class="inline-flex items-center">
                        <input type="checkbox" value="{{ $day }}" wire:model="days" class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="ml-2">{{ __($day) }}</span>
                    </label>
                @endforeach
            </div>
            @error('days') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="extra_hours_diurnas" class="block text-gray-700">Horas Extras Diurnas</label>
            <input type="number" step="0.01" id="extra_hours_diurnas" wire:model="extra_hours_diurnas" class="block w-full p-2 border border-gray-300 rounded" placeholder="Ingrese horas extras diurnas">
            @error('extra_hours_diurnas') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-6">
            <label for="extra_hours_nocturnas" class="block text-gray-700">Horas Extras Nocturnas</label>
            <input type="number" step="0.01" id="extra_hours_nocturnas" wire:model="extra_hours_nocturnas" class="block w-full p-2 border border-gray-300 rounded" placeholder="Ingrese horas extras nocturnas">
            @error('extra_hours_nocturnas') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">
            Guardar Asistencia
        </button>
    </form>
</div>

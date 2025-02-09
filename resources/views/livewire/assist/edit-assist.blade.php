<div class="flex justify-center my-6">
    <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg" wire:submit.prevent="update">
        <h2 class="text-2xl font-bold mb-4">Editar Asistencia</h2>

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

        <div class="mb-6">
            <label for="date" class="block text-gray-700">Fecha</label>
            <input type="datetime-local" id="date" wire:model="date" class="block w-full p-2 border border-gray-300 rounded">
            @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="status" class="block text-gray-700">Estado</label>
            <select id="status" wire:model="status" class="block w-full p-2 border border-gray-300 rounded">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">
            Guardar Cambios
        </button>
    </form>
</div>

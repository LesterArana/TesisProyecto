<div class="flex justify-center my-6">
    <form class="bg-white p-9 rounded-lg shadow-md space-y-5 w-full max-w-2xl" wire:submit.prevent="store">
        <h2 class="text-2xl font-bold text-gray-900">Registrar Horas</h2>

        <div class="mb-6">
            <x-input-label for="date" :value="__('Fecha')" />
            <x-text-input id="date" type="date" wire:model="date" class="block mt-1 w-full" />
            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="amount" :value="__('Monto')" />
            <x-text-input id="amount" type="number" step="0.01" wire:model="amount" class="block mt-1 w-full" placeholder="0.00" />
            @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="type_of_hours" :value="__('Tipo de Horas')" />
            <select id="type_of_hours" wire:model="type_of_hours" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccione el tipo</option>
                <option value="0">Ordinaria</option>
                <option value="1">Extraordinaria</option>
            </select>
            @error('type_of_hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="employee_id" :value="__('Empleado')" />
            <select id="employee_id" wire:model="employee_id" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccione un empleado</option>
                @foreach ($employees as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('employee_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Guardar') }}
        </x-primary-button>
    </form>
</div>

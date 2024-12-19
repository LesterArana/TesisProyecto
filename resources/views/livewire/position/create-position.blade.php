<div class="flex justify-center my-6">
    <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg" wire:submit.prevent="store">
        <h2 class="text-2xl font-bold mb-4">Crear Puesto</h2>

        <!-- Nombre -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Nombre del Puesto')" />
            <x-text-input
                id="name"
                type="text"
                wire:model="name"
                class="block mt-1 w-full"
                placeholder="Nombre del puesto"
            />
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <x-input-label for="description" :value="__('Descripción')" />
            <textarea
                id="description"
                wire:model="description"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                placeholder="Descripción opcional del puesto"
            ></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Salario -->
        <div class="mb-4">
            <x-input-label for="salary" :value="__('Salario Base')" />
            <x-text-input
                id="salary"
                type="number"
                step="0.01"
                wire:model="salary"
                class="block mt-1 w-full"
                placeholder="Salario base"
            />
            @error('salary') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Hora extra nocturna -->
        <div class="mb-4">
            <x-input-label for="night_extra_hour" :value="__('Hora Extra Nocturna')" />
            <x-text-input
                id="night_extra_hour"
                type="number"
                step="0.01"
                wire:model="night_extra_hour"
                class="block mt-1 w-full"
                placeholder="Pago por hora extra nocturna"
            />
            @error('night_extra_hour') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Hora extra diurna -->
        <div class="mb-4">
            <x-input-label for="daytime_overtime" :value="__('Hora Extra Diurna')" />
            <x-text-input
                id="daytime_overtime"
                type="number"
                step="0.01"
                wire:model="daytime_overtime"
                class="block mt-1 w-full"
                placeholder="Pago por hora extra diurna"
            />
            @error('daytime_overtime') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div class="mb-4 flex items-center">
            <input
                type="checkbox"
                id="status"
                wire:model="status"
                class="mr-2"
            />
            <label for="status" class="text-sm text-gray-700">Activo</label>
            @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Botón de envío -->
        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Crear Puesto') }}
        </x-primary-button>
    </form>
</div>

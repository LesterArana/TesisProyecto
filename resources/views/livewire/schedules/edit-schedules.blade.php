<div class="flex justify-center my-6">
    <form class="bg-white p-9 rounded-lg shadow-md space-y-5 w-full max-w-2xl" wire:submit.prevent="update">
        <h2 class="text-2xl font-bold text-gray-900">Editar Horario</h2>

        <div class="mb-6">
            <x-input-label for="start" :value="__('Hora de Inicio')" />
            <x-text-input id="start" type="time" wire:model="start" class="block mt-1 w-full" />
            @error('start') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="end" :value="__('Hora de Fin')" />
            <x-text-input id="end" type="time" wire:model="end" class="block mt-1 w-full" />
            @error('end') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Guardar Cambios') }}
        </x-primary-button>
    </form>
</div>

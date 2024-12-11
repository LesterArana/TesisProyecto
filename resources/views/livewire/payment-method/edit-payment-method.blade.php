<div class="flex justify-center my-6">
    <form class="justify-center bg-center md:w-1/2 space-y-5 p-9 bg-white rounded-lg shadow-md" wire:submit.prevent='update'>
        <h2 class="text-2xl font-bold text-gray-900">Editar Método de Pago</h2>
        
        <div class="mb-6">
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                wire:model="name"
                placeholder="Nombre"
            />
            @error('name')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Guardar') }}
        </x-primary-button>
    </form>
</div>

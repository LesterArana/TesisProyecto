<div class="flex justify-center my-6">
    <form class="justify-center bg-center md:w-1/2 space-y-5 p-9 bg-white rounded-lg shadow-md" wire:submit.prevent="store">
        <h2 class="text-2xl font-bold text-gray-900">Crear Empleado</h2>

        <!-- Nombre -->
        <div class="mb-6">
            <x-input-label for="name" :value="__('Nombre Completo')" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                wire:model="name"
                placeholder="Nombre completo"
            />
            @error('name') @livewire('alert', ['message' => $message]) @enderror
        </div>

        <!-- Dirección -->
        <div class="mb-6">
            <x-input-label for="address" :value="__('Dirección')" />
            <x-text-input
                id="address"
                class="block mt-1 w-full"
                type="text"
                wire:model="address"
                placeholder="Dirección"
            />
            @error('address') @livewire('alert', ['message' => $message]) @enderror
        </div>

        <!-- DPI -->
        <div class="mb-6">
            <x-input-label for="dpi" :value="__('DPI')" />
            <x-text-input
                id="dpi"
                class="block mt-1 w-full"
                type="text"
                wire:model="dpi"
                placeholder="DPI"
            />
            @error('dpi') @livewire('alert', ['message' => $message]) @enderror
        </div>

        <!-- Teléfono -->
        <div class="mb-6">
            <x-input-label for="phone_number" :value="__('Teléfono')" />
            <x-text-input
                id="phone_number"
                class="block mt-1 w-full"
                type="text"
                wire:model="phone_number"
                placeholder="Teléfono"
            />
            @error('phone_number') @livewire('alert', ['message' => $message]) @enderror
        </div>

        <!-- Email -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                wire:model="email"
                placeholder="Correo Electrónico"
            />
            @error('email') @livewire('alert', ['message' => $message]) @enderror
        </div>

        <!-- Posición -->
        <div class="mb-6">
            <x-input-label for="position_id" :value="__('Puesto')" />
            <select id="position_id" wire:model="position_id" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccione un puesto</option>
                @foreach ($positions as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('position_id') @livewire('alert', ['message' => $message]) @enderror
        </div>

        <!-- Estado -->
        <div class="mb-6">
            <x-input-label for="status" :value="__('Estado')" />
            <input type="checkbox" id="status" wire:model="status" class="form-checkbox h-6 w-6 text-green-500" value="1" checked>
            <span class="ml-2 text-gray-700">Activo</span>
        </div>

        <!-- Botón Guardar -->
        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Guardar') }}
        </x-primary-button>
    </form>
</div>

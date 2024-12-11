<div class="flex justify-center my-6">
    <form class="justify-center bg-center md:w-1/2 space-y-5 p-9 bg-white rounded-lg shadow-md" wire:submit.prevent="store">
        <h2 class="text-2xl font-bold text-gray-900">Crear Proveedor</h2>

        <div class="mb-6">
            <x-input-label for="type_person" :value="__('Tipo de Proveedor')" />
            <select id="type_person" wire:model="type_person" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccione una opción</option>
                <option value="Persona natural">Persona natural</option>
                <option value="Persona jurídica">Persona jurídica</option>
            </select>
            @error('type_person')
                @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="company_name" :value="__('Nombre de la Empresa')" />
            <x-text-input
                id="company_name"
                class="block mt-1 w-full"
                type="text"
                wire:model="company_name"
                placeholder="Nombre de la Empresa"
            />
            @error('company_name')
                @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="address" :value="__('Dirección')" />
            <x-text-input
                id="address"
                class="block mt-1 w-full"
                type="text"
                wire:model="address"
                placeholder="Dirección"
            />
            @error('address')
                @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                wire:model="email"
                placeholder="Email"
            />
            @error('email')
                @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="phone_number" :value="__('Teléfono')" />
            <x-text-input
                id="phone_number"
                class="block mt-1 w-full"
                type="text"
                wire:model="phone_number"
                placeholder="Teléfono"
            />
            @error('phone_number')
                @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="nit_number" :value="__('Número de NIT')" />
            <x-text-input
                id="nit_number"
                class="block mt-1 w-full"
                type="text"
                wire:model="nit_number"
                placeholder="Número de NIT"
            />
            @error('nit_number')
                @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="state" :value="__('Estado')" />
            <input type="checkbox" id="state" wire:model="state" class="form-checkbox h-6 w-6 text-green-500" value="1" checked>
            <span class="ml-2 text-gray-700">Activo</span>
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Guardar') }}
        </x-primary-button>
    </form>
</div>


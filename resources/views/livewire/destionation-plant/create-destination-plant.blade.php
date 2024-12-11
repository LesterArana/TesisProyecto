<div class="flex justify-center my-12">
    <form class="justify-center bg-center md:w-1/2 space-y-5 p-9 bg-white rounded-lg shadow-md" wire:submit.prevent='store'>
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Crear Planta de Destino</h2>

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
            @livewire('alert', ['message' => $message])
            @enderror
        </div>
        <div class="mb-6">
            <x-input-label for="country_id" :value="__('País')" />
            <select id="country_id" wire:model="country_id" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccionar País</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="customer_id" :value="__('Cliente')" />
            <select id="customer_id" wire:model="customer_id" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccionar Cliente</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->person->company_name }}</option>
                @endforeach
            </select>
            @error('customer_id')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="address" :value="__('Dirección')" />
            <x-textarea
                id="address"
                class="block mt-1 w-full"
                wire:model="address"
                placeholder="Dirección"
            />
            @error('address')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="phone_number" :value="__('Número de Teléfono')" />
            <x-text-input
                id="phone_number"
                class="block mt-1 w-full"
                type="text"
                wire:model="phone_number"
                placeholder="Número de Teléfono"
            />
            @error('phone_number')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="status" :value="__('Estado')" />
            <label class="inline-flex items-center mt-3">
                <input type="checkbox" class="form-checkbox h-6 w-6 text-green-500" wire:model="status" value="1" checked>
                <span class="ml-2 text-gray-700">Activo</span>
            </label>
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Crear Planta de Destino') }}
        </x-primary-button>
    </form>
</div>

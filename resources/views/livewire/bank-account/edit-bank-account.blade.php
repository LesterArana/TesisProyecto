<div class="flex justify-center my-6">
    <form class="justify-center bg-center md:w-1/2 space-y-5 p-9 bg-white rounded-lg shadow-md" wire:submit.prevent='editBankAccount'>
        <h2 class="text-2xl font-bold text-gray-900">Editar Cuenta Bancaria</h2>
        
        <div class="mb-6">
            <x-input-label for="name_bank" :value="__('Banco')" />
            <x-text-input
                id="name_bank"
                class="block mt-1 w-full"
                type="text"
                wire:model="name_bank"
                placeholder="Banco"
            />
            @error('name_bank')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="mb-4">
            <x-input-label for="account_number" :value="__('Número de Cuenta')" />
            <x-text-input
                id="account_number"
                class="block mt-1 w-full"
                type="text"
                wire:model="account_number"
                placeholder="Número de Cuenta"
            />
            @error('account_number')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Guardar') }}
        </x-primary-button>
    </form>
</div>

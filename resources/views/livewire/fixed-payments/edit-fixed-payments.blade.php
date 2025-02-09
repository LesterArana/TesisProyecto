<div class="flex justify-center my-6">
    <form class="bg-white p-9 rounded-lg shadow-md space-y-5 w-full max-w-2xl" wire:submit.prevent="update">
        <h2 class="text-2xl font-bold text-gray-900">Editar Pago Fijo</h2>

        <div class="mb-6">
            <x-input-label for="subject_to_iggs_payment" :value="__('Sujeto a Pago IGGS')" />
            <x-text-input id="subject_to_iggs_payment" type="number" step="0.01" wire:model="subject_to_iggs_payment" class="block mt-1 w-full" placeholder="0.00" />
            @error('subject_to_iggs_payment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="bonus_incentive" :value="__('Bonificación Incentivo')" />
            <x-text-input id="bonus_incentive" type="number" step="0.01" wire:model="bonus_incentive" class="block mt-1 w-full" placeholder="0.00" />
            @error('bonus_incentive') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Guardar Cambios') }}
        </x-primary-button>
    </form>
</div>

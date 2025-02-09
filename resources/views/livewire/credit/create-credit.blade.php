<div class="flex justify-center my-6">
    <form class="bg-white p-8 rounded-lg shadow-md space-y-5 w-full max-w-lg" wire:submit.prevent="store">
        <h2 class="text-2xl font-bold text-gray-900">Registrar Crédito</h2>

        <div class="mb-6">
            <x-input-label for="amount" :value="__('Monto del Crédito')" />
            <x-text-input
                id="amount"
                class="block mt-1 w-full"
                type="number"
                wire:model="amount"
                placeholder="Ingrese el monto del crédito"
                step="0.01"
            />
            @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="installments" :value="__('Número de Cuotas')" />
            <x-text-input
                id="installments"
                class="block mt-1 w-full"
                type="number"
                wire:model="installments"
                placeholder="Ingrese el número de cuotas"
                min="1"
            />
            @error('installments') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="employee_id" :value="__('Empleado')" />
            <select
                id="employee_id"
                class="block mt-1 w-full p-2 border border-gray-300 rounded bg-white"
                wire:model="employee_id"
            >
                <option value="">Seleccione un empleado</option>
                @foreach ($employees as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('employee_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-center">
            <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition ease-in-out duration-200">
                {{ __('Guardar') }}
            </button>
        </div>
    </form>
</div>

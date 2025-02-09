<div class="flex justify-center my-6">
    <form class="bg-white p-8 rounded-lg shadow-md space-y-5 w-full max-w-lg" wire:submit.prevent="store">
        <h2 class="text-2xl font-bold text-gray-900">Registrar Gasto de Viaje</h2>

        <div class="mb-6">
            <x-input-label for="amount" :value="__('Monto')" />
            <x-text-input
                id="amount"
                class="block mt-1 w-full"
                type="number"
                wire:model="amount"
                placeholder="Ingrese el monto"
                step="0.01"
            />
            @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="voucher_number" :value="__('Número de Comprobante')" />
            <x-text-input
                id="voucher_number"
                class="block mt-1 w-full"
                type="text"
                wire:model="voucher_number"
                placeholder="Ingrese el número de comprobante"
            />
            @error('voucher_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="mb-6">
            <x-input-label for="description" :value="__('Descripción')" />
            <textarea
                id="description"
                class="block mt-1 w-full p-2 border border-gray-300 rounded"
                wire:model="description"
                placeholder="Ingrese una descripción del gasto"
            ></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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


        <div class="mb-6">
            <x-input-label for="status" :value="__('Estado')" />
            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    id="status"
                    wire:model="status"
                    class="form-checkbox h-5 w-5 text-green-600"
                />
                <span class="ml-2 text-gray-700">Activo</span>
            </label>
        </div>

        <div class="flex justify-center">
            <x-primary-button class="w-full">
                {{ __('Guardar') }}
            </x-primary-button>
        </div>
    </form>
</div>

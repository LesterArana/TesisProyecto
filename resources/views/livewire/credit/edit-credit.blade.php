<div class="flex justify-center my-12">
    <form class="justify-center bg-center md:w-1/2 space-y-5 p-9 bg-white rounded-lg shadow-md" wire:submit.prevent='update' enctype="multipart/form-data">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Editar Crédito</h2>

        <div class="mb-6">
            <x-input-label for="supplier_id" :value="__('Proveedor')" />
            <select id="supplier_id" wire:model="supplier_id" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccione un proveedor</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->person->company_name }}</option>
                @endforeach
            </select>
            @error('supplier_id')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="bank_account_id" :value="__('Cuenta Bancaria')" />
            <select id="bank_account_id" wire:model="bank_account_id" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccione una cuenta bancaria</option>
                @foreach($bank_accounts as $bank_account)
                    <option value="{{ $bank_account->id }}">{{ $bank_account->name_bank }} - {{ $bank_account->account_number }}</option>
                @endforeach
            </select>
            @error('bank_account_id')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="payment_method_id" :value="__('Método de Pago')" />
            <select id="payment_method_id" wire:model="payment_method_id" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccione un método de pago</option>
                @foreach($payment_methods as $payment_method)
                    <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                @endforeach
            </select>
            @error('payment_method_id')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="voucher_number" :value="__('Número de Comprobante')" />
            <x-text-input
                id="voucher_number"
                class="block mt-1 w-full"
                type="text"
                wire:model="voucher_number"
                placeholder="Número de Comprobante"
            />
            @error('voucher_number')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="date" :value="__('Fecha')" />
            <x-text-input
                id="date"
                class="block mt-1 w-full"
                type="date"
                wire:model="date"
            />
            @error('date')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="mount" :value="__('Monto')" />
            <x-text-input
                id="mount"
                class="block mt-1 w-full"
                type="number"
                step="any"
                wire:model="mount"
                placeholder="Monto"
            />
            @error('mount')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="image" :value="__('Imagen')" />
            <x-text-input
                id="image"
                class="block mt-1 w-full"
                type="file"
                wire:model="image"
            />
            <div class="mt-4 flex space-x-4">
                @if ($currentImage)
                    <div class="w-1/2">
                        <span class="block text-center font-bold">Imagen Actual</span>
                        <img src="{{ Storage::url($currentImage) }}" alt="Imagen Actual" class="w-full h-auto object-cover rounded">
                    </div>
                @endif
                @if ($imagePreview)
                    <div class="w-1/2">
                        <span class="block text-center font-bold">Vista Previa de Nueva Imagen</span>
                        <img src="{{ $imagePreview }}" alt="Vista Previa de Nueva Imagen" class="w-full h-auto object-cover rounded">
                    </div>
                @endif
            </div>
            @error('image')
            @livewire('alert', ['message' => $message])
            @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="status" :value="__('Estado')" />
            <label class="inline-flex items-center mt-3">
                <input type="checkbox" class="form-checkbox h-6 w-6 text-green-500" wire:model="status" value="1" {{ $status ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">Activo</span>
            </label>
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Actualizar Crédito') }}
        </x-primary-button>
    </form>
</div>
@if(session()->has('alert'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var alertData = @json(session('alert'));
            Swal.fire({
                position: alertData.position,
                icon: alertData.type,
                title: alertData.message,
                text: alertData.text,
                timer: alertData.timer,
                toast: alertData.toast,
            });
        });
    </script>
@endif


<div class="flex justify-center my-6">
    <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg" wire:submit.prevent="createPayroll">
        <h2 class="text-2xl font-bold mb-4">Generar Nómina</h2>

        <div class="mb-6">
            <label for="payment_type" class="block text-gray-700">Tipo de Pago</label>
            <select id="payment_type" wire:model="payment_type"
                    class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300">
                <option value="mensual">Pago Mensual</option>
                <option value="quincenal">Pago Quincenal</option>
            </select>
            @error('payment_type')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="start_date" class="block text-gray-700">Fecha de Inicio</label>
            <input type="date" id="start_date" wire:model="start_date"
                   class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300">
            @error('start_date')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="end_date" class="block text-gray-700">Fecha de Fin</label>
            <input type="date" id="end_date" wire:model="end_date"
                   class="block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300">
            @error('end_date')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition ease-in-out duration-200">
            Generar Nómina
        </button>
    </form>
</div>

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('mostrarAlertaError', function(message) {
                Swal.fire({
                    title: "Error",
                    text: message,
                    icon: "error",
                    confirmButtonText: "Aceptar"
                });
            });
        });
    </script>
@endpush


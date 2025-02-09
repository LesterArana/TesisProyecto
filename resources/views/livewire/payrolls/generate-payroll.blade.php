<div class="flex justify-center my-6">
    <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg" wire:submit.prevent="createPayroll">
        <h2 class="text-2xl font-bold mb-4">Generar Nómina</h2>

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

    @if(session()->has('alert'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const alert = @json(session('alert'));
                Swal.fire({
                    icon: alert.type,
                    title: alert.message,
                    position: 'center',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
</div>

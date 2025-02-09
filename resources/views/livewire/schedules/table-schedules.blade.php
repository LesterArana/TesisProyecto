<div class="mt-10">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-8">
        <div class="flex justify-end my-6">
            <a href="{{ route('schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300">
                {{ __('Crear Horario') }}
            </a>
        </div>

        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <div class="flex">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500"
                                 fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                               placeholder="Search" required="">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Hora de Inicio</th>
                        <th scope="col" class="px-4 py-3">Hora de Fin</th>
                        <th scope="col" class="px-4 py-3">Fecha de Creación</th>
                        <th scope="col" class="px-4 py-3"><span class="sr-only">Acciones</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($schedules as $schedule)
                        <tr class="border-b">
                            <td class="px-4 py-3">{{ $schedule->start }}</td>
                            <td class="px-4 py-3">{{ $schedule->end }}</td>
                            <td class="px-4 py-3">{{ $schedule->created_at }}</td>
                            <td class="px-4 py-3 flex justify-end space-x-2">
                                <a href="{{ route('schedules.show', $schedule->id) }}" class="px-4 py-2 bg-green-500 text-white rounded-md">Ver</a>
                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Editar</a>
                                <button wire:click="$dispatch('mostrarAlerta', {{ $schedule->id }})" class="px-4 py-2 bg-red-500 text-white rounded-md">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="py-4 px-3">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('mostrarAlerta', scheduleId => {
                Swal.fire({
                    title: "¿Eliminar Horario?",
                    text: "¡No podrás recuperar este registro!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, eliminar!",
                    cancelButtonText:"Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteSchedule', {scheduleId:scheduleId});
                    }
                });
            });
        });
    </script>
@endpush

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


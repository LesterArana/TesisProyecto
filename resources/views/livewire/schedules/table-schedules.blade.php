<div class="mt-10">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-8">
        <div class="flex justify-end my-6">
            <a href="{{ route('schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300">
                {{ __('Crear Horario') }}
            </a>
        </div>

        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <div class="relative w-full">
                    <input wire:model.debounce.300ms="search" type="text" placeholder="Buscar..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2">
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
                                <button wire:click="$emit('confirmDeletion', {{ $schedule->id }})" class="px-4 py-2 bg-red-500 text-white rounded-md">Eliminar</button>
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

    @push('scripts')
        <script>
            Livewire.on('confirmDeletion', id => {
                Swal.fire({
                    title: '¿Eliminar Horario?',
                    text: 'No podrás recuperar este registro.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteSchedule', id);
                    }
                });
            });
        </script>
    @endpush
</div>

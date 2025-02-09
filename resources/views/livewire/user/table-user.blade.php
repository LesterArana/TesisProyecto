<div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-8">
            <div class="flex justify-end my-6">
                @can('user.create')
                    <button wire:click="redirectt" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Crear') }}
                    </button>
                @endcan
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
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'name', 'displayName' => 'Nombre' ])
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'email', 'displayName' => 'Email' ])
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'status', 'displayName' => 'Estado' ])
                            <th scope="col" class="px-4 py-3 normal-case">{{ __('Rol') }}</th>
                            <th scope="col" class="px-4 py-3 normal-case">{{ __('Fecha de Creación') }}</th>
                            <th scope="col" class="px-4 py-3"><span class="sr-only">Acciones</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr wire:key="{{ $user->id }}" class="border-b">
                                <th scope="row" class="px-4 py-3">{{ $user->name }}</th>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    @if ($user->status == 1)
                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Activo</span>
                                    @else
                                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Desactivado</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($user->roles->isNotEmpty())
                                        {{ $user->roles->first()->name }}
                                    @else
                                        Sin rol
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $user->created_at }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <div class="flex space-x-1">
                                        @can('user.show')
                                            <a href="{{ route('user.show', $user->id) }}" class="bg-green-400 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Ver</a>
                                        @endcan
                                        @can('user.edit')
                                            <a href="{{ route('user.edit', $user->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar</a>
                                        @endcan
                                        @can('user.destroy')
                                            <button wire:click="$dispatch('mostrarAlerta', {{$user->id}})" class="px-3 py-1 bg-red-500 text-white rounded">Eliminar</button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="py-4 px-3">
                    <div class="flex">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Por Página</label>
                            <select wire:model.live='perPage' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="5">5</option>
                                <option value="7">7</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('mostrarAlerta', userId => {
                Swal.fire({
                    title: "¿Eliminar Cliente?",
                    text: "¡Un cliente eliminado no puede ser recuperado!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar!",
                    cancelButtonText:"Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteUser', { userId: userId });
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

<div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-8">
            <div class="flex justify-end my-6">
                <button wire:click="redirectToCreate"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Crear') }}
                </button>
            </div>
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <input wire:model.debounce.300ms="search" type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                   placeholder="Buscar" required>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'employee.person.name', 'displayName' => 'Nombre del Empleado' ])
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'voucher_number', 'displayName' => 'Número de Comprobante' ])
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'description', 'displayName' => 'Descripción' ])
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'amount', 'displayName' => 'Monto' ])
                            @include('livewire.includes.table-sortable-th',[ 'name' => 'created_at', 'displayName' => 'Fecha de Creación' ])
                            <th scope="col" class="px-4 py-3"><span class="sr-only">Acciones</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($travelExpenses as $expense)
                            <tr wire:key="{{ $expense->id }}" class="border-b">
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $expense->employee->person->name ?? 'No asignado' }}
                                </td>
                                <td class="px-4 py-3">{{ $expense->voucher_number }}</td>
                                <td class="px-4 py-3">{{ $expense->description }}</td>
                                <td class="px-4 py-3">Q {{ number_format($expense->amount, 2) }}</td>
                                <td class="px-4 py-3">{{ $expense->created_at }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <div class="flex space-x-1">
                                        <a href="{{ route('travel-expenses.show', $expense->id) }}" class="bg-green-400 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Ver</a>
                                        <a href="{{ route('travel-expenses.edit', $expense->id) }}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar</a>
                                        <button wire:click="$dispatch('mostrarAlerta', {{ $expense->id }})"
                                                class="px-3 py-1 bg-red-500 text-white rounded">Eliminar
                                        </button>
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
                            <select wire:model.live='perPage'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $travelExpenses->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('mostrarAlerta', expenseId => {
                Swal.fire({
                    title: "¿Eliminar Gasto de Viaje?",
                    text: "¡No podrás recuperar este gasto de viaje!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, eliminar!",
                    cancelButtonText:"Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteTravelExpense', {expenseId:expenseId});
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

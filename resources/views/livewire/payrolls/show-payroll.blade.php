<div class="container mx-auto mt-8">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detalles de la Nómina</h2>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Información General</h3>
        <div class="grid grid-cols-2 gap-4">
            <p><strong>Fecha de Inicio:</strong> {{ $payroll->start_date }}</p>
            <p><strong>Fecha de Fin:</strong> {{ $payroll->end_date }}</p>
            <p><strong>Monto Total:</strong> Q. {{ number_format($payroll->total_amount, 2) }}</p>
            <p><strong>Generado por:</strong> {{ $payroll->user->name }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $payroll->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="flex justify-end mb-4">
        <button wire:click="export" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
            Exportar Detalles en Excel
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-6 py-3">Empleado</th>
                <th class="px-6 py-3">Días Trabajados</th>
                <th class="px-6 py-3">Horas Totales</th>
                <th class="px-6 py-3">Horas Extras Diurnas</th>
                <th class="px-6 py-3">Horas Extras Nocturnas</th>
                <th class="px-6 py-3">Salario Base</th>
                <th class="px-6 py-3">Deducciones</th>
                <th class="px-6 py-3">Prestamos</th>
                <th class="px-6 py-3">Bonificaciones</th>
                <th class="px-6 py-3">Pago Neto</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($payroll->details as $detail)
                <tr class="border-b">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $detail->employee->person->name }}
                    </td>
                    <td class="px-6 py-4">{{ $detail->worked_days }}</td>
                    <td class="px-6 py-4">{{ $detail->total_hours }}</td>
                    <td class="px-6 py-4">{{ $detail->daytime_overtime }}</td>
                    <td class="px-6 py-4">{{ $detail->night_overtime }}</td>
                    <td class="px-6 py-4">Q. {{ number_format($detail->base_salary, 2) }}</td>
                    <td class="px-6 py-4">Q. {{ number_format($detail->deductions, 2) }}</td>
                    <td class="px-6 py-4">Q. {{ number_format($detail->deductions_credits, 2) }}</td>

                    <td class="px-6 py-4">Q. {{ number_format($detail->bonuses, 2) }}</td>
                    <td class="px-6 py-4 font-bold">Q. {{ number_format($detail->net_pay, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

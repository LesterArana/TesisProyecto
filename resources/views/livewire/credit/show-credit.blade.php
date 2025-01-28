<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Detalles del Crédito</h2>

        <div class="mb-6">
            <p><strong>Empleado:</strong> {{ $credit->employee->name }}</p>
            <p><strong>Monto Total:</strong> Q. {{ number_format($credit->amount, 2) }}</p>
            <p><strong>Cuotas:</strong> {{ $credit->installments }}</p>
            <p><strong>Saldo Restante:</strong> Q. {{ number_format($credit->remaining_amount, 2) }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $credit->created_at->format('d/m/Y') }}</p>
        </div>

        <h3 class="text-xl font-semibold text-gray-700 mb-3">Pagos Asociados</h3>
        @if ($credit->payments->isEmpty())
            <p class="text-gray-500">No hay pagos registrados para este crédito.</p>
        @else
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Fecha de Pago</th>
                    <th class="border border-gray-300 px-4 py-2">Monto Pagado</th>
                    <th class="border border-gray-300 px-4 py-2">Nómina Asociada</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($credit->payments as $payment)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $payment->created_at->format('d/m/Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">Q. {{ number_format($payment->amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">#{{ $payment->payroll_id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-6">
            <a href="{{ route('credit.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Volver a la Lista de Créditos
            </a>
        </div>
    </div>
</div>

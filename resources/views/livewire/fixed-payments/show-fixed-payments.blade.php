<div class="flex justify-center my-6">
    <div class="bg-white p-9 rounded-lg shadow-md space-y-5 w-full max-w-2xl">
        <h2 class="text-2xl font-bold text-gray-900">Detalles del Pago Fijo</h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Sujeto a Pago IGGS</h3>
            <p class="text-gray-900">Q. {{ number_format($fixedPayment->subject_to_iggs_payment, 2) }}</p>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Bonificación Incentivo</h3>
            <p class="text-gray-900">Q. {{ number_format($fixedPayment->bonus_incentive, 2) }}</p>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('fixed-payments.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

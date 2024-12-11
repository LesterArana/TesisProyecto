<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Caja de Abonos -->
            <div class="bg-blue-500 text-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{ format_currency($credits_pend, 2) }}</h3>
                <p class="text-lg">Crédito a Proveedores</p>
                <div class="mt-4">
                    <a href="{{ route('credit.index') }}" class="text-white underline">Más información</a>
                </div>
            </div>

            <!-- Caja de Compras -->
            <div class="bg-teal-500 text-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{ format_currency($sales, 2) }}</h3>
                <p class="text-lg">Ventas al crédito</p>
                <div class="mt-4">
                    <a href="{{ route('sale.index') }}" class="text-white underline">Más información</a>
                </div>
            </div>

            <!-- Caja de Ventas -->
            <div class="bg-purple-500 text-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{ format_currency($customerPayment, 2) }}</h3>
                <p class="text-lg">Pagos de clientes</p>
                <div class="mt-4">
                    <a href="{{ route('customer_payment.index') }}" class="text-white underline">Más información</a>
                </div>
            </div>

            <!-- Caja de Inversión -->
            <div class="bg-gray-700 text-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{ format_currency(abs($inversion), 2) }} Inversión</h3>
                <p class="text-lg">
                    @if($inversion < 0)
                        Por pagar
                    @else
                        Por recuperar
                    @endif</p>
                <div class="bg-gray-700 text-white shadow-md rounded-lg p-6">
                </div>

            </div>

        </div>
    </div>
</div>

<div class="justify-center">
    <div class="md:grid md:grid-cols-12 gap-4">
        <div class="md:col-span-8">
            <h2 class="text-2xl font-bold mb-5 mt-4">Información del Crédito</h2>
            <p><strong>Proveedor:</strong> {{ $credit->supplier->person->company_name }}</p>
            <p><strong>Cuenta Bancaria:</strong> {{ $credit->bankAccount->name_bank }} - {{ $credit->bankAccount->account_number }}</p>
            <p><strong>Método de Pago:</strong> {{ $credit->paymentMethod->name }}</p>
            <p><strong>Número de Comprobante:</strong> {{ $credit->voucher_number }}</p>
            <p><strong>Fecha:</strong> {{ $credit->date }}</p>
            <p><strong>Monto:</strong> Q{{ number_format($credit->mount, 2) }}</p>
            <p><strong>Estado:</strong> {{ $credit->status ? 'Activo' : 'Inactivo' }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $credit->created_at }}</p>
            @if ($credit->imageable)
                <p><strong>Imagen:</strong></p>
                <img src="{{ Storage::url($credit->imageable->path) }}" alt="Comprobante de Crédito" class="w-full h-auto object-cover rounded">
            @endif
        </div>
    </div>
</div>

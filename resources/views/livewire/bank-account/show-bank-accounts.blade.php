<div class="justify-center">
    <div class="md:grid md:grid-cols-12 gap-4">
        <div class="md:col-span-8">
            <h2 class="text-2xl font-bold mb-5 mt-4">Información de la Cuenta Bancaria</h2>
            <p>Banco: {{ $bank_account->name_bank }}</p>
            <p>Número de Cuenta: {{ $bank_account->account_number }}</p>
            <p>Fecha de Creación: {{ $bank_account->created_at }}</p>
        </div>
    </div> 
</div>

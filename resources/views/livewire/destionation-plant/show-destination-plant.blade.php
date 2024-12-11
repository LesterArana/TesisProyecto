<div class="justify-center">
    <div class="md:grid md:grid-cols-12 gap-4">
        <div class="md:col-span-8">
            <h2 class="text-2xl font-bold mb-5 mt-4">Información de la Planta de Destino</h2>
            <p><strong>Nombre:</strong> {{ $destinationPlant->name }}</p>
            <p><strong>Dirección:</strong> {{ $destinationPlant->address }}</p>
            <p><strong>Número de Teléfono:</strong> {{ $destinationPlant->phone_number }}</p>
            <p><strong>Cliente:</strong> {{ $destinationPlant->customer->person->company_name }}</p>
            <p><strong>País:</strong> {{ $destinationPlant->country->name ?? 'No especificado' }}</p>
            <p><strong>Estado:</strong> {{ $destinationPlant->status ? 'Activo' : 'Inactivo' }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $destinationPlant->created_at }}</p>
        </div>
    </div>
</div>


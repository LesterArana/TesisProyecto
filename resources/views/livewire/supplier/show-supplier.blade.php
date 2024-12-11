<div class="justify-center">
    <div class="md:grid md:grid-cols-12 gap-4">
        <div class="md:col-span-8">
            <h2 class="text-2xl font-bold mb-5 mt-4">Información del Proveedor</h2>
            <p><strong>Nombre de la Empresa:</strong> {{ $supplier->person->company_name }}</p>
            <p><strong>Dirección:</strong> {{ $supplier->person->address }}</p>
            <p><strong>Email:</strong> {{ $supplier->person->email }}</p>
            <p><strong>Teléfono:</strong> {{ $supplier->person->phone_number }}</p>
            <p><strong>Tipo de Proveedor:</strong> {{ $supplier->person->type_person }}</p>
            <p><strong>NIT:</strong> {{ $supplier->person->nit_number }}</p>
            <p><strong>Estado:</strong> {{ $supplier->person->state ? 'Activo' : 'Inactivo' }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $supplier->person->created_at }}</p>
        </div>
    </div> 
</div>

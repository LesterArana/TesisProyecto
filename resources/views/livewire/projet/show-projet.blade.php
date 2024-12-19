<div class="flex justify-center my-6">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Detalles del Proyecto</h2>

        <!-- Información del Proyecto -->
        <div class="mb-6">
            <p><strong>Nombre:</strong> {{ $projet->name }}</p>
            <p><strong>Dirección:</strong> {{ $projet->address }}</p>
            <p><strong>Estado:</strong> {{ $projet->status_text }}</p>
        </div>

        <!-- Botón Volver -->
        <div class="flex justify-end">
            <a href="{{ route('projets.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>

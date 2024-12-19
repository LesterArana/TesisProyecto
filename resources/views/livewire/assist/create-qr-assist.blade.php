<div class="flex flex-col items-center">
    <h2 class="text-2xl font-bold mb-4">Registrar Asistencia (QR)</h2>

    <!-- Contenedor del lector de QR -->
    <div id="qr-reader" style="width: 300px;"></div>

    <!-- Proyecto -->
    <div class="mb-6">
        <label for="projet_id" class="block text-gray-700">Proyecto</label>
        <select id="projet_id" wire:model="projet_id" class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Seleccione un proyecto</option>
            @foreach ($projets as $projet)
                <option value="{{ $projet->id }}">{{ $projet->name }}</option>
            @endforeach
        </select>
        @error('projet_id') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <!-- Actividad -->
    <div class="mb-6">
        <label for="activity" class="block text-gray-700">Actividad</label>
        <select id="activity" wire:model="activity" class="block w-full p-2 border border-gray-300 rounded">
            <option value="">Seleccione la actividad</option>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>
        @error('activity') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <!-- Botón Registrar -->
    <button wire:click="store" class="w-full bg-blue-500 text-white py-2 px-4 rounded">
        Registrar Asistencia
    </button>
</div>

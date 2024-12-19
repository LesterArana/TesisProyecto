<div class="flex justify-center my-6">
    <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 w-full max-w-lg" wire:submit.prevent="update">
        <h2 class="text-2xl font-bold mb-4">Editar Proyecto</h2>

        <!-- Nombre -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700">Nombre</label>
            <input type="text" id="name" wire:model="name" class="block w-full p-2 border border-gray-300 rounded">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Dirección -->
        <div class="mb-6">
            <label for="address" class="block text-gray-700">Dirección</label>
            <textarea id="address" wire:model="address" class="block w-full p-2 border border-gray-300 rounded"></textarea>
            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div class="mb-6">
            <label for="status" class="block text-gray-700">Estado</label>
            <select id="status" wire:model="status" class="block w-full p-2 border border-gray-300 rounded">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-between items-center">
            <a href="{{ route('projets.index') }}" class="text-blue-500 underline">Cancelar</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
    </form>
</div>

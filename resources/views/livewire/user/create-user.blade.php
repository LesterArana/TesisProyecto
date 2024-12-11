<div class="flex justify-center my-6">
    <form class="md:w-1/2 space-y-5 p-9 bg-white rounded-lg shadow-md" wire:submit.prevent='store'>
        <h2 class="text-2xl font-bold text-gray-900">Crear Usuario</h2>

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" wire:model="name" placeholder="Nombre" />
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" wire:model="email" placeholder="Email" />
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" wire:model="password" placeholder="Contraseña" />
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Seleccionar Rol -->
        <div>
            <x-input-label for="role" :value="__('Rol')" />
            <select id="role" wire:model="role" class="block w-full p-2 border border-gray-300 rounded text-black bg-white">
                <option value="">Seleccionar Rol</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div class="mb-6">
            <x-input-label for="status" :value="__('Estado')" />
            <input type="checkbox" id="status" wire:model="status" class="form-checkbox h-6 w-6 text-green-500" value="1" checked>
            <span class="ml-2 text-gray-700">Activo</span>
            @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Crear Usuario') }}
        </x-primary-button>
    </form>
</div>

<div class="justify-center">
    <div class="md:grid md:grid-cols-12 gap-4">
        <div class="md:col-span-8">
            <h2 class="text-2xl font-bold mb-5 mt-4">Información del Usuario</h2>
            <p>Nombre: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Fecha de Creación: {{ $user->created_at }}</p>
        </div>
    </div>
</div>

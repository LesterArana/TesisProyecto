<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Caja de Abonos -->
            <div class="bg-green-500 text-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{ $activeEmployees }}</h3>
                <p class="text-lg">Empleados Activos</p>
                <div class="mt-4">
{{--
                    <a href="{{ route('employee.index') }}" class="text-white underline">Más información</a>
--}}
                </div>
            </div>

            <!-- Caja de Proyectos Activos -->
            <div class="bg-yellow-500 text-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{ $activeProjects }}</h3>
                <p class="text-lg">Proyectos Activos</p>
                <div class="mt-4">
{{--
                    <a href="{{ route('projets.index') }}" class="text-white underline">Más información</a>
--}}
                </div>
            </div>


            <!-- Caja de Compras -->
            <div class="bg-teal-500 text-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-bold">{{$activePosition}}</h3>
                <p class="text-lg">Puestos </p>
                <div class="mt-4">
{{--
                    <a href="{{ route('sale.index') }}" class="text-white underline">Más información</a>
--}}
                </div>
            </div>
        </div>
    </div>
</div>

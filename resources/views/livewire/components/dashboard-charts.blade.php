<div class="py-12">
    @livewire('components.dashboard-cards')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-4">
                    <h2 class="text-lg font-semibold mb-4">Distribución de Empleados por Puesto</h2>
                    <div id="pieChart"></div>
                    <div class="mt-4">
                        <ul>
                            @foreach ($positionNames as $index => $name)
                                <li>
                                    {{ $name }}: {{ $employeeCounts[$index] }} empleados
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-8">
                    <h2 class="text-lg font-semibold mb-4">Total de Salarios Pagados por Mes</h2>
                    <div id="payrollChart"></div>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-12">
                    <h2 class="text-lg font-semibold mb-4">Gastos en Viáticos por Mes</h2>
                    <div id="travelChart"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- ApexCharts Script -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var positionNames = @json($positionNames);
        var employeeCounts = @json($employeeCounts);
        var payrollMonths = @json(array_keys($payrollAmounts));
        var payrollValues = @json(array_values($payrollAmounts));
        var expenseMonths = @json(array_keys($travelExpenses));
        var expenseValues = @json(array_values($travelExpenses));

        // 📊 1. Gráfica Circular: Puestos y Empleados
        var optionsPie = {
            chart: { type: 'pie', height: 350 },
            series: employeeCounts,
            labels: positionNames
        };
        var chartPie = new ApexCharts(document.querySelector("#pieChart"), optionsPie);
        chartPie.render();

        // 📊 2. Gráfica de Barras: Salarios Pagados por Mes
        var optionsPayroll = {
            chart: { type: 'bar', height: 350 },
            series: [{ name: 'Total Pagado', data: payrollValues }],
            xaxis: { categories: payrollMonths, title: { text: 'Meses' } },
            yaxis: { title: { text: 'Q' } },
        };
        var chartPayroll = new ApexCharts(document.querySelector("#payrollChart"), optionsPayroll);
        chartPayroll.render();

        // 📊 3. Gráfica de Línea: Gastos en Viáticos por Mes
        var optionsTravel = {
            chart: { type: 'line', height: 350 },
            series: [{ name: 'Gasto en Viáticos', data: expenseValues }],
            xaxis: { categories: expenseMonths, title: { text: 'Meses' } },
            yaxis: { title: { text: 'Q' } },
        };
        var chartTravel = new ApexCharts(document.querySelector("#travelChart"), optionsTravel);
        chartTravel.render();
    </script>

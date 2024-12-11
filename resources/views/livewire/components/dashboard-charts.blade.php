<div class="py-12">
    @livewire('components.dashboard-cards')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-4">
                <h2 class="text-lg font-semibold mb-4">Stock de Productos Activos</h2>
                <div id="pieChart"></div>
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Total de productos en stock: {{ $totalStock }}</h3>
                    <ul>
                        @foreach ($productNames as $index => $name)
                            <li>
                                {{ $name }}: {{ $productStocks[$index] }} unidades
                                @if($totalStock > 0)
                                    ({{ round(($productStocks[$index] / $totalStock) * 100, 2) }}%)
                                @else
                                    (0%)
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-8">
                <h2 class="text-lg font-semibold mb-4">Deudas de Proveedores</h2>
                <div id="barLineChart"></div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 lg:col-span-12">
                <h2 class="text-lg font-semibold mb-4">Deudas de Clientes</h2>
                <div id="customerLineChart"></div>
            </div>

        </div>
    </div>
</div>

<!-- ApexCharts Script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var supplierNames = @json(array_column($supplierDebts, 'name'));
    var supplierBalances = @json(array_column($supplierDebts, 'balance'));
    var customerNames = @json(array_column($customerDebts, 'name'));
    var customerBalances = @json(array_column($customerDebts, 'balance'));
    var categorySalesData = @json($categorySalesData);
    var productNames = @json($productNames);
    var productStocks = @json($productStocks);


    var optionsBarLine = {
        chart: {
            height: 350,
            type: 'line',
            stacked: true
        },
        series: [{
            name: 'Proveedores (Column)',
            type: 'column',
            data: supplierBalances.length > 0 ? supplierBalances : [0]
        }, {
            name: 'Proveedores (Line)',
            type: 'line',
            data: supplierBalances.length > 0 ? supplierBalances : [0]
        }],
        stroke: {
            width: [0, 4]
        },
        markers: {
            size: 5,
            hover: {
                size: 7
            }
        },
        xaxis: {
            categories: supplierNames.concat(supplierNames),
            title: {
                text: 'Proveedores'
            }
        },
        yaxis: [{
            title: {
                text: 'Deudas',
            },
            labels: {
                formatter: function (value) {
                    return 'Q ' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            }
        }],
        tooltip: {
            shared: false,
            intersect: false,
            y: {
                formatter: function (value) {
                    if (value !== undefined) {
                        return 'Q ' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    } else {
                        return '';
                    }
                }
            }
        }
    };

    var chartBarLine = new ApexCharts(document.querySelector("#barLineChart"), optionsBarLine);
    chartBarLine.render();


    var optionsCustomerLine = {
        chart: {
            height: 350,
            type: 'line'
        },
        series: [{
            name: 'Deudas de Clientes',
            data: customerBalances.length > 0 ? customerBalances : [0]
        }],
        xaxis: {
            categories: customerNames.length > 0 ? customerNames : ['Sin datos'],
            title: {
                text: 'Clientes'
            }
        },
        yaxis: {
            title: {
                text: 'Deudas'
            },
            labels: {
                formatter: function (value) {
                    return 'Q ' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            }
        },
        stroke: {
            curve: 'smooth'
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return 'Q ' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            }
        }
    };

    var chartCustomerLine = new ApexCharts(document.querySelector("#customerLineChart"), optionsCustomerLine);
    chartCustomerLine.render();



    var categories = Object.keys(categorySalesData);
    var seriesData = categories.map(function(category) {
        return {
            name: category,
            data: Object.values(categorySalesData[category])
        };
    });

    // Gráfica circular
    var optionsPie = {
        chart: {
            type: 'pie',
            height: 350
        },
        series: productStocks,
        labels: productNames,
    };

    var chartPie = new ApexCharts(document.querySelector("#pieChart"), optionsPie);
    chartPie.render();
</script>

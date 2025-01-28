@php
    $links = [
         [
            'name' => 'Dashboard',
            'url' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
            'icon' => 'fa-solid fa-file-invoice-dollar',
            'permission'=>'payment_methods.index',
        ],
        [
            'name' => 'Empleados',
            'url' => route('employees.index'),
            'active' => request()->routeIs('employees.index','employees.create','employees.show','employees.edit'),
            'icon' => 'fa-solid fa-user-plus',
            'permission'=>'payment_methods.index',
        ],
        [
            'name' => 'Asistencia',
            'url' => route('assists.index'),
            'active' => request()->routeIs('assists.index','assists.create','assists.show','assists.edit'),
            'icon' => 'fa-solid fa-list-check',
            'permission'=>'payment_methods.index',
        ],
        [
            'name' => 'Proyectos',
            'url' => route('projets.index'),
            'active' => request()->routeIs('projets.index','projets.create','projets.show','projets.edit'),
            'icon' => 'fa-solid fa-warehouse',
            'permission'=>'payment_methods.index',
        ],
         [
            'name' => 'Puestos',
            'url' => route('positions.index'),
            'active' => request()->routeIs('positions.index','positions.create','positions.show','positions.edit'),
            'icon' => 'fa-solid fa-hammer',
            'permission'=>'payment_methods.index',
        ],
          [
            'name' => 'Viáticos',
            'url' => route('travel-expenses.index'),
            'active' => request()->routeIs('travel-expenses.index','travel-expenses.create','travel-expenses.show','travel-expenses.edit'),
            'icon' => 'fa-solid fa-truck-plane',
            'permission'=>'payment_methods.index',
        ],
         [
            'name' => 'Horas extras',
            'url' => route('number-of-hours.index'),
            'active' => request()->routeIs('number-of-hours.index','number-of-hours.create','number-of-hours.show','number-of-hours.edit'),
            'icon' => 'fa-solid fa-stopwatch-20',
            'permission'=>'payment_methods.index',
        ],
         [
        'name' => 'Horarios',
        'url' => route('schedules.index'),
        'active' => request()->routeIs('schedules.index', 'schedules.create', 'schedules.show', 'schedules.edit'),
        'icon' => 'fa-solid fa-clock',
        'permission' => 'payment_methods.index',
        ],
        [
        'name' => 'Pagos Fijos',
        'url' => route('fixed-payments.index'),
        'active' => request()->routeIs('fixed-payments.index', 'fixed-payments.create', 'fixed-payments.show', 'fixed-payments.edit'),
        'icon' => 'fa-solid fa-money-bill-wave',
        'permission' => 'payment_methods.index',
        ],
        [
            'name' => 'Usuarios',
            'url' => route('user.index'),
            'active' => request()->routeIs('user.create','user.index','user.edit','user.show'),
            'icon' => 'fa-solid fa-people-group',
            'permission'=>'user.index',
        ],

        [
            'name' => 'Nóminas',
            'url' => route('payrolls.index'),
            'active' => request()->routeIs('payrolls.index','payrolls.create','payrolls.show','payrolls.edit'),
            'icon' => 'fa-solid fa-file-alt',
            'permission'=>'payment_methods.index',
        ],
         [
            'name' => 'Adelantos',
            'url' => route('credit.index'),
            'active' => request()->routeIs('credit.index','credit.create','credit.show'),
            'icon' => 'fa-solid fa-wallet',
            'permission'=>'payment_methods.index',
        ],




    ];
@endphp

<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-white sm:translate-x-0"
       :class="{
            '-translate-x-full': !open,
            'translate-x-0': open
        }"
       aria-label="Sidebar">

    <div class="h-full px-3 py-1 pb-4 overflow-y-auto bg-white rounded-lg mx-1 py-3"
         style="box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
        <ul class="space-y-2 font-medium text-sm">
            @foreach($links as $link)
                @can($link['permission'])
                    <li>
                        <a href="{{ $link['url'] }}"
                           class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                            <i class="{{ $link['icon'] }} text-gray-500"></i>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </a>
                    </li>
                @endcan
            @endforeach
        </ul>
    </div>
</aside>

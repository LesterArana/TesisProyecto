@php
    $links = [

        [
            'name' => 'Formas de pago',
            'url' => route('payment_methods.index'),
            'active' => request()->routeIs('payment_methods.index','payment_methods.create','payment_methods.show','payment_methods.edit'),
            'icon' => 'fa-solid fa-money-check-dollar',
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
            'name' => 'Usuarios',
            'url' => route('user.index'),
            'active' => request()->routeIs('user.create','user.index','user.edit','user.show'),
            'icon' => 'fa-solid fa-people-group',
            'permission'=>'user.index',
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

    <div class="h-full px-3 py-1 pb-4 overflow-y-auto bg-white rounded-lg mx-1 py-3" style="box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
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

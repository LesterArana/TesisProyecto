@php
    $links = [
        [
            'name' => 'Dashboard',
            'url' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
            'icon' => 'fa-solid fa-chart-line',
            'permission'=>'dashboard',
        ],

        [
            'name' => 'Ventas',
            'url' => route('sale.index'),
            'active' => request()->routeIs('sale.index','sale.create','sale.show'),
            'icon' => 'fa-solid fa-shop',
            'permission'=>'sale.index',
        ],
        [
            'name' => 'Compras',
            'url' => route('shopping.index'),
            'active' => request()->routeIs('shopping.index','shopping.create','shopping.show'),
            'icon' => 'fa-solid fa-cart-shopping',
            'permission'=>'shopping.index',
        ],
        [
            'name' => 'Proveedores',
            'url' => route('supplier.index'),
            'active' => request()->routeIs('supplier.index','supplier.create','supplier.edit','supplier.show'),
            'icon' => 'fa-solid fa-tree-city',
            'permission'=>'supplier.index',
        ],
        [
            'name' => 'Creditos',
            'url' => route('credit.index'),
            'active' => request()->routeIs('credit.index','credit.create','credit.edit','credit.show'),
            'icon' => 'fa-solid fa-credit-card',
            'permission'=>'credit.index',
        ],
        [
            'name' => 'Cliente',
            'url' => route('customer.index'),
            'active' => request()->routeIs('customer.index','customer.create','customer.edit','customer.show'),
            'icon' => 'fa-solid fa-user-clock',
            'permission'=>'customer.index',
        ],
        [
            'name' => 'Plantas destino',
            'url' => route('destination_plant.index'),
            'active' => request()->routeIs('destination_plant.index','destination_plant.edit','destination_plant.create','destination_plant.show'),
            'icon' => 'fa-solid fa-map-location-dot',
            'permission'=>'destination_plant.index',
        ],
         [
            'name' => 'Pagos de Clientes',
            'url' => route('customer_payment.index'),
            'active' => request()->routeIs('customer_payment.create','customer_payment.index'),
            'icon' => 'fa-solid fa-handshake',
            'permission'=>'customer_payment.index',
        ],
        [
            'name' => 'Formas de pago',
            'url' => route('payment_methods.index'),
            'active' => request()->routeIs('payment_methods.index','payment_methods.create','payment_methods.show','payment_methods.edit'),
            'icon' => 'fa-solid fa-money-check-dollar',
            'permission'=>'payment_methods.index',
        ],
        [
            'name' => 'Cuentas de bancos',
            'url' => route('bank_account.index'),
            'active' => request()->routeIs('bank_account.index','bank_account.create','bank_account.edit','bank_account.show'),
            'icon' => 'fa-solid fa-building-columns',
            'permission'=>'bank_account.index',
        ],
        [
            'name' => 'Usuarios',
            'url' => route('user.index'),
            'active' => request()->routeIs('user.create','user.index','user.edit','user.show'),
            'icon' => 'fa-solid fa-people-group',
            'permission'=>'user.index',
        ],
        [
            'name' => 'Categorías',
            'url' => route('category.index'),
            'active' => request()->routeIs('category.index','category.create','category.edit','category.show'),
            'icon' => 'fa-solid fa-list',
            'permission'=>'category.index',
        ],
        [
            'name' => 'Productos',
            'url' => route('product.index'),
            'active' => request()->routeIs('product.index','product.create','product.show','product.edit'),
            'icon' => 'fa-regular fa-pen-to-square',
            'permission'=>'product.index',
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

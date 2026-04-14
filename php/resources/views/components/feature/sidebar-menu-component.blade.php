@php
    $currentActiveMenu = '';
    switch(request()->route()->getName()) {
        case 'products.categories.index':
        case 'products.brands.index':
        case 'products.units.index':
        case 'products.index':
        case 'products.pricing.index':
            $currentActiveMenu = 'products';
            break;
        case 'suppliers.index':
            $currentActiveMenu = 'suppliers';
            break;
    }
@endphp
<ul class="flex flex-col gap-2">
    <li>
        <x-dropdown-menu :dropdownIconClass="$currentActiveMenu == 'products' ? 'stroke-white group-hover:stroke-gray-500' : ''">
            <x-slot:icon class="iconMenu"><x-product-icon class="{{$currentActiveMenu == 'products' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
            <x-slot:button class="textMenu {{$currentActiveMenu == 'products' ? 'group bg-blue-500 text-white hover:text-gray-800' : ''}}">Products</x-slot:button>
            <x-list-item><x-slot:link href="{{ route('products.categories.index') }}" class="{{request()->routeIs('products.categories.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Category</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="{{ route('products.brands.index') }}" class="{{request()->routeIs('products.brands.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Brand</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="{{ route('products.units.index') }}" class="{{request()->routeIs('products.units.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Units</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="{{ route('products.index') }}" class="{{request()->routeIs('products.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Product List</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="{{ route('products.pricing.index') }}" class="{{request()->routeIs('products.pricing.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Pricing</x-slot:link></x-list-item>
        </x-dropdown-menu>
    </li>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'suppliers' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-supplier-icon class="{{$currentActiveMenu == 'suppliers' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.index') }}" class="{{request()->routeIs('suppliers.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Suppliers</x-slot:link>
    </x-list-item>
    <li>
        <x-dropdown-menu>
            <x-slot:icon class="iconMenu"><x-shop-icon /></x-slot:icon>
            <x-slot:button class="textMenu">Shops</x-slot:button>
            <x-list-item><x-slot:link href="#">Shop List</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Inventory</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Stock Transfer</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Stock Adjustment</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Stock Movement History</x-slot:link></x-list-item>
        </x-dropdown-menu>
    </li>
    <li>
        <x-dropdown-menu>
            <x-slot:icon class="iconMenu"><x-sales-icon /></x-slot:icon>
            <x-slot:button class="textMenu">Sales</x-slot:button>
            <x-list-item><x-slot:link href="#">POS / New Sale</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Sales List</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Returns / Refunds</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Sales Reports</x-slot:link></x-list-item>
        </x-dropdown-menu>
    </li>
    <li>
        <x-dropdown-menu>
            <x-slot:icon class="iconMenu"><x-purchasing-icon /></x-slot:icon>
            <x-slot:button class="textMenu">Purchasing</x-slot:button>
            <x-list-item><x-slot:link href="#">Purchase Orders</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Supplier List</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Receive Deliveries</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Purchase History</x-slot:link></x-list-item>
        </x-dropdown-menu>
    </li>
    <li>
        <x-dropdown-menu>
            <x-slot:icon class="iconMenu"><x-accounting-icon /></x-slot:icon>
            <x-slot:button class="textMenu">Accounting</x-slot:button>
            <x-list-item><x-slot:link href="#">Transactions</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Expenses</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Income</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Chart of Accounts</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Financial Reports</x-slot:link></x-list-item>
        </x-dropdown-menu>
    </li>
    <li>
        <x-dropdown-menu>
            <x-slot:icon class="iconMenu"><x-reports-icon /></x-slot:icon>
            <x-slot:button class="textMenu">Reports</x-slot:button>
            <x-list-item><x-slot:link href="#">Sales Reports</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Inventory Reports</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Purchase Reports</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Financial Reports</x-slot:link></x-list-item>
        </x-dropdown-menu>
    </li>
    <li>
        <x-dropdown-menu>
            <x-slot:icon class="iconMenu"><x-user-setting-icon /></x-slot:icon>
            <x-slot:button class="textMenu">User Management</x-slot:button>
            <x-list-item><x-slot:link href="#">User List</x-slot:link></x-list-item>
            <x-list-item><x-slot:link href="#">Activity Logs</x-slot:link></x-list-item>
        </x-dropdown-menu>
    </li>
    <x-list-item class="pl-0">
        <x-slot:icon class="iconMenu"><x-settings-icon /></x-slot:icon>
        <x-slot:link href="#" class="textMenu">Settings</x-slot:link>
    </x-list-item>
</ul>
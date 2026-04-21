@php
    $currentActiveMenu = '';
    switch(request()->route()->getName()) {
        case 'shops.show':
            $currentActiveMenu = 'dashboard';
            break;
        case 'shops.staffs.index':
            $currentActiveMenu = 'staffs';
            break;
        case 'shops.index':
            $currentActiveMenu = 'shops';
        case 'shops.purchase-orders.index':
            $currentActiveMenu = 'purchase-orders';
            break;
    }
@endphp
<ul class="flex flex-col gap-2">
    <x-list-item class="pl-0 {{$currentActiveMenu == 'dashboard' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-shop-icon class="{{$currentActiveMenu == 'dashboard' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('shops.show', $shop->id) }}" class="textMenu {{request()->routeIs('shops.show') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Dashboard</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'shops' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-user-setting-icon class="{{$currentActiveMenu == 'staffs' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('shops.staffs.index', $shop->id) }}" class="textMenu {{request()->routeIs('shops.staffs.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Staffs</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'purchase-orders' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-purchasing-icon class="{{$currentActiveMenu == 'purchase-orders' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('shops.purchase-orders.index', $shop->id) }}" class="textMenu {{request()->routeIs('shops.purchase-orders.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Purchase Orders</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'suppliers' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-reports-icon class="{{$currentActiveMenu == 'inventory' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.index') }}" class="textMenu {{request()->routeIs('suppliers.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Inventory</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'suppliers' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-sales-icon class="{{$currentActiveMenu == 'inventory' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.index') }}" class="textMenu {{request()->routeIs('suppliers.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Sales</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'suppliers' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-settings-icon class="{{$currentActiveMenu == 'inventory' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.index') }}" class="textMenu {{request()->routeIs('suppliers.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Settings</x-slot:link>
    </x-list-item>
</ul>
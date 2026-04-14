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
        case 'shops.index':
            $currentActiveMenu = 'shops';
            break;
    }
@endphp
<ul class="flex flex-col gap-2">
    <x-list-item class="pl-0 {{$currentActiveMenu == 'suppliers' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-supplier-icon class="{{$currentActiveMenu == 'inventory' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.index') }}" class="textMenu {{request()->routeIs('suppliers.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Inventory</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'shops' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-shop-icon class="{{$currentActiveMenu == 'shops' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('shops.index') }}" class="textMenu {{request()->routeIs('shops.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Shops/Branches</x-slot:link>
    </x-list-item>
</ul>
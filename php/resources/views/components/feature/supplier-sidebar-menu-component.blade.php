@php
    $currentActiveMenu = '';
    switch(request()->route()->getName()) {
        case 'suppliers.show':
            $currentActiveMenu = 'dashboard';
            break;
        case 'suppliers.pricing.index':
            $currentActiveMenu = 'price';
            break;
        case 'suppliers.product.index':
            $currentActiveMenu = 'products';
            break;
    }
@endphp
<ul class="flex flex-col gap-2">
    <x-list-item class="pl-0 {{$currentActiveMenu == 'dashboard' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-supplier-icon class="{{$currentActiveMenu == 'dashboard' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.show', $supplier->id) }}" class="textMenu {{request()->routeIs('suppliers.show') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Dashboard</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'price' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-sales-icon class="{{$currentActiveMenu == 'price' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.pricing.index', $supplier->id) }}" class="textMenu {{request()->routeIs('suppliers.pricing.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Pricing</x-slot:link>
    </x-list-item>
    <x-list-item class="pl-0 {{$currentActiveMenu == 'products' ? 'group stroke-white group-hover:stroke-gray-500' : ''}}">
        <x-slot:icon class="iconMenu"><x-product-icon class="{{$currentActiveMenu == 'products' ? 'fill-white group-hover:fill-gray-700' : ''}}"/></x-slot:icon>
        <x-slot:link href="{{ route('suppliers.product.index', $supplier->id) }}" class="textMenu {{request()->routeIs('suppliers.product.index') ? 'bg-blue-500 text-white hover:text-gray-800' : ''}}">Supplier's Products</x-slot:link>
    </x-list-item>
</ul>
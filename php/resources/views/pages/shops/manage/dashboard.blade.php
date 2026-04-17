@extends('pages.shops.manage.app')
@section('shop_content')
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <x-card class="rounded-md leading-none border-l-6 border-l-green-800 bg-green-500 text-white">
            <h1 class="uppercase font-bold text-lg mb-0">₱ 360.00</h1>
            <span class="text-sm overflow-hidden whitespace-nowrap text-ellipsis">Today's Sale</span>
            <x-card-footer class="p-0 mt-1"><x-button href="" variant="transparent">Show Info</x-button></x-card-footer>
        </x-card>

        <!-- Inventory Value -->
        <x-card class="rounded-md leading-none border-l-6 border-l-blue-700 bg-blue-500 text-white">
            <h1 class="uppercase font-bold text-lg mb-0">₱ 25,400</h1>
            <span class="text-sm overflow-hidden whitespace-nowrap text-ellipsis">Inventory Value</span>
            <x-card-footer class="p-0 mt-1">
                <x-button href="" variant="transparent">View Inventory</x-button>
            </x-card-footer>
        </x-card>

        <!-- Low Stock -->
        <x-card class="rounded-md leading-none border-l-6 border-l-yellow-700 bg-yellow-500 text-white">
            <h1 class="uppercase font-bold text-lg mb-0">5 Items</h1>
            <span class="text-sm overflow-hidden whitespace-nowrap text-ellipsis">Low Stock</span>
            <x-card-footer class="p-0 mt-1">
                <x-button href="" variant="transparent">View Items</x-button>
            </x-card-footer>
        </x-card>

        <!-- Pending PO -->
        <x-card class="rounded-md leading-none border-l-6 border-l-red-700 bg-red-500 text-white">
            <h1 class="uppercase font-bold text-lg mb-0">3 Orders</h1>
            <span class="text-sm overflow-hidden whitespace-nowrap text-ellipsis">Pending Purchase Orders</span>
            <x-card-footer class="p-0 mt-1">
                <x-button href="" variant="transparent">View Orders</x-button>
            </x-card-footer>
        </x-card>

        <!-- No. of Staffs -->
        <x-card class="rounded-md leading-none border-l-6 border-l-orange-700 bg-orange-500 text-white">
            <h1 class="uppercase font-bold text-lg mb-0">4 Staffs</h1>
            <span class="text-sm overflow-hidden whitespace-nowrap text-ellipsis">Current No. of Staffs</span>
            <x-card-footer class="p-0 mt-1">
                <x-button href="{{route('shops.staffs.index', $shop->id)}}" variant="transparent">View Staffs</x-button>
            </x-card-footer>
        </x-card>
    </div>
@endsection
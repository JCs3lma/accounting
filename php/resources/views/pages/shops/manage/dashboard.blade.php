@extends('layouts.app')

@section('content')
    <article>
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <img src="{{asset($shop->logo_path)}}" class="w-[3vw] max-w-[3vw] img-cover rounded-md" />
                <h1>{{$shop->shop_name}}</h1>
            </div>
            <x-button variant="plain" class="w-20 h-8" href="{{route('shops.index')}}">Back</x-button>
        </div>
        <div class="border-b border-gray-500 my-2 w-full h-[2px]">&nbsp;</div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
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
        </div>
    </article>
@endsection

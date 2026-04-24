@extends('pages.shops.manage.app')
@php
$thead = [
    'product.name' =>  'Name',
    'quantity' =>  'Quantity',
    'price' =>  [
        'header' => 'Price',
        'prefix' => config('const.money').' ',
        'format' => 'money',
    ],
    'total' => [
        'header' => 'Total',
        'prefix' => config('const.money').' ',
        'format' => 'money'
    ],
];
@endphp

@section('shop_content')
    <article class="flex flex-col flex-1 overflow-hidden min-h-0">
        <x-filter-form 
            route="{{route('shops.purchase-orders.index', $shop->id)}}"
            class="shrink-0"
        >
            <div class="flex flex-col lg:flex-row gap-3 w-full">
                <x-select
                    id="search_status"
                    name="status"
                    label="Status"
                    :showPlaceHolder="true"
                >
                    <option>All</option>
                    @foreach(config('const.purchase_order_status') as $status)
                        <option value="{{$status}}" {{ request()->get('status') === $status ? 'selected' : '' }}>{{$status}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex gap-3 w-full flex-1">
                <x-button variant="info" type="submit" class="rounded-md flex gap-2 items-center justify-center flex-1 lg:flex-initial">
                    <x-search-icon class="fill-white" />
                    <span>Search</span>
                </x-button>
                <x-button variant="default" href="{{route('shops.purchase-orders.index', $shop->id)}}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-filter-form>
        <x-table
            :thead="$thead"
            :tbody="$purchase_order->orders"
            title="Purchased Order Items"
            cardContainerID="tableContainer"
            cardContainerClass="flex-1 min-w-0 transition-all duration-500"
            cardHeaderClass="flex flex-row py-3 px-4"
            titleClass="text-lg font-semibold text-gray-800"
            :booleanMessage="[0 => 'In Active', 1 => 'Active']"
            customNoDataMessage="No purchased order items found. Please adjust your filters or change page."
            tableContainerClass="flex-1 lg:overflow-y-none {{count($purchase_order->orders) < 5 ? 'h-full' : ''}}"
        >
            <x-slot:rightPocket>
                <div class="flex flex-row gap-2">
                    <x-button id="addPurchaseOrder" variant="success" class="rounded-md text-md">Add</x-button>
                    <x-button href="{{route('shops.purchase-orders.index', $shop->id)}}" variant="default" class="rounded-md text-md">Go Back</x-button>
                </div>
            </x-slot:rightPocket>
            <x-slot:dataActions class="relative w-20 mx-auto" dataActionsClassHeader="flex items-center justify-end w-20">
                <x-action-menu/>
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection

@section('footer')
    <x-modal header="Edit Purchase Order" headerClass="modalTitle">
        <div id="modalContent"></div>
    </x-modal>
@endsection
@extends('pages.shops.manage.app')
@php
$thead = [
    'po_number' =>  'PO #',
    'supplier.name' => 'Supplier',
    'order_date' => 'Date Order',
    'expected_date' => 'Expected Date',
    'status' => 'Status',
    'total' => 'Total',
];
@endphp
@section('shop_content')
    <article>
        <x-filter-form 
            route="{{route('shops.staffs.index', $shop->id)}}"
        >
            <div class="flex flex-col lg:flex-row gap-3 w-full">
                <x-input
                    id="search_po_number"
                    name="po_number"
                    type="text"
                    label="PO #"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('po_number') && request()->get('po_number') !== 'null' ? request()->get('po_number') : ''}}"
                />
                <x-input
                    id="search_supplier_name"
                    name="supplier_name"
                    type="text"
                    label="Supplier Name"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('supplier_name') && request()->get('supplier_name') !== 'null' ? request()->get('supplier_name') : ''}}"
                />
                <x-input
                    id="search_order_date"
                    name="order_date"
                    type="date"
                    label="Order Date"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('order_date') && request()->get('order_date') !== 'null' ? request()->get('order_date') : ''}}"
                />
                <x-input
                    id="search_expected_date"
                    name="expected_date"
                    type="date"
                    label="Expected Date"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('expected_date') && request()->get('expected_date') !== 'null' ? request()->get('expected_date') : ''}}"
                />
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
                <x-button variant="default" href="{{route('shops.staffs.index', $shop->id)}}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-filter-form>
        <div class="flex flex-row gap-2">
            <x-table
                :thead="$thead"
                :tbody="$purchaseOrders"
                title="Purchased Orders"
                cardContainerID="tableContainer"
                cardContainerClass="flex-1 min-w-0 transition-all duration-500"
                cardHeaderClass="flex flex-row py-3 px-4"
                titleClass="text-lg font-semibold text-gray-800"
                :booleanMessage="[0 => 'In Active', 1 => 'Active']"
                customNoDataMessage="No purchased orders found. Please adjust your filters or change page."
            >
                <x-slot:rightPocket>
                    <x-button id="addPurchaseOrder" variant="success" class="rounded-md text-md">Add</x-button>
                </x-slot:rightPocket>
                <x-slot:dataActions class="relative w-20 mx-auto" dataActionsClassHeader="flex items-center justify-end w-20">
                    <x-action-menu />
                </x-slot:dataActions>
            </x-table>
            <div class="relative">
                <x-card id="purchaseOrderPanel" class="hidden w-[400px] h-full transform translate-x-full transition-transform duration-300 ease-in-out z-50">
                    <x-card-header class="flex justify-between items-center p-0">
                        <span>Add Purchase Order</span>
                        <x-button id="closePurchaseOrder" variant="default">
                            Close
                        </x-button>
                    </x-card-header>

                    Slide out this card container from right when addPurchaseOrder is clicked
                </x-card>
            </div>
        </div>
    </article>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('addPurchaseOrder');
            const closeBtn = document.getElementById('closePurchaseOrder');
            const panel = document.getElementById('purchaseOrderPanel');

            openBtn.addEventListener('click', function() {
                panel.classList.remove('hidden');

                requestAnimationFrame(() => {
                    panel.classList.remove('translate-x-full');
                });
            });

            closeBtn.addEventListener('click', function() {

                panel.classList.add('absolute');
                panel.classList.add('-right-50');
                panel.classList.add('translate-x-full');

                panel.addEventListener('transitionend', function handler() {
                    panel.classList.add('hidden');
                    panel.classList.remove('absolute');
                    panel.classList.remove('-right-50');
                    panel.removeEventListener('transitionend', handler);
                });
            });
        });
    </script>
@endpush
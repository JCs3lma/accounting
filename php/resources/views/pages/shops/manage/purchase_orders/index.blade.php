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
    <article class="flex flex-col flex-1 overflow-hidden min-h-0">
        <x-filter-form 
            route="{{route('shops.staffs.index', $shop->id)}}"
            class="shrink-0"
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
        <div class="flex-1 flex flex-row gap-2 min-h-0 relative">
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
            <div id="purchaseOrderPanelContainer" class="relative min-h-0 lg:flex-none md:flex-none">
                <x-card
                    id="purchaseOrderPanel"
                    class="hidden w-full lg:w-[400px] h-full min-h-0 flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-50 min-h-0"
                >
                    <x-card-header class="flex justify-between items-center p-2 shrink-0">
                        <span>Add Purchase Order</span>
                        <x-button id="closePurchaseOrder" variant="default">
                            Close
                        </x-button>
                    </x-card-header>

                    <form class="my-2 flex-1 flex flex-col min-h-0">
                        <div class="flex-1 min-h-0 overflow-y-auto">
                            <x-select
                                name="supplier_id"
                                label="Supplier"
                                :showPlaceHolder="true"
                                class="mb-2"
                                required
                            >
                                <option disabled selected value="">Select Supplier</option>
                                @foreach($dropdowns['suppliers'] as $suppliers)
                                    <option value="{{ $suppliers->id }}" {{ request()->get('supplier_id') == $suppliers->id ? 'selected' : '' }}>{{ $suppliers->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input
                                class="mb-2"
                                id="order_date"
                                name="order_date"
                                type="date"
                                placeholder="Order Date"
                                label="Order Date"
                                required
                                :value="\Carbon\Carbon::now()->format('Y-m-d')"
                            />
                            <x-input
                                class="mb-2"
                                id="expected_date"
                                name="expected_date"
                                type="date"
                                placeholder="Expected Date"
                                label="Expected Date"
                                required
                                :value="\Carbon\Carbon::now()->format('Y-m-d')"
                            />
                            <x-select
                                id="status"
                                name="status"
                                label="Status"
                                :showPlaceHolder="true"
                            >
                                @foreach(config('const.purchase_order_status') as $status)
                                    <option value="{{$status}}" {{ request()->get('status') === $status ? 'selected' : '' }}>{{$status}}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <x-card-footer class="shrink-0 p-0 flex lg:flex-col gap-1 items-start">
                            <span>SubTotal: <input name="subtotal" value="0" readonly /></span>
                            <span>Total: <input name="total" value="0" readonly /></span>
                            <x-button variant="info-outline" type="submit" class="w-full mt-2">Create Purchase Order</x-button>
                        </x-card-footer>
                    </form>
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
            const panelContainer = document.getElementById('purchaseOrderPanelContainer');
            const tableContainer = document.getElementById('tableContainer');
            const supplierAndProducts = `$dropdowns['suppliers']`;

            openBtn.addEventListener('click', function() {
                panel.classList.remove('hidden');
                panel.classList.add('flex');
                panelContainer.classList.add('flex-1');
                tableContainer.classList.add('lg:block');
                tableContainer.classList.add('md:block');
                tableContainer.classList.add('hidden');

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
                    panel.classList.remove('flex');
                    panel.classList.remove('absolute');
                    panel.classList.remove('-right-50');
                
                    panelContainer.classList.remove('flex-1');

                    tableContainer.classList.remove('lg:block');
                    tableContainer.classList.remove('md:block');
                    tableContainer.classList.remove('hidden');
                    panel.removeEventListener('transitionend', handler);
                });
            });
        });
    </script>
@endpush
@extends('layouts.app')
@php
$thead = [
    'serial_number' =>  'Serial Number',
    'sku' => 'SKU',
    'status' => 'Status',
    'note' => 'Note'
];
@endphp

@section('content')
    <article>
        <x-filter-form 
            route="{{route('products.serial_number.index', $product->id)}}"
        >
            <div class="flex flex-col lg:flex-row gap-3 w-full">
                <x-input
                    id="search_name"
                    name="name"
                    type="text"
                    label="Name"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('name') && request()->get('name') !== 'null' ? request()->get('name') : ''}}"
                />
                <x-select
                    id="search_is_active"
                    name="is_active"
                    label="Is Active"
                    :showPlaceHolder="true"
                >
                    <option>All</option>
                    <option value="true" {{ request()->get('is_active') === 'true' ? 'selected' : '' }}>Active</option>
                    <option value="false" {{ request()->get('is_active') === 'false' ? 'selected' : '' }}>In active</option>
                </x-select>
            </div>
            <div class="flex gap-3 w-full flex-1">
                <x-button variant="info" type="submit" class="rounded-md flex gap-2 items-center justify-center flex-1 lg:flex-initial">
                    <x-search-icon class="fill-white" />
                    <span>Search</span>
                </x-button>
                <x-button variant="default" href="{{ route('products.index') }}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-card>
        <x-table
            :thead="$thead"
            :tbody="$serialNumbers"
            :title="'Serial Numbers for '.$product->name.''"
            cardHeaderClass="flex flex-row py-3 px-4"
            titleClass="text-lg font-semibold text-gray-800"
            :booleanMessage="[0 => 'In Active', 1 => 'Active']"
            customNoDataMessage="No products found. Please adjust your filters or change page."
        >
            <x-slot:rightPocket>
                <x-button id="addProduct" variant="success" data-modal-open class="rounded-md text-md">Add</x-button>
            </x-slot:rightPocket>
            <x-slot:dataActions class="relative w-20 mx-auto" dataActionsClassHeader="flex items-center justify-end w-20">
                <x-action-menu :isIncludeManage="true"/>
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection
@section('footer')
    <x-modal header="Add Product" headerClass="modalTitle">
        <div id="modalContent"></div>
    </x-modal>
@endsection
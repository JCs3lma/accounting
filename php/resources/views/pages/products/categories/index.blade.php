@extends('layouts.app')
@php
$thead = [
    'name' => 'Name',
    'description' => 'Description',
    'is_active' => 'Active',
];
@endphp

@section('content')
    @if ($errors->any())
        <x-card class="bg-red-500 py-2 px-3 mb-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </x-card>
    @endif
    <article>
        <x-card class="mb-4">
            <form action="{{route('products.categories.index')}}" class="relative w-full lg:w-auto">
                <h3 class="mb-2">Filters</h3>
                <div class="flex gap-3">
                    <x-input
                        name="name"
                        type="search"
                        label="Name"
                    />
                    <x-select
                        name="is_active"
                        label="Is Active"
                        :showPlaceHolder="true"
                    >
                        <option selected>All</option>
                        <option value="true">Active</option>
                        <option value="false">In active</option>
                    </x-select>
                    <x-button variant="info" type="submit" class="rounded-md flex gap-2 items-center">
                        <x-search-icon class="fill-white" />
                        <span>Search</span>
                    </x-button>
                </div>
            </form>
        </x-card>
        <x-table :thead="$thead" :tbody="$categories" title="Categories" titleClass="text-lg font-semibold text-gray-800">
            <x-slot:rightPocket>
                <x-button variant="success" data-modal-open class="rounded-md text-md">Add</x-button>
            </x-slot:rightPocket>
            <x-slot:dataActions class="flex items-center justify-center" dataActionsClassHeader="flex items-center justify-center">
                <x-nav-menu-icon />
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection
@section('footer')
    <x-modal header="Add Category">
        <x-category-form action="{{route('products.categories.store')}}" method="POST"/>
    </x-modal>
@endsection
@extends('layouts.app')

@section('content')
    <section class="flex flex-col flex-1 overflow-hidden min-h-0">
        <x-filter-form 
            route="{{route('suppliers.index')}}"
        >
            <div class="flex flex-col lg:flex-row gap-3 w-full">
                <x-input
                    id="search_name"
                    name="name"
                    type="text"
                    label="Product Name"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('name') && request()->get('name') !== 'null' ? request()->get('name') : ''}}"
                />
            </div>
            <div class="flex gap-3 w-full flex-1">
                <x-button variant="info" type="submit" class="rounded-md flex gap-2 items-center justify-center flex-1 lg:flex-initial">
                    <x-search-icon class="fill-white" />
                    <span>Search</span>
                </x-button>
                <x-button variant="default" href="{{ route('suppliers.index') }}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-filter-form>
        <div class="flex-1 flex flex-col lg:flex-row gap-4 min-h-0">
            <x-card class="w-full lg:w-[20vw] order-1 lg:order-2">
                <x-card-header class="p-0">Add Products</x-card-header>
            </x-card>
            <x-card class="flex flex-col w-full order-2 lg:order-1 overflow-hidden min-h-0">
                <x-card-header class="shrink-0 p-0">Suppliers Products</x-card-header>
                <div class="flex-1 overflow-auto min-h-0">
                </div>
            </x-card>
        </div>
    </section>
@endsection

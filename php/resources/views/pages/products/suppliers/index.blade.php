@extends('layouts.app')
@php
$thead = [
    'name' => 'Name',
    'contact_person' => 'Contact Person',
    'email' => 'Email',
    'phone' => 'Phone',
    'is_active' => 'Active',
];
@endphp

@section('content')
    <article>
        <div class="flex flex-row justify-between mb-4">
            <h1 class="text-3xl font-bold">Suppliers</h1>
            <x-button variant="success" data-modal-open>Add</x-button>
        </div>
        <x-table :thead="$thead" :tbody="$suppliers" title="Product Supplier List" titleClass="text-lg font-semibold text-gray-800">
            <x-slot:rightPocket>
                <form method="POST" class="relative w-full lg:w-auto">
                    @csrf
                    <x-input
                        name="search"
                        type="search"
                        id="search"
                        placeholder="Search . . ."
                    >
                        <x-slot:icon>
                            <x-search-icon />
                        </x-slot:icon>
                    </x-input>
                </form>
            </x-slot:rightPocket>
            <x-slot:dataActions class="flex items-center justify-center" dataActionsClassHeader="flex items-center justify-center">
                <x-nav-menu-icon />
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection
@section('footer')
    <x-modal header="Add Supplier">
        <x-supplier-form />
    </x-modal>
@endsection

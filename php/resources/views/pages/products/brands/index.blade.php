@extends('layouts.app')
@php
$thead = [
    'name' => 'Name',
    'logo' => 'Logo',
    'description' => 'Description',
    'is_active' => 'Active',
];
    $customRenders = [
        'price' => function($data, $value) {
            return '<span class="font-semibold text-green-600">$' . number_format($value, 2) . '</span>';
        },
        'quantity' => function($data, $value) {
            $badge = $value > 50 ? 'badge-success' : 'badge-warning';
            return '<span class="badge ' . $badge . '">' . $value . '</span>';
        },
        'is_active' => function($data, $value) {
            $status = $value ? '✓ Active' : '✗ Inactive';
            $color = $value ? 'text-green-600' : 'text-red-600';
            return '<span class="' . $color . '">' . $status . '</span>';
        },
    ];
@endphp

@section('content')
    <article>
        <div class="flex flex-row justify-between mb-4">
            <h1 class="text-3xl font-bold">Brands</h1>
            <x-button variant="success" data-modal-open>Add</x-button>
        </div>
        <x-table :thead="$thead" :tbody="$brands" title="Product Brand List" titleClass="text-lg font-semibold text-gray-800">
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
    <x-modal header="Add Brand">
        <x-brand-form />
    </x-modal>
@endsection
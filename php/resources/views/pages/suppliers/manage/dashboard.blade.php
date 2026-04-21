@extends('pages.suppliers.manage.app')
@section('supplier_content')
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <x-card class="rounded-md leading-none border-l-6 border-l-green-800 bg-green-500 text-white">
            <h1 class="uppercase font-bold text-lg mb-0">20</h1>
            <span class="text-sm overflow-hidden whitespace-nowrap text-ellipsis">No. of Assigned Prices</span>
            <x-card-footer class="p-0 mt-1"><x-button href="" variant="transparent">Show Info</x-button></x-card-footer>
        </x-card>

        <!-- Inventory Value -->
        <x-card class="rounded-md leading-none border-l-6 border-l-blue-700 bg-blue-500 text-white">
            <h1 class="uppercase font-bold text-lg mb-0">20</h1>
            <span class="text-sm overflow-hidden whitespace-nowrap text-ellipsis">No. of assigned products</span>
            <x-card-footer class="p-0 mt-1">
                <x-button href="" variant="transparent">View Inventory</x-button>
            </x-card-footer>
        </x-card>
    </div>
@endsection
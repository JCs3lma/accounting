@extends('layouts.app')
@php
$thead = [
    'name' => [
        'header' => 'Name',
        'tdClass' => 'w-[30vw] max-w-[30vw] lg:w-[20vw] lg:max-w-[20vw]',
    ],
    'brand' => 'Brand',
    'category' => 'Category',
    'price' => 'Cost Price',
    'selling_price' => 'Selling Price',
    'is_active' => 'Active',
];
@endphp

@section('content')
    <article>
        <x-card class="mb-4">
            <form action="{{route('products.pricing.index')}}" class="relative w-full lg:w-auto" autocomplete="off">
                <h3 class="mb-2">Filters</h3>
                <div class="flex flex-col lg:flex-row gap-3">
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
                            id="search_brand_id"
                            name="brand_id"
                            label="Brand"
                            :showPlaceHolder="true"
                        >
                            <option>All</option>
                            @foreach($dropdowns['brands'] as $brand)
                                <option value="{{ $brand->id }}" {{ request()->get('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </x-select>
                        <x-select
                            id="search_category_id"
                            name="category_id"
                            label="Category"
                            :showPlaceHolder="true"
                        >
                            <option>All</option>
                            @foreach($dropdowns['categories'] as $category)
                                <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </x-select>
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
                        <x-button variant="default" href="{{ route('products.pricing.index') }}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                            <span>Clear</span>
                        </x-button>
                    </div>
                </div>
            </form>
        </x-card>
        <x-table
            :thead="$thead"
            :tbody="$prices"
            title="Prices"
            cardHeaderClass="flex flex-row py-3 px-4"
            titleClass="text-lg font-semibold text-gray-800"
            :booleanMessage="[0 => 'In Active', 1 => 'Active']"
            customNoDataMessage="No brands found. Please adjust your filters or change page."
        >
            <x-slot:rightPocket>
                <x-button id="addPrice" variant="success" data-modal-open class="rounded-md text-md">Add</x-button>
            </x-slot:rightPocket>
            <x-slot:dataActions class="relative w-20 mx-auto" dataActionsClassHeader="flex items-center justify-end w-20">
                <x-action-menu />
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection
@section('footer')
    <x-modal header="Set Product Price" headerClass="modalTitle">
        <div id="modalContent"></div>
    </x-modal>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.querySelector('#modal');
        const modalContent = document.querySelector('#modalContent');
        const modalTitle = modalElement.querySelector('.modalTitle');

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.actionButton');
            const addBtn = e.target.closest('#addPrice');
            const editBtn = e.target.closest('.editActionButton');
            const deleteBtn = e.target.closest('.deleteActionButton');
            const logoInput = document.getElementById('logo_path');
            const logoPreviewContainer = document.getElementById('logoPreviewContainer');
            const logoClearBtn = document.getElementById('logoClearBtn');
            const logoPreview = document.getElementById('logoPreview');

            // -- ADD Logic
            if (addBtn) {
                modalTitle.innerText = 'Add Pricing';
                modalContent.innerHTML = `
                   <x-pricing-form id="pricingForm" :dropdowns="$dropdowns" method="POST" autocomplete="off"/>
                `;

                const form = document.querySelector('#pricingForm');
                form.querySelector('[name="product_id"]').value = null;
                form.querySelector('[name="cost_price"]').value = null;
                form.querySelector('[name="selling_price"]').value = null;
                form.querySelector('[name="is_active"]').value = null;
                
                if(form.querySelector('input[name="_method"]')) {
                    form.querySelector('[name="_method"]').remove();
                }
                const baseUrl = "{{ route('products.pricing.store') }}"; // Blade generates base URL
                const params = new URLSearchParams(@json(request()->query())).toString(); // JS
                form.action = params ? `${baseUrl}?${params}` : baseUrl;
            }

            // --- EDIT Logic ---
            if (editBtn) {
                const rowData = JSON.parse(editBtn.closest('td').getAttribute('data-pass'));
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Edit Price: ' + rowData.name;
                modalContent.innerHTML = `
                   <x-pricing-form id="pricingForm" method="POST" :dropdowns="$dropdowns" autocomplete="off"/>
                `;
                const form = document.querySelector('#pricingForm');
                
                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const baseUrl = "{{ route('products.pricing.update', [':id']) }}"; // Blade generates base URL
                const params = new URLSearchParams(@json(request()->query())).toString(); // JS
                const urlTemplate = params ? `${baseUrl}?${params}` : baseUrl;
                form.action = urlTemplate.replace(':id', rowData.id);
                
                // 3. Inject Method Spoofing for PUT
                if(!form.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }

                // 4. Fill Form Fields
                form.querySelector('[name="name"]').value = rowData.name;
                form.querySelector('[name="description"]').value = rowData.description;
                form.querySelector('[id="is_active"]').checked = rowData.is_active;

                modalElement.classList.remove('hidden');
                modalElement.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            // --- DELETE Logic ---
            if (deleteBtn) {
                const rowData = JSON.parse(deleteBtn.closest('td').getAttribute('data-pass'));
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Delete Price: ' + rowData.name;
                modalContent.innerHTML = `
                   <x-delete-pricing-form id="pricingForm" method="POST"/>
                `;
                const form = document.querySelector('#pricingForm');

                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const baseUrl = "{{ route('products.pricing.destroy', [':id']) }}"; // Blade generates base URL
                const params = new URLSearchParams(@json(request()->query())).toString(); // JS
                const urlTemplate = params ? `${baseUrl}?${params}` : baseUrl;
                form.action = urlTemplate.replace(':id', rowData.id);

                modalElement.classList.remove('hidden');
                modalElement.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }
        });
    });
</script>
@endpush
@extends('layouts.app')
@php
$thead = [
    'logo_path' =>  [
        'header' => 'Logo',
        'tdClass' => 'w-[10vw] max-w-[10vw] lg:w-[5vw] lg:max-w-[5vw] overflow-hidden text-ellipsis',
        'cast' => 'img',
        'tdContentClass' => 'w-full h-16 object-cover rounded-md',
        'defaultAlt' => 'Brand Logo',
    ],
    'name' => [
        'header' => 'Name',
        'tdClass' => 'w-[30vw] max-w-[30vw] lg:w-[20vw] lg:max-w-[20vw]',
    ],
    'description' => [
        'header' => 'Description',
        'tdClass' => 'w-[50vw] max-w-[50vw] lg:w-[30vw] lg:max-w-[30vw] overflow-hidden text-ellipsis',
    ],
    'is_active' => [
        'header' => 'Active',
        'cast' => 'span',
        'tdContentClass' => 'px-2 py-1 rounded-full text-xs font-semibold h-full',
        'tdContentClassActive' => 'bg-green-100 text-green-800',
        'tdContentClassInactive' => 'bg-red-100 text-red-800',
    ],
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
        <x-card class="mb-4">
            <form action="{{route('products.brands.index')}}" class="relative w-full lg:w-auto" autocomplete="off">
                <h3 class="mb-2">Filters</h3>
                <div class="flex flex-col lg:flex-row gap-3">
                    <div class="flex gap-3 w-full">
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
                        <x-button variant="default" href="{{ route('products.brands.index') }}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                            <span>Clear</span>
                        </x-button>
                    </div>
                </div>
            </form>
        </x-card>
        <x-table
            :thead="$thead"
            :tbody="$brands"
            title="Brands"
            cardHeaderClass="flex flex-row py-3 px-4"
            titleClass="text-lg font-semibold text-gray-800"
            :booleanMessage="[0 => 'In Active', 1 => 'Active']"
            customNoDataMessage="No brands found. Please adjust your filters or change page."
        >
            <x-slot:rightPocket>
                <x-button id="addBrand" variant="success" data-modal-open class="rounded-md text-md">Add</x-button>
            </x-slot:rightPocket>
            <x-slot:dataActions class="relative w-20 mx-auto" dataActionsClassHeader="flex items-center justify-end w-20">
                <x-action-menu />
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection
@section('footer')
    <x-modal header="Add Brand" headerClass="modalTitle">
        <div id="modalContent"></div>
    </x-modal>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.querySelector('#modal');
        const modalContent = document.querySelector('#modalContent');
        const modalTitle = modalElement.querySelector('.modalTitle');

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.actionButton');
            const addBtn = e.target.closest('#addBrand');
            const editBtn = e.target.closest('.editActionButton');
            const deleteBtn = e.target.closest('.deleteActionButton');
            const logoInput = document.getElementById('logo_path');
            const logoPreviewContainer = document.getElementById('logoPreviewContainer');
            const logoClearBtn = document.getElementById('logoClearBtn');
            const logoPreview = document.getElementById('logoPreview');

            // -- ADD Logic
            if (addBtn) {
                modalTitle.innerText = 'Add Brand';
                modalContent.innerHTML = `
                   <x-brand-form id="brandForm" method="POST" autocomplete="off"/>
                `;

                const form = document.querySelector('#brandForm');
                form.querySelector('[name="name"]').value = null;
                form.querySelector('[name="logo_path"]').value = null;
                form.querySelector('[name="description"]').value = null;
                form.querySelector('[name="is_active"]').value = null;
                
                if(form.querySelector('input[name="_method"]')) {
                    form.querySelector('[name="_method"]').remove();
                }
                const baseUrl = "{{ route('products.brands.store') }}"; // Blade generates base URL
                const params = new URLSearchParams(@json(request()->query())).toString(); // JS
                form.action = params ? `${baseUrl}?${params}` : baseUrl;
            }

            // --- EDIT Logic ---
            if (editBtn) {
                const rowData = JSON.parse(editBtn.closest('td').getAttribute('data-pass'));
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Edit Brand: ' + rowData.name;
                modalContent.innerHTML = `
                   <x-brand-form id="brandForm" method="POST" autocomplete="off"/>
                `;
                const form = document.querySelector('#brandForm');
                
                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const urlTemplate = "{{ route('products.brands.update', [':id'] + request()->query()) }}";
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

                if (rowData.logo_path) {
                    const logoContainerEdit = document.getElementById('logoPreviewContainer');
                    const logoPreviewEdit = document.getElementById('logoPreview');
                    const logoClearBtnEdit = document.getElementById('logoClearBtn');
                    const logoInputEdit = document.getElementById('logo_path');
                    const logoPathRemove = document.getElementById('logo_path_remove');
                    logoPreviewEdit.src = rowData.logo_path;
                    logoContainerEdit.classList.remove('hidden');

                    logoClearBtnEdit.addEventListener('click', (e) => {
                        e.preventDefault(); // prevent form submission if inside form
                        logoInputEdit.value = ''; // clear file input
                        logoPreviewEdit.src = ''; // clear preview
                        logoPathRemove.value = 1;
                        logoContainerEdit.classList.add('hidden'); // hide preview container
                    });

                    logoInputEdit.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (!file) {
                            logoPreviewEdit.src = '';
                            logoContainerEdit.classList.add('hidden');
                            return;
                        }

                        // Only images
                        if (!file.type.startsWith('image/')) {
                            alert('Please select an image file.');
                            logoInputEdit.value = '';
                            logoPreviewEdit.src = '';
                            logoContainerEdit.classList.add('hidden');
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            logoPreviewEdit.src = event.target.result;
                            logoContainerEdit.classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    });
                }
            }

            // --- DELETE Logic ---
            if (deleteBtn) {
                const rowData = JSON.parse(deleteBtn.closest('td').getAttribute('data-pass'));
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Delete Brand: ' + rowData.name;
                modalContent.innerHTML = `
                   <x-delete-brand-form id="brandForm" method="POST"/>
                `;
                const form = document.querySelector('#brandForm');

                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const urlTemplate = "{{ route('products.brands.destroy', [':id'] + request()->query()) }}";
                form.action = urlTemplate.replace(':id', rowData.id);

                modalElement.classList.remove('hidden');
                modalElement.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            // --- LOGO PREVIEW Logic ---
            if (!logoInput || !logoPreviewContainer) return;
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) {
                    logoPreview.src = '';
                    logoPreviewContainer.classList.add('hidden');
                    return;
                }

                // Only images
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file.');
                    logoInput.value = '';
                    logoPreview.src = '';
                    logoPreviewContainer.classList.add('hidden');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    logoPreview.src = event.target.result;
                    logoPreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);

                // Clear file when close button is clicked
                logoClearBtn.addEventListener('click', (e) => {
                    e.preventDefault(); // prevent form submission if inside form
                    logoInput.value = ''; // clear file input
                    logoPreview.src = ''; // clear preview
                    logoPreviewContainer.classList.add('hidden'); // hide preview container
                });
            });
        });
    });
</script>
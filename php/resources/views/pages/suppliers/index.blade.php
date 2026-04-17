@extends('layouts.app')
@php
$thead = [
    'logo_path' =>  [
        'header' => 'Logo',
        'tdClass' => 'w-[10vw] max-w-[10vw] lg:w-[5vw] lg:max-w-[5vw] overflow-hidden text-ellipsis',
        'cast' => 'img',
        'tdContentClass' => 'w-full h-16 object-cover rounded-md',
        'defaultAlt' => 'Supplier Logo',
    ],
    'name' => 'Name',
    'contact_person' => 'Contact Person',
    'email' => 'Email',
    'phone' => 'Phone',
    'mobile' => 'Mobile',
    'address' => [
        'header' => 'Address',
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
@endphp

@section('content')
    <article>
        <x-filter-form 
            route="{{route('suppliers.index')}}"
        >
            <div class="flex flex-col lg:flex-row gap-3 w-full">
                <x-input
                    id="search_name"
                    name="name"
                    type="text"
                    label="Supplier Name"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('name') && request()->get('name') !== 'null' ? request()->get('name') : ''}}"
                />
                <x-input
                    id="search_contact_person"
                    name="contact_person"
                    type="text"
                    label="Contact Person"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('contact_person') && request()->get('contact_person') !== 'null' ? request()->get('contact_person') : ''}}"
                />
                <x-input
                    id="search_email"
                    name="email"
                    type="text"
                    label="Email"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('email') && request()->get('email') !== 'null' ? request()->get('email') : ''}}"
                />
                <x-input
                    id="search_phone"
                    name="phone"
                    type="text"
                    label="Phone"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('phone') && request()->get('phone') !== 'null' ? request()->get('phone') : ''}}"
                />
                <x-input
                    id="search_mobile"
                    name="mobile"
                    type="text"
                    label="Mobile"
                    placeholder=" "
                    :showPlaceHolder="true"
                    value="{{request()->get('mobile') && request()->get('mobile') !== 'null' ? request()->get('mobile') : ''}}"
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
                <x-button variant="default" href="{{ route('suppliers.index') }}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-filter-form>
        <x-table
            :thead="$thead"
            :tbody="$suppliers"
            title="Suppliers"
            cardHeaderClass="flex flex-row py-3 px-4"
            titleClass="text-lg font-semibold text-gray-800"
            :booleanMessage="[0 => 'In Active', 1 => 'Active']"
            customNoDataMessage="No suppliers found. Please adjust your filters or change page."
        >
            <x-slot:rightPocket>
                <x-button id="addSupplier" variant="success" data-modal-open class="rounded-md text-md">Add</x-button>
            </x-slot:rightPocket>
            <x-slot:dataActions class="relative w-20 mx-auto" dataActionsClassHeader="flex items-center justify-end w-20">
                <x-action-menu />
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection
@section('footer')
    <x-modal header="Add Supplier" headerClass="modalTitle">
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
            const addBtn = e.target.closest('#addSupplier');
            const editBtn = e.target.closest('.editActionButton');
            const deleteBtn = e.target.closest('.deleteActionButton');
            const logoInput = document.getElementById('logo_path');
            const logoPreviewContainer = document.getElementById('logoPreviewContainer');
            const logoClearBtn = document.getElementById('logoClearBtn');
            const logoPreview = document.getElementById('logoPreview');

            // -- ADD Logic
            if (addBtn) {
                modalTitle.innerText = 'Add Supplier';
                modalContent.innerHTML = `
                   <x-supplier-form id="supplierForm" method="POST" autocomplete="off"/>
                `;

                const form = document.querySelector('#supplierForm');
                form.querySelector('[name="logo_path"]').value = null;
                form.querySelector('[name="name"]').value = null;
                form.querySelector('[name="contact_person"]').value = null;
                form.querySelector('[name="email"]').value = null;
                form.querySelector('[name="phone"]').value = null;
                form.querySelector('[name="mobile"]').value = null;
                form.querySelector('[name="address"]').value = null;
                form.querySelector('[name="is_active"]').value = null;
                
                if(form.querySelector('input[name="_method"]')) {
                    form.querySelector('[name="_method"]').remove();
                }
                const baseUrl = "{{ route('suppliers.store') }}"; // Blade generates base URL
                const params = new URLSearchParams(@json(request()->query())).toString(); // JS
                form.action = params ? `${baseUrl}?${params}` : baseUrl;
            }

            // --- EDIT Logic ---
            if (editBtn) {
                const rowData = JSON.parse(editBtn.closest('td').getAttribute('data-pass'));
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Edit Supplier: ' + rowData.name;
                modalContent.innerHTML = `
                   <x-supplier-form id="supplierForm" method="POST" autocomplete="off"/>
                `;
                const form = document.querySelector('#supplierForm');
                
                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const baseUrl = "{{ route('suppliers.update', [':id']) }}"; // Blade generates base URL
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
                form.querySelector('[name="contact_person"]').value = rowData.contact_person;
                form.querySelector('[name="email"]').value = rowData.email;
                form.querySelector('[name="phone"]').value = rowData.phone;
                form.querySelector('[name="mobile"]').value = rowData.mobile;
                form.querySelector('[name="address"]').value = rowData.address;
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
                modalTitle.innerText = 'Delete Supplier: ' + rowData.name;
                modalContent.innerHTML = `
                   <x-delete-supplier-form id="supplierForm" method="POST"/>
                `;
                const form = document.querySelector('#supplierForm');

                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const baseUrl = "{{ route('suppliers.destroy', [':id']) }}"; // Blade generates base URL
                const params = new URLSearchParams(@json(request()->query())).toString(); // JS
                const urlTemplate = params ? `${baseUrl}?${params}` : baseUrl;
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
@endpush
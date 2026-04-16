@extends('pages.shops.manage.app')
@php
$thead = [
    'profile_path' =>  [
        'header' => 'Profile',
        'tdClass' => 'w-[10vw] max-w-[10vw] lg:w-[5vw] lg:max-w-[5vw] overflow-hidden text-ellipsis',
        'cast' => 'img',
        'tdContentClass' => 'w-full h-16 object-cover rounded-md',
        'defaultAlt' => 'Profile',
    ],
    'fullname' => 'Name',
    'email' => 'Email',
    'phone' => 'Phone',
    'address' => 'Address',
    'is_active' => [
        'header' => 'Active',
        'cast' => 'span',
        'tdContentClass' => 'px-2 py-1 rounded-full text-xs font-semibold h-full',
        'tdContentClassActive' => 'bg-green-100 text-green-800',
        'tdContentClassInactive' => 'bg-red-100 text-red-800',
    ],
];
@endphp
@section('shop_content')
    <article>
        <x-filter-form 
            route="{{route('shops.staffs.index', $shop->id)}}"
        >
            <x-input
                id="search_name"
                name="name"
                type="text"
                label="Name"
                placeholder=" "
                :showPlaceHolder="true"
                value="{{request()->get('name') && request()->get('name') !== 'null' ? request()->get('name') : ''}}"
            />
            <div class="flex gap-3 w-full">
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
                <x-button variant="default" href="{{ route('shops.staffs.index', $shop->id) }}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-filter-form>
        <x-table
            :thead="$thead"
            :tbody="$staffs"
            title="Staffs"
            cardHeaderClass="flex flex-row py-3 px-4"
            titleClass="text-lg font-semibold text-gray-800"
            :booleanMessage="[0 => 'In Active', 1 => 'Active']"
            customNoDataMessage="No staffs found. Please adjust your filters or change page."
        >
            <x-slot:rightPocket>
                <x-button id="addStaff" variant="success" data-modal-open class="rounded-md text-md">Add</x-button>
            </x-slot:rightPocket>
            <x-slot:dataActions class="relative w-20 mx-auto" dataActionsClassHeader="flex items-center justify-end w-20">
                <x-action-menu />
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection

@section('footer')
    <x-modal header="Add Staff" headerClass="modalTitle">
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
            const addBtn = e.target.closest('#addStaff');
            const editBtn = e.target.closest('.editActionButton');
            const deleteBtn = e.target.closest('.deleteActionButton');
            const logoInput = document.getElementById('profile_path');
            const logoPreviewContainer = document.getElementById('logoPreviewContainer');
            const logoClearBtn = document.getElementById('logoClearBtn');
            const logoPreview = document.getElementById('logoPreview');

            // -- ADD Logic
            if (addBtn) {
                modalTitle.innerText = 'Add Staff';
                modalContent.innerHTML = `
                   <x-staff-form id="staffForm" :shop="$shop" method="POST" autocomplete="off"/>
                `;

                const form = document.querySelector('#staffForm');
                form.querySelector('[name="first_name"]').value = '';
                form.querySelector('[name="middle_name"]').value = '';
                form.querySelector('[name="last_name"]').value = '';
                form.querySelector('[name="email"]').value = '';
                form.querySelector('[name="phone"]').value = '';
                form.querySelector('[name="mobile"]').value = '';
                form.querySelector('[name="address"]').value = '';
                form.querySelector('[id="is_active"]').checked = false;
                form.querySelector('[name="employment_status"]').selectedIndex = 0;
                form.querySelector('[name="hire_date"]').value = null;
                
                if(form.querySelector('input[name="_method"]')) {
                    form.querySelector('[name="_method"]').remove();
                }
                const baseUrl = "{{ route('shops.staffs.store', $shop->id) }}"; // Blade generates base URL
                const params = new URLSearchParams(@json(request()->query())).toString(); // JS
                form.action = params ? `${baseUrl}?${params}` : baseUrl;
            }

            // --- EDIT Logic ---
            if (editBtn) {
                const rowData = JSON.parse(editBtn.closest('td').getAttribute('data-pass'));
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Edit Staff: ' + rowData.fullname;
                modalContent.innerHTML = `
                   <x-staff-form id="staffForm" :shop="$shop" method="POST" autocomplete="off"/>
                `;
                const form = document.querySelector('#staffForm');
                
                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                
                const baseUrl = "{{ route('shops.staffs.update', [$shop->id, ':id']) }}"; // Blade generates base URL
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
                form.querySelector('[name="first_name"]').value = rowData.first_name;
                form.querySelector('[name="middle_name"]').value = rowData.middle_name;
                form.querySelector('[name="last_name"]').value = rowData.middle_name;
                form.querySelector('[name="email"]').value = rowData.email;
                form.querySelector('[name="phone"]').value = rowData.phone;
                form.querySelector('[name="mobile"]').value = rowData.mobile;
                form.querySelector('[name="address"]').value = rowData.address;
                form.querySelector('[id="is_active"]').checked = rowData.is_active;
                form.querySelector('[name="employment_status"]').value = rowData.shop.employment_status;
                form.querySelector('[name="hire_date"]').value = rowData.shop.hire_date;

                modalElement.classList.remove('hidden');
                modalElement.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                if (rowData.profile_path) {
                    const logoContainerEdit = document.getElementById('logoPreviewContainer');
                    const logoPreviewEdit = document.getElementById('logoPreview');
                    const logoClearBtnEdit = document.getElementById('logoClearBtn');
                    const logoInputEdit = document.getElementById('profile_path');
                    const logoPathRemove = document.getElementById('profile_path_remove');
                    logoPreviewEdit.src = rowData.profile_path;
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
                modalTitle.innerText = 'Delete Staff: ' + rowData.fullname;
                modalContent.innerHTML = `
                   <x-delete-staff-form id="staffForm" method="POST"/>
                `;
                const form = document.querySelector('#staffForm');

                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const baseUrl = "{{ route('shops.staffs.destroy', [$shop->id, ':id']) }}"; // Blade generates base URL
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
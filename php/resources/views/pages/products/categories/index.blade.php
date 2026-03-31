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
                        type="text"
                        label="Name"
                        placeholder=" "
                        :showPlaceHolder="true"
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
        <x-table
            :thead="$thead"
            :tbody="$categories"
            title="Categories"
            titleClass="text-lg font-semibold text-gray-800"
            :booleanMessage="[0 => 'In Active', 1 => 'Active']"
        >
            <x-slot:rightPocket>
                <x-button id="addCategory" variant="success" data-modal-open class="rounded-md text-md">Add</x-button>
            </x-slot:rightPocket>
            <x-slot:dataActions class="flex items-center justify-center relative w-20" dataActionsClassHeader="flex items-center justify-center w-20">
                <x-action-menu />
            </x-slot:dataActions>
        </x-table>
    </article>
@endsection
@section('footer')
    <x-modal header="Add Category" headerClass="modalTitle">
        <x-category-form id="categoryForm" action="{{route('products.categories.store')}}" method="POST"/>
    </x-modal>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.querySelector('#modal');
        const form = document.querySelector('#categoryForm');
        const modalTitle = modalElement.querySelector('.modalTitle');

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.actionButton');
            const addBtn = e.target.closest('#addCategory');
            const editBtn = e.target.closest('.editActionButton');
            const deleteBtn = e.target.closest('.deleteActionButton');


            // -- ADD Logic
            if (addBtn) {
                modalTitle.innerText = 'Add Category';
                form.querySelector('[name="name"]').value = null;
                form.querySelector('[name="description"]').value = null;
                form.querySelector('[name="is_active"]').value = null;
                
                if(form.querySelector('input[name="_method"]')) {
                    form.querySelector('[name="_method"]').remove();
                }
                form.action = "{{route('products.categories.store')}}";
            }

            // --- EDIT Logic ---
            if (editBtn) {
                const rowData = JSON.parse(editBtn.closest('td').getAttribute('data-pass'));
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Edit Category: ' + rowData.name;
                
                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const urlTemplate = "{{ route('products.categories.update', ':id') }}";
                form.action = urlTemplate.replace(':id', rowData.id);
                
                // 3. Inject Method Spoofing for PUT
                if(!form.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }

                console.log(['rowData', rowData])

                // 4. Fill Form Fields
                form.querySelector('[name="name"]').value = rowData.name;
                form.querySelector('[name="description"]').value = rowData.description;
                form.querySelector('[name="is_active"]').checked = rowData.is_active;

                modalElement.classList.remove('hidden');
                modalElement.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            // --- DELETE Logic ---
            if (deleteBtn) {
                const rowData = JSON.parse(deleteBtn.closest('td').getAttribute('data-pass'));
                if(confirm('Are you sure you want to delete ' + rowData.name + '?')) {
                    // You can submit a hidden form here or use fetch()
                    console.log('Deleting ID:', rowData.id);
                }
            }
        });
    });
</script>
@endpush
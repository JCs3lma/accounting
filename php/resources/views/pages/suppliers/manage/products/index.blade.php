@extends('pages.suppliers.manage.app')
@section('supplier_content')
    <section class="flex flex-col flex-1 overflow-hidden min-h-0">
        <x-filter-form 
            route="{{route('suppliers.product.index', $supplier->id)}}"
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
            </div>
            <div class="flex gap-3 w-full flex-1">
                <x-button variant="info" type="submit" class="rounded-md flex gap-2 items-center justify-center flex-1 lg:flex-initial">
                    <x-search-icon class="fill-white" />
                    <span>Search</span>
                </x-button>
                <x-button variant="default" href="{{ route('suppliers.product.index', $supplier->id) }}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-filter-form>
        <div class="flex-1 flex flex-col lg:flex-row gap-4 min-h-0">
            <x-card class="w-full lg:w-[20vw] order-1 lg:order-2 overflow-hidden min-h-0 flex flex-col">
                <form method="POST" action="{{route('suppliers.product.store', $supplier->id)}}" class="flex flex-col w-full flex-1 min-h-0">
                    @csrf
                    <x-card-header class="shrink-0 p-0">Add Products</x-card-header>
                    <x-input type="hidden" value="{{$supplier->id}}" name="supplier_id" />
                    <div class="flex-1 overflow-auto min-h-0 flex flex-col gap-1 mt-2">
                        @forelse($products as $product)
                            <x-input
                                type="checkbox"
                                id="product-{{$product->id}}"
                                name="product_ids[]"
                                label="{{$product->name}}"
                                value="{{$product->id}}"
                                inputContainerClass="text-xl"
                            />
                        @empty
                            <span>No Product Found</span>
                        @endforelse
                    </div>
                    <x-card-footer class="shrink-0 p-0">
                        <x-button variant="info-outline" type="submit" class="w-full my-2" :disabled="count($products) == 0">Submit</x-button>
                    </x-card-footer>
                </form>
            </x-card>
            <x-card class="flex flex-col w-full order-2 lg:order-1 overflow-hidden min-h-0">
                <x-card-header class="shrink-0 p-0">Suppliers Products</x-card-header>
                <div class="flex-1 overflow-auto min-h-0 grid grid-cols-2 lg:grid-cols-6 py-2 gap-4">
                    @forelse($supplierProducts as $product)
                        <x-product-card
                            :product="$product->product"
                            isShowTrash="true"
                            :idToDelete="$product->id"
                        />
                    @empty
                        <h1>No Record Found!</h1>
                    @endforelse
                </div>
            </x-card>
        </div>
    </section>
@endsection
@section('footer')
    <x-modal header="Set Product" headerClass="modalTitle">
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
            const deleteBtn = e.target.closest('.deleteActionButton');

            // --- DELETE Logic ---
            if (deleteBtn) {
                const name = deleteBtn.getAttribute('data-name');
                const id = deleteBtn.getAttribute('data-id');
                const rowData = {
                    id: id,
                    name: name
                };
                console.log(['rowData', rowData])
                
                // 1. Change Modal Header
                modalTitle.innerText = 'Remove Product: ' + rowData.name;
                modalContent.innerHTML = `
                   <x-delete-supplier-product-form id="supplierProductForm" method="POST"/>
                `;
                const form = document.querySelector('#supplierProductForm');

                // 2. Change Form Action to Update URL (Assuming standard Laravel resource)
                const baseUrl = "{{ route('suppliers.product.destroy', [$supplier->id, ':id']) }}"; // Blade generates base URL
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
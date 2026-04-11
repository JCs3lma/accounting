@props([
    'dropdowns' => (object)[],
])
<form {{$attributes->twMerge(['class' => 'my-2'])}} enctype="multipart/form-data">
    @csrf
    <!-- Logo Upload -->
    <x-logo-uploader />
    <x-input class="mb-2" id="name" name="name" type="text" placeholder="Product Name" label="Name" required />
    <!-- Description -->
    <x-textarea
        id="description"
        name="description"
        type="text"
        placeholder="Brand Description"
        label="Description"
        rows="4"
        cols="50"
        class="mb-2"
    />
    
    <x-select
        name="brand_id"
        label="Brand"
        :showPlaceHolder="true"
        class="mb-2"
    >
        <option>All</option>
        @foreach($dropdowns['brands'] as $brand)
            <option value="{{ $brand->id }}" {{ request()->get('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
        @endforeach
    </x-select>
    <x-select
        name="category_id"
        label="Category"
        :showPlaceHolder="true"
        class="mb-2"
    >
        <option>All</option>
        @foreach($dropdowns['categories'] as $category)
            <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </x-select>
    <x-select
        name="unit_id"
        label="Unit"
        :showPlaceHolder="true"
        class="mb-2"
    >
        <option>All</option>
        @foreach($dropdowns['units'] as $unit)
            <option value="{{ $unit->id }}" {{ request()->get('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
        @endforeach
    </x-select>
    <x-input
        name="serial_number"
        type="text"
        label="Serial Number"
        placeholder="Serial Number"
        class="mb-2"
        value="{{request()->get('serial_number') && request()->get('serial_number') !== 'null' ? request()->get('serial_number') : ''}}"
    />
    <x-input class="mb-2" id="barcode" name="barcode" type="text" placeholder="Barcode" label="Barcode" />
    <x-input class="mb-2" id="serial_number" name="serial_number" type="text" placeholder="Serial Number" label="Serial Number" />
    <x-input class="mb-2" id="sku" name="sku" type="text" placeholder="SKU" label="SKU" />
    <!-- Checkbox -->
    <x-input-isactive />
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success" type="submit">Save</x-button>
    </div>
</form>
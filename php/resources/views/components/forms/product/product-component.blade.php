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
    
    <div class="flex gap-2 mb-2">
        <x-select
            name="brand_id"
            label="Brand"
            :showPlaceHolder="true"
            class="mb-2"
        >
            <option value="" selected>Select Brand</option>
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
            <option value="" selected>Select Category</option>
            @foreach($dropdowns['categories'] as $category)
                <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </x-select>
    </div>
    <div class="flex gap-2 mb-2">
        <x-input
            name="unit"
            label="Unit"
            placeholder="Unit"
            type="number"
            :showPlaceHolder="true"
        />
        <x-select
            name="unit_id"
            label="Unit"
            :showPlaceHolder="true"
        >
            <option value="" selected>Select Unit</option>
            @foreach($dropdowns['units'] as $unit)
                <option value="{{ $unit->id }}" {{ request()->get('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
            @endforeach
        </x-select>
    </div>
    <x-input
        class="mb-2"
        name="barcode"
        type="text"
        placeholder="Barcode"
        label="Barcode"
        value="{{request()->get('barcode') && request()->get('barcode') !== 'null' ? request()->get('barcode') : ''}}"
    />
    <!-- Checkbox -->
    <x-input-isactive />
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success" type="submit">Save</x-button>
    </div>
</form>
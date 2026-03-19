<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    <x-input class="mb-2" id="name" name="name" type="text" placeholder="Product Name" label="Name" required />
    <x-input class="mb-2" id="brand" name="brand" type="text" placeholder="Brand" label="Brand" required />
    <x-input class="mb-2" id="category" name="category" type="text" placeholder="Category" label="Category" required />
    <x-input class="mb-2" id="unit" name="unit" type="text" placeholder="Unit" label="Unit" required />
    <x-input class="mb-2" id="price" name="price" type="number" step="0.01" placeholder="Price" label="Price" required />
    <x-input class="mb-2" id="quantity" name="quantity" type="number" placeholder="Quantity" label="Quantity" required />
    <x-textarea
        id="description"
        name="description"
        type="text"
        placeholder="Product Description"
        label="Description"
        rows="3"
        cols="50"
        class="mb-2"
    />
    <x-input
        type="checkbox"
        id="is_active"
        name="is_active"
        label="IsActive"
    />
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success">Save</x-button>
    </div>
</form>
@props([
    'dropdowns' => (object)[],
])
<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    @csrf
    <x-select
        name="product_id"
        label="Product"
        :showPlaceHolder="true"
        class="mb-2"
    >
        @foreach($dropdowns['products'] as $product)
            <option value="{{ $product->id }}" {{ request()->get('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
        @endforeach
    </x-select>
    <x-input
        class="mb-2"
        name="cost_price"
        type="text"
        placeholder="Cost Price"
        label="Cost Price"
        required
    />
    <x-input
        class="mb-2"
        name="selling_price"
        type="text"
        placeholder="Selling Price"
        label="Selling Price"
        required
    />
    <x-input-isactive/>
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success" type="submit">Save</x-button>
    </div>
</form>
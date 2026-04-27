<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    @csrf
    <x-input 
        id="quantity"
        name="quantity"
        label="Quantity"
        type="number"
        class="my-2"
        required
    />
    <x-input 
        id="total"
        name="total"
        label="total"
        type="number"
        class="my-2"
        readonly
    />
    <x-button variant="info-outline" type="submit" class="w-full mt-2">Modify Quantity</x-button>
</form>

<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    @csrf
    <x-multi-select label="Products" placeholder="Select Products" nodatamsg="Please select a supplier" />

    <div id="multiple-product-inputs" class="mt-2 flex flex-col gap-2">
    </div>
    <x-card-footer class="shrink-0 p-0 flex lg:flex-col gap-1 items-start mt-2">
        <span>SubTotal: <input name="subtotal" id="subtotal" value="0" readonly /></span>
        <span>Total: <input name="total" id="total" value="0" readonly /></span>
        <x-button variant="info-outline" type="submit" class="w-full mt-2">Add Items</x-button>
    </x-card-footer>
</form>

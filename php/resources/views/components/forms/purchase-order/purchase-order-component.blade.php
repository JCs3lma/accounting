@props([
    'shop' => null,
    'suppliers' => null
])
<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    @csrf
    @if(isset($shop))
        <x-input type="hidden" value="{{$shop->id}}" name="shop_ids[]" />
    @endif
    <x-input
        class="mb-2"
        id="order_date_form"
        name="order_date"
        type="date"
        placeholder="Order Date"
        label="Order Date"
        required
        :value="\Carbon\Carbon::now()->format('Y-m-d')"
    />
    <x-input
        class="mb-2"
        id="expected_date_form"
        name="expected_date"
        type="date"
        placeholder="Expected Date"
        label="Expected Date"
        required
        :value="\Carbon\Carbon::now()->format('Y-m-d')"
    />
    <x-select
        id="status_form"
        name="status"
        label="Status"
        :showPlaceHolder="true"
        class="mb-2"
    >
        <option disabled selected value="">Select Status</option>
        @foreach(config('const.purchase_order_status') as $status)
            <option value="{{ $status }}" {{ request()->get('status_form') == $status ? 'selected' : '' }}>{{ $status }}</option>
        @endforeach
    </x-select>
    <x-textarea
        id="notes_form"
        name="notes"
        label="Notes"
    ></x-textarea>
    <span>To edit list of items in this P.O. please select manage in the actions list</span>
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success">Save</x-button>
    </div>
</form>
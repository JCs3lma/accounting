<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    <x-input class="mb-2" id="name" name="name" type="text" placeholder="Supplier Name" label="Name" required />
    <x-input class="mb-2" id="contact_person" name="contact_person" type="text" placeholder="Contact Person" label="Contact Person" required />
    <x-input class="mb-2" id="email" name="email" type="email" placeholder="Email Address" label="Email" required />
    <x-input class="mb-2" id="phone" name="phone" type="text" placeholder="Phone Number" label="Phone" required />
    <x-textarea
        id="address"
        name="address"
        type="text"
        placeholder="Supplier Address"
        label="Address"
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
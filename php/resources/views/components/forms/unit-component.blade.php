<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    <x-input class="mb-2" id="name" name="name" type="text" placeholder="Unit Name" label="Name" required />
    <x-input class="mb-2" id="abbreviation" name="abbreviation" type="text" placeholder="Unit Abbreviation" label="Abbreviation" required />
    <x-textarea
        id="description"
        name="description"
        type="text"
        placeholder="Unit Description"
        label="Description"
        rows="4"
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
<form {{$attributes->twMerge(['class' => 'my-2'])}}>
    @csrf
    <x-input class="mb-2" id="name" name="name" type="text" placeholder="Unit Name" label="Name" required />
    <x-input class="mb-2" id="abbreviation" maxlength="5" name="abbreviation" type="text" placeholder="Unit Abbreviation" label="Abbreviation" required />
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
    <!-- Checkbox -->
    <input type="hidden" name="is_active" value="0">
    <x-input
        type="checkbox"
        id="is_active"
        name="is_active"
        label="IsActive"
        value="1"
    />
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success">Save</x-button>
    </div>
</form>
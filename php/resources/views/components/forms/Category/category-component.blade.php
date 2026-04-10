<form {{$attributes->twMerge(['class' => 'my-2 flex flex-col gap-2'])}}>
    @csrf
    <x-input
        id="name"
        name="name"
        type="text"
        placeholder=" "
        label="Name"
        showPlaceHolder="true"
        required
    />
    <x-textarea
        id="description"
        name="description"
        type="text"
        placeholder="Category Description"
        label="Description"
        rows="4"
        cols="50"
    />
    <x-input-isactive />
    <div class="flex justify-end gap-2">
        <x-button variant="default" type="button" data-modal-close>Cancel</x-button>
        <x-button variant="success" type="submit">Save</x-button>
    </div>
</form>
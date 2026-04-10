<form {{$attributes->twMerge(['class' => 'my-2'])}} enctype="multipart/form-data">
    @csrf
    <!-- Logo Upload -->
    <x-logo-uploader />

    <!-- Name -->
    <x-input class="mb-2" id="name" name="name" type="text" placeholder="Brand Name" label="Name" required />

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

    <!-- Checkbox -->
    <x-input-isactive />

    <!-- Buttons -->
    <div class="flex justify-end gap-2">
        <x-button type="button" variant="default" data-modal-close>Cancel</x-button>
        <x-button type="submit" variant="success">Save</x-button>
    </div>
</form>

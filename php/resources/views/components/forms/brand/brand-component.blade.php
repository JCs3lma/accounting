<form {{$attributes->twMerge(['class' => 'my-2'])}} enctype="multipart/form-data">
    @csrf
    <!-- Logo Upload -->
    <div class="mb-2">
        <x-input 
            id="logo_path" 
            name="logo_path" 
            type="file" 
            accept="image/*"
            label="Upload Logo"
        />
        <x-input 
            type="hidden" 
            id="logo_path_remove" 
            name="logo_path_remove"
            value="0"
        />
        <!-- Preview container -->
        <div id="logoPreviewContainer" class="hidden relative mt-2 w-32 h-32 mx-auto">
            <x-button
                variant="close"
                id="logoClearBtn"
                class="rounded-full w-4 h-4 bg-white p-0 cursor-pointer flex items-center justify-center absolute top-1 right-1"
            >
                <x-close-icon />
            </x-button>
            <img id="logoPreview" class="w-32 h-32 object-cover rounded-md" />
        </div>
    </div>

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
    <input type="hidden" name="is_active" value="0">
    <x-input
        type="checkbox"
        id="is_active"
        name="is_active"
        label="Active"
        value="1"
    />

    <!-- Buttons -->
    <div class="flex justify-end gap-2">
        <x-button type="button" variant="default" data-modal-close>Cancel</x-button>
        <x-button type="submit" variant="success">Save</x-button>
    </div>
</form>

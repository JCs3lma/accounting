@props([
    'label' => 'Upload Logo',
    'imageUploadNameAndID' => 'logo_path',
    'imageUploadNameAndIDHidden' => 'logo_path_remove'
])
<!-- Logo Upload -->
<div class="mb-2">
    <x-input 
        :id="$imageUploadNameAndID" 
        :name="$imageUploadNameAndID" 
        type="file" 
        accept="image/*"
        :label="$label"
    />
    <x-input 
        type="hidden" 
        :id="$imageUploadNameAndIDHidden" 
        :name="$imageUploadNameAndIDHidden"
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
<form {{$attributes->twMerge(['class' => 'my-2'])}} enctype="multipart/form-data">
    @csrf
    <!-- Logo Upload -->
    <x-logo-uploader />
    <x-input class="mb-2" id="shop_name" name="shop_name" type="text" placeholder="Shop Name" label="Shop Name" required />
    <x-input class="mb-2" id="contact_person" name="contact_person" type="text" placeholder="Contact Person" label="Contact Person" />
    <x-input class="mb-2" id="email" name="email" type="email" placeholder="Email Address" label="Email" />
    <x-input class="mb-2" id="phone" name="phone" type="tel" maxlength="20" placeholder="Phone Number" label="Phone" />
    <x-input class="mb-2" id="mobile" name="mobile" type="tel" maxlength="20" placeholder="Mobile Number" label="Mobile" />
    <x-input class="mb-2" id="address" name="address" type="text" placeholder="Shop Address" label="Address" />
    <x-input-isactive/>
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success">Save</x-button>
    </div>
</form>
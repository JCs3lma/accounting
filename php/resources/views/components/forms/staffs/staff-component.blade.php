@props([
    'shop' => null
])
<form {{$attributes->twMerge(['class' => 'my-2'])}} enctype="multipart/form-data">
    @csrf
    @if(isset($shop))
        <x-input type="hidden" value="{{$shop->id}}" name="shop_ids[]" />
    @endif
    <h1>TODO:: Add option for existing staff</h1>
    <!-- Logo Upload -->
    <x-logo-uploader label="Upload Photo" imageUploadNameAndID="profile_path" imageUploadNameAndIDHidden="profile_path_remove" />
    <x-input class="mb-2" id="first_name" name="first_name" type="text" placeholder="First Name" label="First Name" required />
    <x-input class="mb-2" id="middle_name" name="middle_name" type="text" placeholder="Middle Name" label="Middle Name"/>
    <x-input class="mb-2" id="last_name" name="last_name" type="text" placeholder="Last Name" label="Last Name" required />
    <x-input class="mb-2" id="email" name="email" type="email" placeholder="Email Address" label="Email" />
    <x-input class="mb-2" id="phone" name="phone" type="tel" maxlength="20" placeholder="Phone Number" label="Phone" />
    <x-input class="mb-2" id="mobile" name="mobile" type="tel" maxlength="20" placeholder="Mobile Number" label="Mobile" />
    <x-input class="mb-2" id="address" name="address" type="text" placeholder="Shop Address" label="Address" />
    <x-select
        name="employment_status"
        label="Employment Status"
        :showPlaceHolder="true"
        class="mb-2"
    >
        @foreach(config('const.employment_status') as $status)
            <option value="{{ $status }}" {{ request()->get('employment_status') == $status ? 'selected' : '' }}>{{ $status }}</option>
        @endforeach
    </x-select>
    <x-input class="mb-2" id="hire_date" name="hire_date" type="date" placeholder="Date Hired" label="Date Hired" />
    <x-input-isactive/>
    <div class="flex justify-end gap-2">
        <x-button variant="default" data-modal-close>Cancel</x-button>
        <x-button variant="success">Save</x-button>
    </div>
</form>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

        });
    </script>
@endpush
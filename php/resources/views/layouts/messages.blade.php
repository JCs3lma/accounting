@if ($errors->any())
    <x-card id="errorCard" class="opacity-0 bg-red-500 py-2 px-3 mb-2 transition-all duration-500 ease-in-out absolute top-0 right-0 z-100000 -translate-y-10 -translate-x-[6%] sm:-translate-x-[14%] ">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-white">{{ $error }}</li>
            @endforeach
        </ul>
    </x-card>
@endif
@if (session()->has('success'))
    <x-card id="successCard" class="opacity-0 bg-green-500 py-2 px-3 mb-2 transition-all duration-500 ease-in-out absolute top-0 right-0 z-100000 -translate-y-10 -translate-x-[6%] sm:-translate-x-[14%]">
        <ul>
            <li class="text-white">{{ session()->get('success') }}</li>
        </ul>
    </x-card>
@endif
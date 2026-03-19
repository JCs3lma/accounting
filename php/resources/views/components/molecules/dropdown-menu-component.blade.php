@props([
    'dropdownIconClass' => ''
])
<div class="dropdown relative inline-block w-full">
    <button
        {{ $button->attributes->merge([
            'class' => 'dropdown-btn cursor-pointer py-2.5 px-3 flex text-sm font-bold rounded-lg hover:bg-gray-100 text-gray-800 w-full justify-between'
        ])->twMerge() }}
        data-button={{$button}}
    >
        @if(isset($icon))
            <div class="flex flex-row gap-2 items-center">
                <div {{$icon->attributes->merge(['class' => ''])->twMerge()}}>
                    {{ $icon }}
                </div>
                <span class="sm:block">{{ $button }}</span>
            </div>
        @else
            {{ $button }}
        @endif
        <x-arrow-down-icon class="{{implode(' ', [
            'dropdown-icon transform transition-transform duration-300 ease-in-out stroke-gray-500',
            $dropdownIconClass
        ])}}" />
    </button>

    <ul {{ $attributes->twMerge(['class' => 'dropdown-menu hidden relative left-0 mt-1 w-full bg-white rounded-lg z-50']) }}>
        {{ $slot }}
    </ul>
</div>
@push('js')
    <script>
        (function(){
            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('.dropdown-btn');

                buttons.forEach(btn => {
                    btn.onclick = function (e) {
                        e.stopPropagation();
                        // Find the closest container div.dropdown
                        const dropdown = btn.closest('.dropdown');
                        if (!dropdown) return;
                        // Find the menu inside this container
                        const menu = dropdown.querySelector('.dropdown-menu');
                        if (!menu) return;
                        // Find the icon inside this container
                        const icon = dropdown.querySelector('.dropdown-icon');
                        if (!icon) return;

                        // Toggle this menu
                        menu.classList.toggle('hidden');
                        icon.classList.toggle('rotate-[180deg]');
                    };
                });
            });
        })({});
    </script>
@endpush
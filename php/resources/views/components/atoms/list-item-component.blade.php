<li {{ $attributes->twMerge(['class' => 'pl-10']) }}>
    @if (isset($link))
        <a
            {{ $link->attributes->merge([
                'class' => 'w-full py-2.5 px-3 flex text-sm font-bold rounded-lg hover:bg-gray-100 text-gray-800 truncate block'
            ])->twMerge() }}
        >            
            @if(isset($icon))
                <div class="flex flex-row gap-2 items-center">
                    <div {{$icon->attributes->merge(['class' => ''])->twMerge()}}>
                        {{ $icon }}
                    </div>
                    <span class="block">{{ $link }}</span>
                </div>
            @else
                {{ $link }}
            @endif
        </a>
    @else
        {{ $slot }}
    @endif
</li>

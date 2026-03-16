<li {{ $attributes->twMerge(['class' => 'pl-5']) }}>
    @if (isset($link))
        <a
            {{ $link->attributes->merge([
                'class' => 'w-full py-2.5 px-3 flex text-sm font-bold rounded-lg hover:bg-gray-100 text-gray-800 truncate block'
            ])->twMerge() }}
        >
            {{ $link }}
        </a>
    @else
        {{ $slot }}
    @endif
</li>

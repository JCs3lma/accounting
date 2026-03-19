<span {{ $attributes->twMerge(['class' => 'mr-3 h-11 w-11 overflow-hidden rounded-full border-2 border-gray-200']) }}>
    <img src="{{ $attributes['src'] ?? asset('images/default-avatar.png') }}" alt="{{ $attributes['alt'] ?? 'User' }}" />
</span>
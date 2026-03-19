@props([
    'as' => 'label', // default tag
])

@if ($as === 'label')
    <label {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </label>
@elseif ($as === 'span')
    <span {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </span>
@elseif ($as === 'p')
    <p {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </p>
@elseif ($as === 'h1')
    <h1 {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </h1>
@elseif ($as === 'h2')
    <h2 {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </h2>
@elseif ($as === 'h3')
    <h3 {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </h3>
@elseif ($as === 'h4')
    <h4 {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </h4>
@elseif ($as === 'h5')
    <h4 {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </h4>
@elseif ($as === 'h5')
    <h5 {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </h5>
@elseif ($as === 'h6')
    <h6 {{ $attributes->twMerge(['class' => 'font-noto text-base']) }}>
        {{ $slot }}
    </h6>
@endif

@props([
    'inputContainerClass' => '',
    'label' => '',
    'showPlaceHolder' => false,
])
@php
    $inputAttributes = $label && !$showPlaceHolder
        ? $attributes->except('placeholder') 
        : $attributes;
@endphp
<div class="relative w-full {{$inputContainerClass}}">
    @if (isset($icon))
        <span {{$icon->attributes->merge(['class' => 'pointer-events-none absolute top-1/2 left-3 -translate-y-1/2'])->twMerge()}}>
            {{$icon}}
        </span>
    @endif
    <textarea {{$inputAttributes->twMerge(['class' => [
        'peer shadow-theme-xs w-full rounded-lg',
        'border border-gray-300 bg-transparent py-2.5',
        'text-sm text-gray-800 placeholder:text-gray-400',
        isset($icon) ? 'pl-[42px]' : 'pl-4',
        isset($rightIcon) ? 'pr-[42px]' : 'pr-4'
    ]])}}
    ></textarea>
    
    @if($label)
        <x-label :for="$attributes['name']" class="{{implode(' ', [
            isset($icon) ? 'ml-[42px]' : 'ml-4',
            'absolute left-0',
            'text-gray-500 text-sm bg-white',
            'transition-all duration-200 ease-in-out',

            // Focus State
            'peer-focus:top-0',
            'peer-focus:text-xs',
            'peer-focus:text-blue-600',
            'peer-focus:-translate-y-[50%]',

            // When Has Value (Placeholder is NOT shown)
            'peer-[:not(:placeholder-shown)]:top-0',
            'peer-[:not(:placeholder-shown)]:text-xs',
            'peer-[:not(:placeholder-shown)]:text-gray-500',
            'peer-[:not(:placeholder-shown)]:-translate-y-[50%]',

            // Default / Empty State (Placeholder IS shown)
            'peer-placeholder-shown:top-[50%]',
            'peer-placeholder-shown:text-sm',
            'peer-placeholder-shown:-translate-y-[50%]',
        ])}}">{{$label}}</x-label>
    @endif
    @if (isset($rightIcon))
        <span {{$rightIcon->attributes->merge(['class' => 'pointer-events-none absolute top-1/2 right-3 -translate-y-1/2'])->twMerge()}}>
            {{$rightIcon}}
        </span>
    @endif
</div>

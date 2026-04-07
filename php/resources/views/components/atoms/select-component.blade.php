@props([
    'selectContainerClass' => '',
    'label' => '',
    'showPlaceHolder' => false,
])
@php
    $selectAttributes = $label && !$showPlaceHolder
        ? $attributes->except('placeholder') 
        : $attributes;
    $selectClass = [
        'peer shadow-theme-xs h-[42px] w-full rounded-lg',
        'border border-gray-300 bg-transparent py-2.5',
        'text-sm text-gray-800 placeholder:text-gray-400',
        isset($icon) ? 'pl-[42px]' : 'pl-4',
        isset($rightIcon) ? 'pr-[42px]' : 'pr-4'
    ];
    $labelselectClass = [
        isset($icon) ? 'ml-[42px]' : 'ml-4',
        'absolute left-0 top-0 transform -translate-y-[35%] -translate-x-0',
        'text-blue-600 text-xs bg-white',
        'transition-all duration-200 ease-in-out',
    ];
    $class = $selectClass;
    $labelClass = $labelselectClass;
    $checkboxContainerClass = $selectAttributes['type'] == 'checkbox' ? 'flex flex-row items-center gap-1':'';
@endphp
<div class="relative w-full {{$selectContainerClass}} {{$checkboxContainerClass}}">
    @if (isset($icon))
        <span {{$icon->attributes->merge(['class' => 'pointer-events-none absolute top-1/2 left-3 -translate-y-1/2'])->twMerge()}}>
            {{$icon}}
        </span>
    @endif
    <select {{$selectAttributes->twMerge(['class' => $class])}}>
        {{$slot}}
    </select>
    
    @if($label)
        <x-label :for="$attributes['id']" class="{{implode(' ', $labelClass)}}">{{$label}}</x-label>
    @endif
    @if (isset($rightIcon))
        <span {{$rightIcon->attributes->merge(['class' => 'pointer-events-none absolute top-1/2 right-3 -translate-y-1/2'])->twMerge()}}>
            {{$rightIcon}}
        </span>
    @endif
</div>

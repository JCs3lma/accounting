@props([
    'variant' => 'default'
])

@php
    $class = 'text-xs border-1 px-1 rounded-xl';
    $text = 'default';
    switch ($variant) {
        case 'success':
            $class .= ' text-green-500 bg-green-100 border-green-300';
            $text = 'Success';
            break;
        case 'warning':
            $class .= ' text-yellow-500 bg-yellow-100 border-yellow-300';
            $text = 'Warning';
            break;
        case 'danger':
            $class .= ' text-red-500 bg-red-100 border-red-300';
            $text = 'Failed';
            break;
        case 'info':
            $class .= ' text-blue-500 bg-blue-100 border-blue-300';
            $text = 'Failed';
            break;
        default:
            $class .= ' border-gray-100';
            $text = 'Default';
            break;
    }
@endphp
<span {{$attributes->twMerge(['class' => $class])}}>
    @if (!$slot->isEmpty())
        {{$slot}}
    @else
        {{$text}}
    @endif
</span>
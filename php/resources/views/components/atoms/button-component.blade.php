@props([
    'variant' => 'default'
])

@php
    $class = '';
    switch ($variant) {
        case 'success':
            $class = 'text-white bg-green-500 hover:bg-green-600';
            break;
        case 'success-outline':
            $class = 'text-green-500 bg-green-100 border-green-300 hover:bg-green-200';
            break;
        case 'warning':
            $class = 'text-white bg-yellow-500 hover:bg-yellow-600';
            break;
        case 'warning-outline':
            $class = 'text-yellow-500 bg-yellow-100 border-yellow-300 hover:bg-yellow-200';
            break;
        case 'danger':
            $class = 'text-white bg-red-500 hover:bg-red-600';
            break;
        case 'danger-outline':
            $class = 'text-red-500 bg-red-100 border-red-300 hover:bg-red-200';
            break;
        case 'info':
            $class = 'text-white bg-blue-500 hover:bg-blue-600';
            break;
        case 'info-outline':
            $class = 'text-blue-500 bg-blue-100 border-blue-300 hover:bg-blue-200';
            break;
        case 'close':
            $class = 'bg-white border-0 hover:opacity-50';
            break;
        case 'plain':
            $class = 'bg-white border-0 p-0 w-full text-left';
            break;
        case 'transparent':
            $class = 'border-0 p-0 w-full text-center';
            break;
        default:
            $class = 'border-gray-400 text-gray-700 hover:bg-gray-200';
            break;
    }
@endphp
@if(!isset($attributes['href']))
    <button {{$attributes->twMerge(['class' => [
        'py-1 px-4 border-1 rounded-xl text-sm font-bold cursor-pointer',
        $class
    ]])}}>
        {{$slot}}
    </button>
@else
    <a {{$attributes->twMerge(['class' => [
        'py-1 px-4 border-1 rounded-xl text-sm font-bold cursor-pointer flex items-center justify-center',
        $class
    ]])}}>
        {{$slot}}
    </a>
@endif
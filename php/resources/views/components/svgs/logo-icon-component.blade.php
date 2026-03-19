@props([
    'isWithText' => true,
    'isBoth' => false,
    'iconClass' => '',
    'withTextClass' => '',
    'iconId' => '',
    'withTextId' => ''
])
@if ($isBoth)
    <img src="{{ asset('images/logo-with-text.png') }}" alt="Logo Text" class="{{ $withTextClass }}" id="{{ $withTextId }}"/>
    <img src="{{ asset('images/logo-icon.png') }}" alt="Logo Icon" class="{{ $iconClass }}" id="{{ $iconId }}"/>
@elseif($isWithText)
    <img src="{{ asset('images/logo-with-text.png') }}" alt="Logo Text" class="{{ $withTextClass }}" id="{{ $withTextId }}"/>
@else
    <img src="{{ asset('images/logo-icon.png') }}" alt="Logo Icon" class="{{ $iconClass }}" id="{{ $iconId }}"/>
@endif
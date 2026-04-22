@props([
    'closeId' => ''
])
<div class="flex flex-row gap-1 items-center bg-gray-300 h-[20px] p-1">
    <div class="removeTag p-1 bg-gray-600 rounded-full cursor-pointer" data-id="{{$closeId}}">
        <x-close-icon class="w-2 h-2 fill-white" />
    </div>
    <x-label class="text-xs">{{$slot}}</x-label>
</div>

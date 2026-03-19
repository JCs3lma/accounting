<div {{$attributes->twMerge(['class' => 'p-5 border-b border-gray-200 flex flex-col lg:flex-row items-center justify-between gap-2 w-full'])}} >
    @if(isset($leftPocket))
        {{$leftPocket}}
    @endif
    {{$slot}}
    @if(isset($rightPocket))
        {{$rightPocket}}
    @endif
</div>
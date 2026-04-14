@extends('layouts.app')

@section('content')
    <article>
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <img src="{{asset($shop->logo_path)}}" class="w-[3vw] max-w-[3vw] img-cover rounded-md" />
                <h1>{{$shop->shop_name}}</h1>
            </div>
            <x-button variant="plain" class="w-20 h-8" href="{{route('shops.index')}}">Back</x-button>
        </div>
        <div class="border-b border-gray-500 my-1 w-full h-[2px]">&nbsp;</div>
    </article>
@endsection

@extends('layouts.app')

@section('content')
    <article>
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <img src="{{asset($supplier->logo_path ?? 'images/default-avatar.png')}}" class="w-[3vw] max-w-[3vw] img-cover rounded-md" />
                <h1>{{$supplier->name}}</h1>
            </div>
            <x-button variant="plain" class="w-20 h-8" href="{{route('suppliers.index')}}">Back</x-button>
        </div>
        <div class="border-b border-gray-500 my-2 w-full h-[2px]">&nbsp;</div>
        @yield('supplier_content')
    </article>
@endsection

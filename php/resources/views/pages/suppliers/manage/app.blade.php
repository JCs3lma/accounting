@extends('layouts.app')

@section('content')
    <article class="flex flex-col flex-1 min-h-0">
        <div class="flex justify-between items-center">
            <div class="flex-1 flex gap-2 items-center">
                <img src="{{asset($supplier->logo_path ?? 'images/default-avatar.png')}}" class="w-[3vw] max-w-[3vw] img-cover rounded-md" />
                <h1>{{$supplier->name}}</h1>
            </div>
            <x-button variant="info-outline" class="w-40 h-8" href="{{route('suppliers.index')}}">Close Supplier</x-button>
        </div>
        <div class="border-b border-gray-500 my-2 w-full h-[2px]">&nbsp;</div>
        @yield('supplier_content')
    </article>
@endsection

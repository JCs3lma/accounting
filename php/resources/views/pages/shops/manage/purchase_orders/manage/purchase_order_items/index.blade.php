@extends('pages.shops.manage.app')

@section('shop_content')
    <article class="flex flex-col flex-1 overflow-hidden min-h-0">
        <x-filter-form 
            route="{{route('shops.staffs.index', $shop->id)}}"
            class="shrink-0"
        >
            <div class="flex flex-col lg:flex-row gap-3 w-full">
                <x-select
                    id="search_status"
                    name="status"
                    label="Status"
                    :showPlaceHolder="true"
                >
                    <option>All</option>
                    @foreach(config('const.purchase_order_status') as $status)
                        <option value="{{$status}}" {{ request()->get('status') === $status ? 'selected' : '' }}>{{$status}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex gap-3 w-full flex-1">
                <x-button variant="info" type="submit" class="rounded-md flex gap-2 items-center justify-center flex-1 lg:flex-initial">
                    <x-search-icon class="fill-white" />
                    <span>Search</span>
                </x-button>
                <x-button variant="default" href="{{route('shops.staffs.index', $shop->id)}}" class="rounded-md flex gap-2 items-center flex-1 lg:flex-initial">
                    <span>Clear</span>
                </x-button>
            </div>
        </x-filter-form>
    </article>
@endsection

@section('footer')
    <x-modal header="Edit Purchase Order" headerClass="modalTitle">
        <div id="modalContent"></div>
    </x-modal>
@endsection
@props([
    'title' => null,
    'titleClass' => '',
    'thead' => [],
    'tbody' => (object)[],
    'leftPocket' => null,
    'rightPocket' => null,
    'customNoDataMessage' => 'No Data Available!',
    'showPagination' => true,
    'actionHeader' => 'Actions',
    'booleanMessage' => [
        0 => 'False',
        1 => 'True'
    ]
])
@php
    $tableClass = !isset($title) ? 'p-5':'';
@endphp
<x-card class="{{isset($title) ? 'p-0':''}}">
    @if(isset($title))
        <x-card-header>
            @if(isset($leftPocket))
                <x-slot:leftPocket>
                    {{$leftPocket}}
                </x-slot:leftPocket>
            @endif
            <h1 class="{{$titleClass}}">{{$title}}</h1>
            @if(isset($rightPocket))
                <x-slot:rightPocket>
                    {{$rightPocket}}
                </x-slot:rightPocket>
            @endif
        </x-card-header>
    @endif
    <div class="max-w-full overflow-x-auto overflow-y-visible px-5 sm:px-6">
        <table
            {{ $attributes->twMerge(['class' => [
                'table-base w-full min-w-full',
                $tableClass
            ]]) }}
        >
            @if(isset($thead) && count($thead) > 0)
                <thead class="border-y border-gray-100 py-3 dark:border-gray-800">
                    <tr>
                        @foreach($thead as $head)
                            <th class="py-3 pr-5 font-normal whitespace-nowrap text-left text-theme-sm text-gray-500">{{$head}}</th>
                        @endforeach
                        @if(isset($dataActions))
                            <th class="py-3 pr-5 font-normal whitespace-nowrap text-left text-theme-sm text-gray-500 {{$dataActions->attributes['dataActionsClassHeader'] ?? ''}}">{{$actionHeader}}</th>
                        @endif
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-gray-100">
                @forelse($tbody as $data)
                    @php
                        $fields = $data->getAttributes();
                    @endphp
                    <tr>
                        @foreach($thead as $theadKey => $value)
                            <td class="py-3 pr-5 whitespace-nowrap">{{
                                isset($data->getCasts()[$theadKey]) &&
                                $data->getCasts()[$theadKey] == 'boolean'
                                ? $booleanMessage[$fields[$theadKey]] : $fields[$theadKey]}}
                            </td>
                        @endforeach
                        @if(isset($dataActions))
                            <td {{$dataActions->attributes->merge(['class' => 'py-3 pr-5 whitespace-nowrap', 'data-pass' => $data])->twMerge()}}>{{$dataActions}}</td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{max(isset($dataActions) ? count($thead) + 1 : count($thead) , 1)}}" class="py-3 pr-5 whitespace-nowrap text-center text-gray-500">
                            {{$customNoDataMessage}}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($tbody, 'links') && $showPagination)
        <x-card-footer class="w-full">
            {{ $tbody->links() }}
        </x-card-footer>
    @endif
</x-card>
@props([
    'title' => null,
    'titleClass' => '',
    'cardHeaderClass' => '',
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
    ],
    'tableContainerClass' => ''
])
@php
    $tableClass = !isset($title) ? 'p-5':'';
    // Convert the prop into an Attribute Bag if it isn't one already
    $tableContainerAttributes = new \Illuminate\View\ComponentAttributeBag([
        'class' => $tableContainerClass
    ]);
@endphp
<x-card class="{{isset($title) ? 'p-0':''}}">
    @if(isset($title))
        <x-card-header class="{{$cardHeaderClass}}">
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
    <div {{$tableContainerAttributes->merge(['class' => 'max-w-full px-5 sm:px-6 overflow-x-auto'])->twMerge()}}>
        <table
            {{ $attributes->twMerge(['class' => [
                'min-w-full border-collapse',
                $tableClass
            ]]) }}
        >
            @if(isset($thead) && count($thead) > 0)
                <thead class="w-full border-y border-gray-100 py-3 dark:border-gray-800">
                    <tr>
                        @foreach($thead as $head => $value)
                            @if(is_array($value))
                                <th class="py-3 pr-5 font-normal whitespace-nowrap text-left text-theme-sm text-gray-500 {{$value['thHeaderClass'] ?? ''}}">
                                    {{$value['header']}}
                                </th>
                            @else
                                <th class="py-3 pr-5 font-normal whitespace-nowrap text-left text-theme-sm text-gray-500 {{$value['thHeaderClass'] ?? ''}}">{{$value}}</th>
                            @endif
                        @endforeach
                        @if(isset($dataActions))
                            <th class="py-3 pr-5 font-normal whitespace-nowrap text-left text-theme-sm text-gray-500 {{$dataActions->attributes['dataActionsClassHeader'] ?? ''}}">{{$actionHeader}}</th>
                        @endif
                    </tr>
                </thead>
            @endif
            <tbody>
                @forelse($tbody as $data)
                    @php
                        $fields = $data;
                    @endphp
                    <tr class="hover:bg-gray-50 cursor-pointer">
                        @foreach($thead as $theadKey => $value)
                            <td class="py-3 pr-5 whitespace-nowrap text-ellipsis {{$value['tdClass'] ?? ''}}">
                                @if(is_array($value) && isset($value['cast']) && isset($data->getCasts()[$theadKey]))
                                    @php
                                        $tag = $value['cast'];
                                        $content = data_get($fields, $theadKey);
                                        $classCast = ($value['tdContentClass'] ?? '') . ' ' . (data_get($fields, $theadKey) ? ($value['tdContentClassActive'] ?? '') : ($value['tdContentClassInactive'] ?? ''));
                                        $currentCast = 'others';
                                        switch ($data->getCasts()[$theadKey]) {
                                            case 'boolean':
                                                $content = $booleanMessage[data_get($fields, $theadKey)];
                                                $currentCast = 'boolean';
                                                break;
                                            case 'App\Casts\BarcodeCast':
                                                $content = data_get($fields, $theadKey);
                                                $currentCast = 'barcode';
                                                break;
                                            case 'App\Casts\ImageCast':
                                                if (!data_get($fields, $theadKey)) {
                                                    $photo = asset($value['defaultImage'] ?? '/images/default-avatar.png');
                                                } else {
                                                    $photo = asset("storage/" . data_get($fields, $theadKey));
                                                }
                                                $content = [
                                                    'src' => $photo,
                                                    'alt' => $value['defaultAlt'] ?? ($data->name ?? 'Image')
                                                ];
                                                $currentCast = 'img';
                                                break;
                                        }
                                    @endphp
                                    @switch($currentCast)
                                        @case('boolean')
                                            <<?= $tag ?> class="{{$classCast}}">
                                                {{$content}}
                                            </<?= $tag ?>>
                                            @break
                                        @case('barcode')
                                            <<?= $tag ?> class="flex flex-col items-center justify-center gap-1 {{$classCast}}">
                                                {!! $content['img'] !!}
                                                {{$content['value']}}
                                            </<?= $tag ?>>
                                            @break
                                        @case('img')
                                            <<?= $tag ?> src="{{$content['src']}}" alt="{{$content['alt']}}" class="{{$classCast}}"></<?= $tag ?>>
                                            @break
                                        @default
                                            <<?= $tag ?> class="{{$classCast}}">
                                                {{$content}}
                                            </<?= $tag ?>>
                                    @endswitch
                                @else
                                    {{
                                        isset($data->getCasts()[$theadKey]) &&
                                        $data->getCasts()[$theadKey] == 'boolean'
                                        ? $booleanMessage[data_get($fields, $theadKey)] : data_get($fields, $theadKey)
                                    }}
                                @endif
                            </td>
                        @endforeach
                        @if(isset($dataActions))
                            <td {{$dataActions->attributes->merge(['class' => 'py-3 pr-5 whitespace-nowrap', 'data-pass' => json_encode($data)])->twMerge()}}>{{$dataActions}}</td>
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
    @if(method_exists($tbody, 'links') && $showPagination && $tbody->hasPages())
        <x-card-footer class="w-full">
            {{ $tbody->links() }}
        </x-card-footer>
    @endif
</x-card>
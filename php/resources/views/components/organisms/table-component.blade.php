@props([
    'title' => null,
    'titleClass' => '',
    'thead' => [],
    'tbody' => [],
])
@php
    $tableClass = !isset($title) ? 'p-5':'';
@endphp
<x-card class="{{isset($title) ? 'p-0':''}}">
    <div class="p-5 border-b border-gray-200">
        @if(isset($title))
            <h1 class="{{$titleClass}}">{{$title}}</h1>
        @endif
    </div>
    <div class="max-w-full overflow-x-auto overflow-y-visible px-5 sm:px-6 mb-5">
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
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="py-3 pr-5 whitespace-nowrap">Bought PYPL</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Nov 23, 01:00 PM</td>
                    <td class="py-3 pr-5 whitespace-nowrap">$2,567.88</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Finance</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Success</td>
                    <td class="py-3 pr-5 whitespace-nowrap"><x-nav-menu-icon /></td>
                </tr>
                <tr>
                    <td class="py-3 pr-5 whitespace-nowrap">Bought PYPL</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Nov 23, 01:00 PM</td>
                    <td class="py-3 pr-5 whitespace-nowrap">$2,567.88</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Finance</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Success</td>
                    <td class="py-3 pr-5 whitespace-nowrap"><x-nav-menu-icon /></td>
                </tr>
                <tr>
                    <td class="py-3 pr-5 whitespace-nowrap">Bought PYPL</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Nov 23, 01:00 PM</td>
                    <td class="py-3 pr-5 whitespace-nowrap">$2,567.88</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Finance</td>
                    <td class="py-3 pr-5 whitespace-nowrap">Success</td>
                    <td class="py-3 pr-5 whitespace-nowrap"><x-nav-menu-icon /></td>
                </tr>
            </tbody>
        </table>
    </div>
</x-card>
@props([
    'label' => '',
    'placeholder' => '',
    'selections' => [],
    'name' => '',
    'nodatamsg' => 'No Record Found'
])
<div 
    {{$attributes->merge([
        'class' => 'multi-select-container w-full relative mt-2',
    ])->twMerge()}}
>
    <x-label :for="$label" class="font-noto ml-4 absolute left-0 text-blue-600 text-xs bg-white -translate-y-[50%] z-5">{{$label}}</x-label>
    <div class="multi-select cursor-pointer peer shadow-theme-xs h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 text-sm text-gray-800 placeholder:text-gray-400 pl-4 pr-4 flex flex-row justify-between items-center relative">
        <div class="selected flex flex-row gap-2">{{$placeholder}}</div>
        <x-chevron-down-icon class="icon w-3 h-3 absolute right-1" />
    </div>
    <div class="multi-select-options hidden w-full absolute mt-1 z-9999 bg-white rounded-sm border border-gray-300 p-2 h-fit">
        @forelse($selections as $selection)
            <x-input type="checkbox" :name="$name" :label="$selection['name']" :id="'multi-select-'.$selection['id']" />
        @empty
            <span>{{$nodatamsg}}</span>
        @endforelse
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function renderSelected(multiSelectContainer) {
                const checkboxes = multiSelectContainer.querySelectorAll('input[type="checkbox"]');
                const selectedTags = multiSelectContainer.querySelector('.selected');

                const selected = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => ({
                        id: cb.id,
                        label: cb.nextElementSibling?.innerText || cb.value
                    }));

                if (selected.length > 0) {
                    let tags = '';
                    for (var x = 0; x < selected.length; x++) {
                        tags += `<x-selected-tag closeId="${selected[x].id}">
                                    ${selected[x].label}
                                </x-selected-tag>`;
                    }
                    selectedTags.innerHTML = tags;
                } else {
                    selectedTags.innerHTML = `{{$placeholder}}`;
                }
            }
            document.addEventListener('click', function (e) {
                const multiSelectContainer = e.target.closest('.multi-select-container');
                if (!multiSelectContainer) return;

                const options = multiSelectContainer.querySelector('.multi-select-options');
                const checkboxes = multiSelectContainer.querySelectorAll('input[type="checkbox"]');
                const selectedTags = multiSelectContainer.querySelector('.selected');

                if (e.target.closest('.removeTag')) {
                    e.stopPropagation(); // prevent dropdown toggle
                    
                    const removeBtn = e.target.closest('.removeTag');
                    const id = removeBtn.dataset.id;

                    const checkbox = document.getElementById(id);
                    if (checkbox) {
                        checkbox.checked = false;
                    }

                    renderSelected(multiSelectContainer);
                    return;
                }

                if (multiSelectContainer.contains(e.target)) {
                    options.classList.toggle('hidden');
                }

                renderSelected(multiSelectContainer);
            });
        });
    </script>
@endpush
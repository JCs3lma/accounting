@props([
    'route' => null
])
<x-card class="mb-4">
    <form action="{{$route}}" class="relative w-full lg:w-auto" autocomplete="off">
        <div class="flex flex-row items-center justify-between mb-0 lg:mb-2">
            <h3 class="relative">
                @if(!empty(request()->all()))
                    <div class="w-1 h-1 bg-red-500 rounded-full absolute top-[3px] -right-[8px]"></div>
                @endif
                Filters
            </h3>
            <x-button id="filterBtn" type="button" variant="plain" class="block lg:hidden w-fit cursor-pointer">
                <x-filter-icon class="w-4 h-4"/>
            </x-button>
        </div>
        <div
            id="filterContent"
            class="lg:flex flex-col lg:flex-row gap-3 max-h-0 opacity-0 pointer-events-none lg:pointer-events-auto transition-all duration-300 ease-in-out"
        >
            {{$slot}}
        </div>
    </form>
</x-card>
@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterBtn = document.getElementById('filterBtn');
    const filterContent = document.getElementById('filterContent');

    if (!filterBtn || !filterContent) return;

    const isMobile = () => window.matchMedia('(max-width: 1023px)').matches;

    filterBtn.addEventListener('click', function () {
        if (!isMobile()) return; // Only run on mobile 📱

        const isClosed = filterContent.classList.contains('max-h-0');

        if (isClosed) {
            filterContent.classList.remove('max-h-0', 'opacity-0', 'pointer-events-none');
            filterContent.classList.add('max-h-[500px]', 'opacity-100', 'flex', 'mt-2', 'pointer-events-auto');
        } else {
            filterContent.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
            filterContent.classList.remove('max-h-[500px]', 'opacity-100', 'flex', 'mt-2', 'pointer-events-auto');
        }
    });

    // Ensure desktop always open 💻
    const handleResize = () => {
        if (!isMobile()) {
            // Desktop — always open
            filterContent.classList.remove(
                'max-h-0',
                'opacity-0',
                'mt-2'
            );

            filterContent.classList.add(
                'flex',
                'opacity-100',
                'max-h-none'
            );
        } else {
            // Mobile — always start closed
            filterContent.classList.remove(
                'flex',
                'opacity-100',
                'max-h-none',
                'max-h-[500px]',
                'mt-2'
            );

            filterContent.classList.add(
                'max-h-0',
                'opacity-0'
            );
        }
    };

    window.addEventListener('resize', handleResize);
    handleResize();
});
</script>
@endpush
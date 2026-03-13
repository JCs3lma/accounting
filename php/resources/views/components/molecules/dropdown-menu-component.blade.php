<div class="dropdown relative inline-block w-full">
    <button
        {{ $button->attributes->merge([
            'class' => 'dropdown-btn cursor-pointer py-2.5 px-3 flex text-sm font-bold rounded-lg hover:bg-gray-100 text-gray-800 w-full justify-between'
        ])->twMerge() }}
    >
        {{ $button }}
        <x-arrow-down-icon class="stroke-gray-500" />
    </button>

    <ul {{ $attributes->twMerge(['class' => 'dropdown-menu hidden absolute left-0 mt-1 w-full bg-white rounded-lg shadow-lg z-50']) }}>
        {{ $slot }}
    </ul>
</div>
@push('js')<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all buttons after DOM is fully rendered
    const buttons = document.querySelectorAll('.dropdown-btn');

    buttons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation(); // prevent document click

            // Find the closest container div.dropdown
            const dropdown = btn.closest('.dropdown');
            if (!dropdown) return;

            // Find the menu inside this container
            const menu = dropdown.querySelector('.dropdown-menu');
            if (!menu) return;

            // Toggle this menu
            menu.classList.toggle('hidden');

            // Optional: close other menus
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });
        });
    });

    // Close all dropdowns when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.add('hidden'));
    });
});
</script>
@endpush
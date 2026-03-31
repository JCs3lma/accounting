<x-nav-menu-icon class="actionButton cursor-pointer" />
<x-card class="actionMenuCard absolute top-1/2 right-1/2 mt-2 z-50 hidden flex-col gap-1 justify-start items-start rounded-sm p-2 shadow-lg">
    <x-button class="editActionButton text-sm" variant="plain">Edit</x-button>
    <x-button class="deleteActionButton text-sm" variant="plain">Delete</x-button>
</x-card>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                // 1. Check if we clicked the action button icon
                const btn = e.target.closest('.actionButton');
                
                if (btn) {
                    // 2. Find the parent TD that contains the 'data-pass' attribute
                    const parentTd = btn.closest('td');
                    
                    // 3. Get and Parse the data
                    const rawData = parentTd.getAttribute('data-pass');
                    const rowData = JSON.parse(rawData);

                    // Example: Accessing a specific field
                    // alert('Editing: ' + rowData.name);

                    // 4. Toggle the menu visibility (Optional logic)
                    const menu = parentTd.querySelector('.actionMenuCard');
                    menu.classList.toggle('hidden');
                    menu.classList.toggle('flex');
                }
                
                // Close menu if clicking outside
                if (!e.target.closest('.actionButton') && !e.target.closest('.actionMenuCard')) {
                    document.querySelectorAll('.actionMenuCard').forEach(m => {
                        m.classList.add('hidden');
                        m.classList.remove('flex');
                    });
                }
            });
        });
    </script>
@endpush
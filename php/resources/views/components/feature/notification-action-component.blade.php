<!-- Notification Menu Area -->
<div class="relative">
    <button id="notification-action-btn" class="cursor-pointer hover:text-dark-900 relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700">
        <x-pulse-notif />
        <x-bell-icon />
    </button>

    <!-- Dropdown Start -->
    <x-card id="notification-action-card" class="hidden absolute -right-[240px] mt-[17px] max-h-[480px] w-[350px] flex-col sm:w-[361px] lg:right-0">
        <div class="mb-3 flex items-center justify-between border-b border-gray-100 pb-3">
            <h5 class="text-lg font-semibold text-gray-800">
                Notification
            </h5>

            <button class="text-gray-500 cursor-pointer" id="notification-action-close-btn">
                <x-close-icon />
            </button>
        </div>

        <ul class="custom-scrollbar flex h-auto flex-col overflow-y-auto">
            <li>
                <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100" href="#">
                    <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                        <x-avatar class="absolute" />
                    </span>

                    <span class="block">
                        <span class="text-theme-sm mb-1.5 block text-gray-500">
                            <span class="font-medium text-gray-800">Terry Franci</span>
                            requests permission to change
                            <span class="font-medium text-gray-800">Project - Nganter App</span>
                        </span>

                        <span class="text-theme-xs flex items-center gap-2 text-gray-500">
                            <span>Project</span>
                            <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                            <span>5 min ago</span>
                        </span>
                    </span>
                </a>
            </li>
        </ul>

        <a href="#" class="text-theme-sm shadow-theme-xs mt-3 flex justify-center rounded-lg border border-gray-300 bg-white p-3 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800">
            View All Notification
        </a>
    </x-card>
</div>

@push('js')
    <script>
        const notificationBtn = document.getElementById('notification-action-btn');
        const notificationCloseBtn = document.getElementById('notification-action-close-btn');
        const notificationCard = document.getElementById('notification-action-card');

        notificationBtn.addEventListener('click', () => {
            notificationCard.classList.toggle('hidden');
        });

        notificationCloseBtn.addEventListener('click', () => {
            notificationCard.classList.toggle('hidden');
        });

        // Optional: Close the dropdown when clicking outside of it
        document.addEventListener('click', (event) => {
            if (!notificationBtn.contains(event.target) && !notificationCloseBtn.contains(event.target) && !notificationCard.contains(event.target)) {
                notificationCard.classList.add('hidden');
            }
        });
    </script>
@endpush
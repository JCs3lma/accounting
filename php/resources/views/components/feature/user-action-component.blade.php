<div class="relative">
    <button class="cursor-pointer flex items-center text-gray-700" id="user-action-btn">
        <x-avatar src="https://img.freepik.com/premium-vector/character-avatar-isolated_729149-194801.jpg?semt=ais_rp_progressive&w=740&q=80"/>
        <span class="text-theme-sm mr-1 block font-medium"> Musharof </span>
        <x-arrow-down-icon class="stroke-gray-500" />
    </button>

    <x-card id="user-action-card" class="hidden absolute right-0 mt-[17px] w-[260px] flex-col">
        <div>
            <span class="text-theme-sm block font-medium text-gray-700">
                Musharof Chowdhury
            </span>
            <span class="text-theme-xs mt-0.5 block text-gray-500">
                randomuser@pimjo.com
            </span>
        </div>

        <ul class="flex flex-col gap-1 border-b border-gray-200 pt-4 pb-3">
            <li>
                <a
                    href="profile.html"
                    class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700"
                >
                    <x-profile-icon />
                    Edit profile
                </a>
            </li>
        </ul>
        <button class="group text-theme-sm mt-3 flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700">
            <x-sign-out-icon />
            Sign out
        </button>
    </x-card>
</div>

@push('js')
    <script>
        document.getElementById('user-action-btn').addEventListener('click', function() {
            const card = document.getElementById('user-action-card');
            card.classList.toggle('hidden');
        });

        // Optional: Close the dropdown when clicking outside of it
        document.addEventListener('click', function(event) {
            const card = document.getElementById('user-action-card');
            const button = document.getElementById('user-action-btn');

            if (!button.contains(event.target) && !card.contains(event.target)) {
                card.classList.add('hidden');
            }
        });

    </script>
@endpush
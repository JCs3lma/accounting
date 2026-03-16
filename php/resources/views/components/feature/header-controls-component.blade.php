<div class="z-99999 flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4">
    <button id="menuButton" class="cursor-pointer z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 lg:h-11 lg:w-11 lg:border">
        <x-hamburger-menu-icon id="hamburgerIcon" />
        <x-close-icon id="closeIcon" class="hidden" />
    </button>

    <a href="index.html" class="lg:hidden">
        <x-logo-icon isWithText={{false}} iconClass="w-12 h-auto"/>
    </a>

    <button id="mobileMenuButton" class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 lg:hidden">
        <x-nav-menu-icon />
    </button>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburgerBtn = document.getElementById('menuButton');
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenuList = document.getElementById('mobileMenuList');
            const sidebar = document.getElementById('sidebar');
            const hamburgerIcon = document.getElementById('hamburgerIcon');
            const closeIcon = document.getElementById('closeIcon');
            const sidebarIcon = document.getElementById('sidebarIcon');
            const sidebarWithText = document.getElementById('sidebarWithText');
            const navMenuText = document.getElementById('navMenuText');
            const navMenuIcon = document.getElementById('navMenuIcon');
            const textMenu = document.querySelectorAll('.textMenu span');
            const iconMenu = Array.from(document.getElementsByClassName('iconMenu'));
            const dropdownIconMenu = Array.from(document.getElementsByClassName('dropdownIconMenu'));

            if (!hamburgerBtn || !sidebar || !mobileMenuList || !mobileMenuButton) return;

            hamburgerBtn.addEventListener('click', (e) => {
                e.stopPropagation();

                const isClosed = sidebar.classList.contains('-translate-x-full');

                if (isClosed) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0', 'xl:w-[90px]');
                    sidebarIcon.classList.remove('hidden');
                    sidebarWithText.classList.add('hidden');
                    navMenuText.classList.add('hidden');
                    navMenuIcon.classList.remove('hidden');
                    textMenu.forEach(el => el.classList.add('hidden'));
                    dropdownIconMenu.forEach(el => el.classList.add('hidden'));
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0', 'xl:w-[90px]');
                    sidebarIcon.classList.add('hidden');
                    sidebarWithText.classList.remove('hidden');
                    navMenuText.classList.remove('hidden');
                    navMenuIcon.classList.add('hidden');
                    textMenu.forEach(el => el.classList.remove('hidden'));
                    dropdownIconMenu.forEach(el => el.classList.remove('hidden'));
                }

                hamburgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            mobileMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileMenuList.classList.toggle('hidden');
                mobileMenuList.classList.toggle('flex');
            });

            document.addEventListener('click', (event) => {

                // Only run on mobile (< lg breakpoint)
                if (window.innerWidth >= 1024) return;

                if (!sidebar.contains(event.target) && !hamburgerBtn.contains(event.target)) {

                    sidebar.classList.remove('translate-x-0', 'xl:w-[90px]');
                    sidebar.classList.add('-translate-x-full');

                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }

            });

        });
    </script>
@endpush
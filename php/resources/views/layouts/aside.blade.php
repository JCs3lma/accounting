<aside id="sidebar" class="sidebar fixed top-0 left-0 z-100000 flex h-screen w-[290px] flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 xl:static xl:translate-x-0 -translate-x-full">
    <div class="flex items-center gap-2 pt-8 pb-7">
        <a href="{{route('dashboard')}}" class="mx-auto">
            <x-logo-icon
                isBoth={{true}}
                iconClass="hidden w-12 h-auto"
                iconId="sidebarIcon"
                withTextClass="w-auto h-24"
                withTextId="sidebarWithText"
            />
        </a>
    </div>

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <nav>
            <div>
                <h3 class="mb-4 text-xs leading-[20px] text-gray-400 uppercase">
                    <span id="navMenuText">MENU</span>
                    <x-nav-menu-icon id="navMenuIcon" class="hidden mx-auto"/>
                </h3>
            </div>
            @if(request()->routeIs('shops.manage.*') || request()->routeIs('shops.show'))
                <x-shop-sidebar-menu />
            @else
                <x-sidebar-menu />
            @endif
        </nav>
    </div>
</aside>

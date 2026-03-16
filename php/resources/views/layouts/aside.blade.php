<aside id="sidebar" class="sidebar fixed top-0 left-0 z-100000 flex h-screen w-[290px] flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 xl:static xl:translate-x-0 dark:border-gray-800 dark:bg-black -translate-x-full">
    <div class="flex items-center gap-2 pt-8 pb-7">
        <a href="index.html" class="mx-auto">
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

            <ul class="flex flex-col gap-2">
                <li>
                    <x-dropdown-menu>
                        <x-slot:icon class="iconMenu"><x-product-icon /></x-slot:icon>
                        <x-slot:button class="textMenu">Products</x-slot:button>
                        <x-list-item><x-slot:link href="#">Category</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Brand</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Units</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Suppliers</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Product List</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Pricing</x-slot:link></x-list-item>
                    </x-dropdown-menu>
                </li>
                <li>
                    <x-dropdown-menu>
                        <x-slot:icon class="iconMenu"><x-shop-icon /></x-slot:icon>
                        <x-slot:button class="textMenu">Shops</x-slot:button>
                        <x-list-item><x-slot:link href="#">Shop List</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Aspiring shop</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Inventory</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Stock Transfer</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Stock Adjustment</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Stock Movement History</x-slot:link></x-list-item>
                    </x-dropdown-menu>
                </li>
                <li>
                    <x-dropdown-menu>
                        <x-slot:icon class="iconMenu"><x-sales-icon /></x-slot:icon>
                        <x-slot:button class="textMenu">Sales</x-slot:button>
                        <x-list-item><x-slot:link href="#">POS / New Sale</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Sales List</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Returns / Refunds</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Sales Reports</x-slot:link></x-list-item>
                    </x-dropdown-menu>
                </li>
                <li>
                    <x-dropdown-menu>
                        <x-slot:icon class="iconMenu"><x-purchasing-icon /></x-slot:icon>
                        <x-slot:button class="textMenu">Purchasing</x-slot:button>
                        <x-list-item><x-slot:link href="#">Purchase Orders</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Supplier List</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Receive Deliveries</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Purchase History</x-slot:link></x-list-item>
                    </x-dropdown-menu>
                </li>
                <li>
                    <x-dropdown-menu>
                        <x-slot:icon class="iconMenu"><x-accounting-icon /></x-slot:icon>
                        <x-slot:button class="textMenu">Accounting</x-slot:button>
                        <x-list-item><x-slot:link href="#">Transactions</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Expenses</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Income</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Chart of Accounts</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Financial Reports</x-slot:link></x-list-item>
                    </x-dropdown-menu>
                </li>
                <li>
                    <x-dropdown-menu>
                        <x-slot:icon class="iconMenu"><x-reports-icon /></x-slot:icon>
                        <x-slot:button class="textMenu">Reports</x-slot:button>
                        <x-list-item><x-slot:link href="#">Sales Reports</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Inventory Reports</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Purchase Reports</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Financial Reports</x-slot:link></x-list-item>
                    </x-dropdown-menu>
                </li>
                <li>
                    <x-dropdown-menu>
                        <x-slot:icon class="iconMenu"><x-user-setting-icon /></x-slot:icon>
                        <x-slot:button class="textMenu">User Management</x-slot:button>
                        <x-list-item><x-slot:link href="#">User List</x-slot:link></x-list-item>
                        <x-list-item><x-slot:link href="#">Activity Logs</x-slot:link></x-list-item>
                    </x-dropdown-menu>
                </li>
                <x-list-item class="pl-0">
                    <x-slot:icon class="iconMenu"><x-settings-icon /></x-slot:icon>
                    <x-slot:link href="#" class="textMenu">Settings</x-slot:link>
                </x-list-item>
            </ul>
        </nav>
    </div>
</aside>



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
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // SVG Components
        Blade::component('components.svgs.hamburger-menu-component', 'hamburger-menu-icon');
        Blade::component('components.svgs.nav-menu-component', 'nav-menu-icon');
        Blade::component('components.svgs.close-component', 'close-icon');
        Blade::component('components.svgs.bell-component', 'bell-icon');
        Blade::component('components.svgs.arrow-down-component', 'arrow-down-icon');
        Blade::component('components.svgs.sign-out-component', 'sign-out-icon');
        Blade::component('components.svgs.profile-component', 'profile-icon');
        Blade::component('components.svgs.logo-icon-component', 'logo-icon');
        Blade::component('components.svgs.product-component', 'product-icon');
        Blade::component('components.svgs.shop-component', 'shop-icon');
        Blade::component('components.svgs.accounting-component', 'accounting-icon');
        Blade::component('components.svgs.settings-component', 'settings-icon');
        Blade::component('components.svgs.sales-component', 'sales-icon');
        Blade::component('components.svgs.purchasing-component', 'purchasing-icon');
        Blade::component('components.svgs.reports-component', 'reports-icon');
        Blade::component('components.svgs.user-setting-component', 'user-setting-icon');
        Blade::component('components.svgs.search-component', 'search-icon');

        // Atom Components
        Blade::component('components.atoms.pulse-notif-component', 'pulse-notif');
        Blade::component('components.atoms.avatar-component', 'avatar');
        Blade::component('components.atoms.card-component', 'card');
        Blade::component('components.atoms.list-item-component', 'list-item');
        Blade::component('components.atoms.card-header-component', 'card-header');
        Blade::component('components.atoms.card-footer-component', 'card-footer');
        Blade::component('components.atoms.input-component', 'input');
        Blade::component('components.atoms.textarea-component', 'textarea');
        Blade::component('components.atoms.tags-component', 'tags');
        Blade::component('components.atoms.button-component', 'button');
        Blade::component('components.atoms.label-component', 'label');
        Blade::component('components.atoms.select-component', 'select');
        Blade::component('components.atoms.input-isactive', 'input-isactive');

        // Molecules
        Blade::component('components.molecules.dropdown-menu-component', 'dropdown-menu');
        Blade::component('components.molecules.logo-uploader', 'logo-uploader');

        // Organisms
        Blade::component('components.organisms.table-component', 'table');
        Blade::component('components.organisms.modal-component', 'modal');

        // Feature Components
        Blade::component('components.feature.user-action-component', 'user-action');
        Blade::component('components.feature.notification-action-component', 'notification-action');
        Blade::component('components.feature.header-controls-component', 'header-controls');
        Blade::component('components.feature.right-header-controls-component', 'right-header-controls');
        Blade::component('components.feature.sidebar-menu-component', 'sidebar-menu');
        Blade::component('components.feature.action-menu-component', 'action-menu');

        // Forms
        Blade::component('components.forms.category.category-component', 'category-form');
        Blade::component('components.forms.category.delete-category-component', 'delete-category-form');
        Blade::component('components.forms.unit.unit-component', 'unit-form');
        Blade::component('components.forms.unit.delete-unit-component', 'delete-unit-form');
        Blade::component('components.forms.brand.brand-component', 'brand-form');
        Blade::component('components.forms.brand.delete-brand-component', 'delete-brand-form');
        Blade::component('components.forms.supplier.supplier-component', 'supplier-form');
        Blade::component('components.forms.supplier.delete-supplier-component', 'delete-supplier-form');
        Blade::component('components.forms.product-component', 'product-form');
    }
}

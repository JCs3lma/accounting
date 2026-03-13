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

        // Atom Components
        Blade::component('components.atoms.pulse-notif-component', 'pulse-notif');
        Blade::component('components.atoms.avatar-component', 'avatar');
        Blade::component('components.atoms.card-component', 'card');
        Blade::component('components.atoms.dropdown-item-component', 'dropdown-item');

        // Molecules
        Blade::component('components.molecules.dropdown-menu-component', 'dropdown-menu');

        // Organisms
        Blade::component('components.organisms.dropdown-component', 'dropdown');

        // Feature Components
        Blade::component('components.feature.user-action-component', 'user-action');
        Blade::component('components.feature.notification-action-component', 'notification-action');
        Blade::component('components.feature.header-controls-component', 'header-controls');
    }
}

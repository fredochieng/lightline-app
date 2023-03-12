<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Traits\HasRoles;

class MenuServiceProvider extends ServiceProvider
{
    use HasRoles;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $verticalMenuJson = file_get_contents(base_path('resources/data/menu-data/verticalMenu.json'));
        $verticalMenuData = json_decode($verticalMenuJson);

        $horizontalMenuJson = file_get_contents(base_path('resources/data/menu-data/panelHorizontalMenu.json'));

        $horizontalMenuData = json_decode($horizontalMenuJson);

        // Share all menuData to all the views
        \View::share('menuData', [$verticalMenuData, $horizontalMenuData]);


        // if (!app()->runningInConsole()) {
        //     $user = Auth::user();
        //     if ($user) {
        //         // Do something if the user is logged in
        //         $verticalMenuJson = file_get_contents(base_path('resources/data/menu-data/verticalMenu.json'));
        //         $verticalMenuData = json_decode($verticalMenuJson);


        //         $user = Auth::user();

        //         $userRole = $user->getRoleNames()->first(); // Returns a collection

        //         if ($userRole == 'Panel') {
        //             $horizontalMenuJson = file_get_contents(base_path('resources/data/menu-data/panelHorizontalMenu.json'));
        //         } else if ($userRole == 'Admin') {
        //             $horizontalMenuJson = file_get_contents(base_path('resources/data/menu-data/adminHorizontalMenu.json'));
        //         }

        //         $horizontalMenuData = json_decode($horizontalMenuJson);

        //         // Share all menuData to all the views
        //         \View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
        //     } else {
        //         $verticalMenuJson = file_get_contents(base_path('resources/data/menu-data/verticalMenu.json'));
        //         $verticalMenuData = json_decode($verticalMenuJson);

        //         $horizontalMenuJson = file_get_contents(base_path('resources/data/menu-data/panelHorizontalMenu.json'));

        //         $horizontalMenuData = json_decode($horizontalMenuJson);

        //         // Share all menuData to all the views
        //         \View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
        //     }
        // }
    }
}

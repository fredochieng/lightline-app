<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\View;

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

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $user_id = $user->id;
                $role = DB::table('model_has_roles')->select(
                    DB::raw('role_id')
                )
                    ->where('model_id', $user_id)
                    ->first();
                $role_id = $role->role_id;

                if ($role_id == 1) {
                    $horizontalMenuJson = file_get_contents(base_path('resources/data/menu-data/panelHorizontalMenu.json'));
                } else if ($role_id == 2) {
                    $horizontalMenuJson = file_get_contents(base_path('resources/data/menu-data/adminHorizontalMenu.json'));
                }

                // get all data from menu.json file
                $verticalMenuJson = file_get_contents(base_path('resources/data/menu-data/verticalMenu.json'));
                $verticalMenuData = json_decode($verticalMenuJson);

                $horizontalMenuData = json_decode($horizontalMenuJson);


                // Share all menuData to all the views
                \View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
            }
        });
    }
}

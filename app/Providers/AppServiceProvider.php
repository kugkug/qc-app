<?php

namespace App\Providers;

use App\Helpers\GlobalHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {
        
    }

    public function boot(): void {
        
        $system_config = config('system');
        $dropdowns = dropDownHelper()->getAllDropDowns();
        $timelines = globalHelper()->getTimeLines();
        $requirement_types = globalHelper()->getRequirementTypes();
        
        view()->composer('*', function($view) use (
            $system_config,
            $dropdowns,
            $timelines,
            $requirement_types
        ) {
            $view->with([
                'app_name' => $system_config['app_name'],
                'app_title' => $system_config['app_title'],
                'app_favicon' => $system_config['app_favicon'],

                'global_dropdowns' => $dropdowns,
                'global_timelines' => $timelines,
                'global_requirement_types' => $requirement_types,
            ]);
        });
    }
}
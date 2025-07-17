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
        $business_timelines = globalHelper()->getBusinessTimeLines();
        $requirement_types = globalHelper()->getRequirementTypes();
        $business_requirement_types = globalHelper()->getBusinessRequirementTypes();
        $complaint_timelines = globalHelper()->getComplaintTimeLines();
        
        view()->composer('*', function($view) use (
            $system_config,
            $dropdowns,
            $timelines,
            $business_timelines,
            $requirement_types,
            $business_requirement_types,
            $complaint_timelines
        ) {
            $view->with([
                'app_name' => $system_config['app_name'],
                'app_title' => $system_config['app_title'],
                'app_favicon' => $system_config['app_favicon'],

                'global_dropdowns' => $dropdowns,
                'global_timelines' => $timelines,
                'global_business_timelines' => $business_timelines,
                'global_requirement_types' => $requirement_types,
                'global_business_requirement_types' => $business_requirement_types,
                'global_complaint_timelines' => $complaint_timelines,
            ]);
        });
}
}
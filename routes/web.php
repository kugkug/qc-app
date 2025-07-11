<?php

use App\Http\Controllers\Executor\ApplicantsController;
use App\Http\Controllers\Executor\DropdownsController;
use App\Http\Controllers\Executor\HealthController;
use App\Http\Controllers\Executor\SanitaryController;
use App\Http\Controllers\Web\HealthModulesController;
use App\Http\Controllers\Web\ReportModulesController;
use App\Http\Controllers\Web\SanitaryModulesController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get("/", [HealthModulesController::class, 'login'])->name('login');
Route::get("/register", [HealthModulesController::class, 'register'])->name('applicant_registration');
Route::get("/about-us", [HealthModulesController::class, 'about_us'])->name('about_us');
Route::get("/contact-us", [HealthModulesController::class, 'contact_us'])->name('contact_us');

Route::middleware([
    'auth', 
    'token_validator', 
    'prevent_back'
])->group(function() {
    Route::group(['prefix' => 'applicant'], function() {
        Route::get("/home", [HealthModulesController::class, 'home'])->name('home')->middleware('auth');
        Route::get("/health_certificate", [HealthModulesController::class, 'health_certificate'])->name('health_certificate');
        Route::get("/sanitary_permit", [SanitaryModulesController::class, 'sanitary_permit'])->name('sanitary_permit');   
        Route::get("/laboratory_follow_up", [HealthModulesController::class, 'laboratory_followup'])->name('laboratory_followup');
        Route::get("/analysis_follow_up", [HealthModulesController::class, 'water_analysis_followup'])->name('water_analysis_followup');


        Route::group(['prefix' => 'processing'], function() {
            Route::get("/application/{application_ref_no}", [HealthModulesController::class, 'processing_application'])->name('processing_application');
            Route::get("/upload-requirements/{application_ref_no}", [HealthModulesController::class, 'processing_upload_requirements'])->name('processing_upload_requirements');
            Route::get("/validate-requirements/{application_ref_no}", [HealthModulesController::class, 'processing_validate_requirements'])->name('processing_validate_requirements');
            Route::get("/payment-order/{application_ref_no}", [HealthModulesController::class, 'processing_payment_order'])->name('processing_payment_order');
            Route::get("/payment-validation/{application_ref_no}", [HealthModulesController::class, 'processing_payment_validation'])->name('processing_payment_validation');
            Route::get("/seminar-laboratories/{application_ref_no}", [HealthModulesController::class, 'processing_seminar_laboratories'])->name('processing_seminar_laboratories');
            Route::get("/head-approval/{application_ref_no}", [HealthModulesController::class, 'processing_head_approval'])->name('processing_head_approval');
            Route::get("/certificate-issuing/{application_ref_no}", [HealthModulesController::class, 'processing_certificate_issuing'])->name('processing_certificate_issuing');
        });
    });
});

Route::group(['prefix' => 'business'], function() {
    Route::group(['prefix' => 'processing'], function() {
        Route::get("/application/{application_ref_no}", [SanitaryModulesController::class, 'processing_application'])->name('processing_application');
        Route::get("/upload-requirements", [SanitaryModulesController::class, 'processing_upload_requirements'])->name('processing_upload_requirements');
        Route::get("/validate-requirements", [SanitaryModulesController::class, 'processing_validate_requirements'])->name('processing_validate_requirements');
        Route::get("/payment-order", [SanitaryModulesController::class, 'processing_payment_order'])->name('processing_payment_order');
        Route::get("/payment-validation", [SanitaryModulesController::class, 'processing_payment_validation'])->name('processing_payment_validation');
        Route::get("/seminar-laboratories", [SanitaryModulesController::class, 'processing_seminar_laboratories'])->name('processing_seminar_laboratories');
        Route::get("/head-approval", [SanitaryModulesController::class, 'processing_head_approval'])->name('processing_head_approval');
        Route::get("/certificate-issuing", [SanitaryModulesController::class, 'processing_certificate_issuing'])->name('processing_certificate_issuing');
    });
});

Route::group(['prefix' => 'reports'], function() {
    Route::get('/', [ReportModulesController::class, 'viewPdf']);
});

Route::group(['prefix' => 'executor'], function() {
    Route::post('/sub-industries-list/{industry_id}', [DropdownsController::class, 'getSubIndustries']);
    Route::post('/business-lines-list/{sub_industry_id}', [DropdownsController::class, 'getBusinessLines']);

    //Registration
    Route::group(['prefix' => 'applicant'], function() {
        Route::post('/login', [ApplicantsController::class, 'login'])->name('exec_login');
        Route::post('/register', [ApplicantsController::class, 'register'])->name('exec_register');
    });

    Route::group(['prefix' => 'applicant'], function() {
        Route::post('/logout', [ApplicantsController::class, 'logout'])->name('exec_logout') ;

        Route::post("/application", [HealthController::class, 'apply_health_certificate'])->name('exec_apply_health_certificate');
        Route::post("/application/{application_ref_no}", [HealthController::class, 'process_application'])->name('exec_process_application');
        Route::post("/upload-requirements/{application_ref_no}", [HealthController::class, 'upload_requirements'])->name('exec_upload_requirements');
        Route::post('/update-payment-order/{application_ref_no}', [HealthController::class, 'update_payment_order'])->name('update_payment_order');
        Route::post('/update-application/{application_ref_no}', [HealthController::class, 'update_application'])->name('update_application');

        Route::post('/submit-complaint', [ApplicantsController::class, 'submit_complaint'])->name('submit_complaint');
    });

    Route::group(['prefix' => 'business'], function() {
        Route::post("/application", [SanitaryController::class, 'apply_sanitary_permit'])->name('exec_apply_sanitary_permit');
        Route::post("/application/{application_ref_no}", [SanitaryController::class, 'process_application'])->name('exec_process_application');
        Route::post("/upload-requirements/{application_ref_no}", [SanitaryController::class, 'upload_requirements'])->name('exec_upload_requirements');
        Route::post('/update-payment-order/{application_ref_no}', [SanitaryController::class, 'update_payment_order'])->name('update_payment_order');
        Route::post('/update-application/{application_ref_no}', [SanitaryController::class, 'update_application'])->name('update_application');
    });
    
});
<?php

use App\Http\Controllers\Executor\ApplicantsController;
use App\Http\Controllers\Executor\ComplaintController;
use App\Http\Controllers\Executor\DropdownsController;
use App\Http\Controllers\Executor\HealthController;
use App\Http\Controllers\Executor\SanitaryController;
use App\Http\Controllers\Web\HealthModulesController;
use App\Http\Controllers\Web\ReportModulesController;
use App\Http\Controllers\Web\SanitaryModulesController;
use App\Http\Controllers\Web\ChatbotController;
use App\Http\Controllers\Web\ComplaintModulesController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get("/", [HealthModulesController::class, 'login'])->name('login');
Route::get("/register", [HealthModulesController::class, 'register'])->name('applicant_registration');
Route::get("/about-us", [HealthModulesController::class, 'about_us'])->name('about_us');
Route::get("/contact-us", [HealthModulesController::class, 'contact_us'])->name('contact_us');

Route::get('/verify-otp', [HealthModulesController::class, 'verifyOtp'])->name('verify_otp');

// Password Reset Routes
Route::get('/forgot-password', [HealthModulesController::class, 'forgotPassword'])->name('password.request');
Route::get('/reset-password/{token}', [HealthModulesController::class, 'resetPassword'])->name('password.reset');


// Chatbot routes
Route::get("/chatbot", [ChatbotController::class, 'index'])->name('chatbot');
Route::post("/chatbot/response", [ChatbotController::class, 'getResponse'])->name('chatbot.response');

Route::middleware([
    'auth', 
    'token_validator', 
    'prevent_back'
])->group(function() {
    Route::group(['prefix' => 'applicant'], function() {
        Route::get("/home", [HealthModulesController::class, 'home'])->name('home')->middleware('auth');
        Route::get("/health_certificate", [HealthModulesController::class, 'health_certificate'])->name('applicant_health_certificate');
        Route::get("/sanitary_permit", [SanitaryModulesController::class, 'sanitary_permit'])->name('applicant_sanitary_permit');   
        Route::get("/analysis_follow_up", [HealthModulesController::class, 'water_analysis_followup'])->name('water_analysis_followup');
        Route::get("/about-us", [HealthModulesController::class, 'auth_about_us'])->name('applicant_about_us');
        Route::get("/contact-us", [HealthModulesController::class, 'auth_contact_us'])->name('applicant_contact_us');

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
        Route::get("/application/{application_ref_no}", [SanitaryModulesController::class, 'processing_application'])->name('business_processing_application');
        Route::get("/upload-requirements/{application_ref_no}", [SanitaryModulesController::class, 'processing_upload_requirements'])->name('business_processing_upload_requirements');
        Route::get("/validate-requirements/{application_ref_no}", [SanitaryModulesController::class, 'processing_validate_requirements'])->name('business_processing_validate_requirements');
        Route::get("/payment-order/{application_ref_no}", [SanitaryModulesController::class, 'processing_payment_order'])->name('business_processing_payment_order');
        Route::get("/payment-validation/{application_ref_no}", [SanitaryModulesController::class, 'processing_payment_validation'])->name('business_processing_payment_validation');
        Route::get("/water-analysis/{application_ref_no}", [SanitaryModulesController::class, 'processing_water_analysis'])->name('business_processing_water_analysis');
        Route::get("/head-approval/{application_ref_no}", [SanitaryModulesController::class, 'processing_head_approval'])->name('business_processing_head_approval');
        Route::get("/certificate-issuing/{application_ref_no}", [SanitaryModulesController::class, 'processing_certificate_issuing'])->name('business_processing_certificate_issuing');
    });
});

Route::group(['prefix' => 'complaint'], function() {
    Route::get("/", [ComplaintModulesController::class, 'index'])->name('complaint');

    Route::group(['prefix' => 'processing'], function() {
        Route::get("/complaint/{complaint_ref_no}", [ComplaintModulesController::class, 'processing_complaint'])->name('processing_complaint');
        Route::get("/recommendation-first/{complaint_ref_no}", [ComplaintModulesController::class, 'processing_recommendation_first'])->name('processing_recommendation_first');
        Route::get("/recommendation-second/{complaint_ref_no}", [ComplaintModulesController::class, 'processing_recommendation_second'])->name('processing_recommendation_second');
        Route::get("/recommendation-third/{complaint_ref_no}", [ComplaintModulesController::class, 'processing_recommendation_third'])->name('processing_recommendation_third');
        Route::get("/head-approval/{complaint_ref_no}", [ComplaintModulesController::class, 'processing_head_approval'])->name('complaint_processing_head_approval');
        Route::get("/resolved/{complaint_ref_no}", [ComplaintModulesController::class, 'processing_resolved'])->name('processing_resolved');
    });
});

Route::group(['prefix' => 'reports'], function() {
    Route::get('/', [ReportModulesController::class, 'viewPdf']);
});

Route::group(['prefix' => 'executor'], function() {

    
    Route::post('/resend-otp', [ApplicantsController::class, 'resendOtp'])->name('exec_resend_otp');
    Route::post('/countdown', [ApplicantsController::class, 'countdown'])->name('exec_countdown');
    Route::post('/validate-otp', [ApplicantsController::class, 'validateOtp'])->name('exec_validate_otp');

    Route::post('/forgot-password', [ApplicantsController::class, 'forgotPassword'])->name('exec_forgot_password');
    Route::post('/reset-password', [ApplicantsController::class, 'resetPassword'])->name('exec_reset_password');

    Route::post('/cancel-application', [ApplicantsController::class, 'cancel_application'])->name('exec_cancel_application');
    Route::post('/cancel-business-application', [SanitaryController::class, 'cancel_business_application'])->name('exec_cancel_business_application');

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
        Route::post("/upload-requirements/{application_ref_no}", [HealthController::class, 'upload_requirements'])->name('exec_applicant_upload_requirements');
        Route::post('/update-payment-order/{application_ref_no}', [HealthController::class, 'update_payment_order'])->name('exec_applicant_update_payment_order');
        Route::post('/update-application/{application_ref_no}', [HealthController::class, 'update_application'])->name('exec_applicant_update_application');
    });

    Route::group(['prefix' => 'business'], function() {
        Route::post("/application", [SanitaryController::class, 'apply_sanitary_permit'])->name('exec_apply_sanitary_permit');
        Route::post("/application/{application_ref_no}", [SanitaryController::class, 'process_application'])->name('exec_business_process_application');
        Route::post("/upload-requirements/{application_ref_no}", [SanitaryController::class, 'upload_requirements'])->name('exec_busines_upload_requirements');
        Route::post('/update-payment-order/{application_ref_no}', [SanitaryController::class, 'update_payment_order'])->name('exec_busines_update_payment_order');
        Route::post('/update-application/{application_ref_no}', [SanitaryController::class, 'update_application'])->name('exec_busines_update_application');
        Route::post('/update-water-analysis/{application_ref_no}', [SanitaryController::class, 'update_water_analysis'])->name('exec_busines_update_water_analysis');
    });

    Route::group(['prefix' => 'complaint'], function() {
        Route::post('/submit', [ComplaintController::class, 'submit_complaint'])->name('exec_submit_complaint');
    });
    
});
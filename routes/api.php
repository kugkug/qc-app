<?php

use App\Http\Controllers\Api\Applicants;
use App\Http\Controllers\Api\ApplicantsController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\DropdownsController;
use App\Http\Controllers\Api\ComplaintController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'components'], function() {
    Route::get('sub-industries/{industry_id}', [DropdownsController::class, 'listSubIndustries'])->name('sub_industries_list');
    Route::get('business-lines/{sub_industry_id}', [DropdownsController::class, 'listBusinessLines'])->name('businesS_lines_list');
});

Route::group(['prefix' => 'applicant'], function() {
    Route::post('login', [ApplicantsController::class, 'login'])->name('api_login');
    Route::post('registration', [ApplicantsController::class, 'registration'])->name('registration');
    Route::post('forgot-password', [ApplicantsController::class, 'forgotPassword'])->name('api_forgot_password');
    Route::post('reset-password', [ApplicantsController::class, 'resetPassword'])->name('api_reset_password');
});

Route::post('send-otp-test', [ApplicantsController::class, 'send_otp_test'])->name('send_otp_test');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::group(['prefix' => 'applicant'], function() {
        Route::post('logout', [ApplicantsController::class, 'logout'])->name('logout');

        Route::post('apply-health-certificate', [ApplicantsController::class, 'applyHealthCertificate'])->name('health_certificate');
        Route::post('update-health-certificate-application/{application_ref_no}', [ApplicantsController::class, 'updateHealthCertificateaApplication'])->name('update_health_certificate');
        
        Route::post('process-application/{application_ref_no}', [ApplicantsController::class, 'processApplication'])->name('update_health_certificate_v2');
        Route::post('upload-requirements/{application_ref_no}', [ApplicantsController::class, 'uploadRequirements'])->name('upload_requirements');
        
        Route::post('update-requirements', [ApplicantsController::class, 'updateRequirements'])->name('update_requirements');
        Route::post('update-payment-order/{application_ref_no}', [ApplicantsController::class, 'updatePaymentOrder'])->name('update_payment_order');

        Route::post('update-application/{application_ref_no}', [ApplicantsController::class, 'updateApplication'])->name('update_application');

        Route::post('submit-complaint', [ApplicantsController::class, 'submitComplaint'])->name('submit_complaint');

    });

    Route::group(['prefix' => 'business'], function() {
        Route::post('apply-sanitary-permit', [BusinessController::class, 'applySanitaryPermit'])->name('sanitary_permit');
        Route::post('process-application/{application_ref_no}', [BusinessController::class, 'processApplication'])->name('process_application');
        Route::post('upload-requirements/{application_ref_no}', [BusinessController::class, 'uploadRequirements'])->name('busines_upload_requirements');
        Route::post('update-payment-order/{application_ref_no}', [BusinessController::class, 'updatePaymentOrder'])->name('busines_update_payment_order');
        Route::post('update-application/{application_ref_no}', [BusinessController::class, 'updateApplication'])->name('busines_update_application');
        Route::post('update-water-analysis/{application_ref_no}', [BusinessController::class, 'updateWaterAnalysis'])->name('busines_update_water_analysis');
    });

    Route::group(['prefix' => 'complaint'], function() {
        Route::post('submit', [ComplaintController::class, 'submitComplaint'])->name('api_submit_complaint');
    }); 

    
});
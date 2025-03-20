<?php

use App\Http\Controllers\Web\ApplicantModulesController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['v1'], function() {
    Route::get("/", [ApplicantModulesController::class, 'login'])->name('applicant_login');
    Route::get("/register", [ApplicantModulesController::class, 'register'])->name('applicant_registration');


    Route::group(['prefix' => 'applicant'], function() {
        Route::get("/home", [ApplicantModulesController::class, 'home'])->name('applicant_home');
        Route::get("/health_certificate", [ApplicantModulesController::class, 'health_certificate'])->name('applicant_health_certificate');
        Route::get("/sanitary_permit", [ApplicantModulesController::class, 'sanitary_permit'])->name('applicant_sanitary_permit');
        Route::get("/laboratory_follow_up", [ApplicantModulesController::class, 'laboratory_followup'])->name('applicant_laboratory_followup');
        Route::get("/analysis_follow_up", [ApplicantModulesController::class, 'water_analysis_followup'])->name('applicant_water_analysis_followup');


        Route::group(['prefix' => 'processing'], function() {
            Route::get("/application", [ApplicantModulesController::class, 'processing_application'])->name('applicant_processing_application');
            Route::get("/upload-requirements", [ApplicantModulesController::class, 'processing_upload_requirements'])->name('applicant_processing_upload_requirements');
        });
    });
    
// });
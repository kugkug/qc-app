<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SanitaryController extends Controller {

    public function apply_sanitary_permit(Request $request) {
        try {
            
            $response = apiHelper()->execute(
                $request->merge(['ApplicationType' => config('system.application_types')['Sanitary-Permit']]), 
                '/api/business/apply-sanitary-permit', 'POST'
            );


            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "_systemAlert('info', 'Congratulations, please click the button to continue.', 
                function() { location = '/business/processing/application/".$response['response']['application_ref_no']."'; });
                ";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function process_application(Request $request, $application_ref_no) {
        try {
            
            $response = apiHelper()->execute($request, "/api/business/process-application/$application_ref_no", 'POST');
            
            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->logHistory(
                $application_ref_no, 
                'Application Form'
            );
            
            $html_response = "location = '/business/processing/upload-requirements/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function upload_requirements(Request $request, $application_ref_no) {
        try {
            
            $response = apiHelper()->execute($request, "/api/business/upload-requirements/$application_ref_no", 'POST');

            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->logHistory(
                $application_ref_no, 
                'Upload Requirements'
            );

            globalHelper()->updateBusinessStatusViaRefNo(
                $application_ref_no, 
                config('system.application_status')['uploaded_requirements']
            );
            
            $html_response = "location = '/business/processing/validate-requirements/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function update_payment_order(Request $request, $application_ref_no) {
        try {
            
            $response = apiHelper()->execute($request, "/api/business/update-payment-order/$application_ref_no", 'POST');
            
            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->logHistory(
                $application_ref_no, 
                'Order of Payment'
            );

            globalHelper()->updateBusinessStatusViaRefNo(
                $application_ref_no, 
                config('system.application_status')['created_payment']
            );
            
            $html_response = "location = '/business/processing/payment-validation/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function update_application(Request $request, $application_ref_no) {
        try {
            $response = apiHelper()->execute(
                $request->merge(['ApplicationStatus' => config('system.application_status')['seminar']]),
                "/api/applicant/update-application/$application_ref_no", 
                'POST'
            );

            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            // globalHelper()->logHistory(
            //     $application_ref_no, 
            //     'HIV Seminar & Laboratories'
            // );
            
            $html_response = "location = '/applicant/processing/head-approval/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function update_water_analysis(Request $request, $application_ref_no) {
        try {
            
            $response = apiHelper()->execute($request, "/api/business/update-water-analysis/$application_ref_no", 'POST');
            
            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->updateBusinessStatusViaRefNo(
                $application_ref_no, 
                config('system.application_status')['water_analysis']
            );

            globalHelper()->logHistory(
                $application_ref_no, 
                'Water Analysis'
            );
            
            $html_response = "location = '/business/processing/head-approval/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function cancel_business_application(Request $request) {
        try {
            Business::where('application_ref_no', $request->application_ref_no)->delete();

            $html_response = "location ='/applicant/sanitary_permit';";

            return globalHelper()->ajaxSuccessResponse($html_response);
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }
}
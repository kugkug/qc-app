<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HealthController extends Controller {

    public function apply_health_certificate(Request $request) {
        try {
            $response = apiHelper()->execute(
            $request->merge(['ApplicationType' => config('system.application_types')['Health-Certificate']]), 
                '/api/applicant/apply-health-certificate', 'POST'
            );

            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "_systemAlert('info', 'Congratulations, please click the button to continue.', 
                function() { location = '/applicant/processing/application/".$response['response']['application_ref_no']."'; });
                ";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function process_application(Request $request, $application_ref_no) {
        try {
            $response = apiHelper()->execute($request, "/api/applicant/process-application/$application_ref_no", 'POST');
            
            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->logHistory(
                $application_ref_no, 
                'Application Form'
            );
            
            $html_response = "location = '/applicant/processing/upload-requirements/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function upload_requirements(Request $request, $application_ref_no) {
        try {
            
            $response = apiHelper()->execute($request, "/api/applicant/upload-requirements/$application_ref_no", 'POST');

            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            $status = $request->IsUpdateRequired == 1 ? 'Seminar & Laboratories' : 'Upload Requirements';
            globalHelper()->logHistory(
                $application_ref_no, 
                $status
            );

            $histories = globalHelper()->getHistory($application_ref_no);

            if ($histories) {
                $last_timeline = $histories[ array_key_last($histories) ];
            } else {
                $last_timeline = [];
            }

            $last_timeline_status = $last_timeline['timeline_look_up_id'];
            
            globalHelper()->updateBusinessStatusViaRefNo(
                $application_ref_no, 
                $last_timeline_status
            );
            
            $html_response = "location = '/applicant/processing/validate-requirements/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function update_payment_order(Request $request, $application_ref_no) {
        try {
            $response = apiHelper()->execute($request, "/api/applicant/update-payment-order/$application_ref_no", 'POST');

            if ($response['status'] == false) {
                return globalHelper()->ajaxErrorResponse('');
            }

            globalHelper()->logHistory(
                $application_ref_no, 
                'Order of Payment'
            );

            globalHelper()->updateApplicationStatusViaRefNo(
                $application_ref_no, 
                config('system.application_status')['created_payment']
            );
            
            $html_response = "location = '/applicant/processing/payment-validation/".$application_ref_no."';";

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

            globalHelper()->logHistory(
                $application_ref_no, 
                'HIV Seminar & Laboratories'
            );

            globalHelper()->updateApplicationStatusViaRefNo(
                $application_ref_no, 
                config('system.application_status')['seminar']
            );
            
            $html_response = "location = '/applicant/processing/head-approval/".$application_ref_no."';";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

}
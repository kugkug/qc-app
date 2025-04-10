<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApplicantsController extends Controller
{
    public function register(Request $request) {
        try {

            $response = apiHelper()->execute($request, '/api/applicant/registration', 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "_systemAlert('info', 'Successfully registered', function() { location = '/'; });";

            return globalHelper()->ajaxSuccessResponse($html_response);
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function login(Request $request) {
        
        try {
            $response = apiHelper()->execute($request, '/api/applicant/login', 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "location ='/applicant/home';";

            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function logout(Request $request) {
        
        try {
            $response = apiHelper()->execute($request, '/api/applicant/logout', 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "location ='/';";

            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }
}
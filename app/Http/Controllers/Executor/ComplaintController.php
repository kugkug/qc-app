<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComplaintController extends Controller
{
    public function submit_complaint(Request $request) {
        try {
            
            $response = apiHelper()->execute($request, '/api/complaint/submit', 'POST'); 
            
            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }

            $html_response = "location ='/complaint';";

            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }
}
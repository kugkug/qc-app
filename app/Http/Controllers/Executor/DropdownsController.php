<?php

declare(strict_types=1);
namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DropdownsController extends Controller {

    public function getSubIndustries(Request $request) {
        try {
            $response = apiHelper()->execute($request, "/api/components/sub-industries/$request->industry_id", 'GET');
            
            if (! $response['status']) {
                return globalHelper()->ajaxErrorResponse($response['response']);
            } else {
                
                $html_view = viewHelper()->updateDropDownValues($request->element_key, $response['response'], 'id', 'sub_industry');
                return globalHelper()->ajaxSuccessResponse($html_view);
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
        
    }

    public function getBusinessLines(Request $request) {
        try {
            $response = apiHelper()->execute($request, "/api/components/business-lines/$request->sub_industry_id", 'GET');
            
            if (! $response['status']) {
                return globalHelper()->ajaxErrorResponse($response['response']);
            } else {
                
                $html_view = viewHelper()->updateDropDownValues($request->element_key, $response['response'], 'id', 'business_line');
                return globalHelper()->ajaxSuccessResponse($html_view);
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
        
    }
}
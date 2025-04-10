<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DropdownsController extends Controller
{
    public function listSubIndustries($industry_id) {
        try {
            return [
                'status' => true,
                'response' => dropDownHelper()->getSubIndustriesViaIndustry((int) $industry_id),
            ];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return ['status' => false];
        }
    }

    public function listBusinessLines($sub_industry_id) {
        try {
            return [
                'status' => true,
                'response' => dropDownHelper()->getBusinessLinesViaSubIndustryId((int) $sub_industry_id),
            ];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return ['status' => false];
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Applications;

class BusinessController extends Controller
{
    public function applySanitaryPermit(Request $request) {
        DB::beginTransaction();
        try {

            $application_ref_no = globalHelper()->generateApplicationRefNo();
            $user_id = Auth::id();

            $validated = validatorHelper()->validate('application_save', $request->merge([
                'ApplicationRefNo' => $application_ref_no,
                'UserId' => $user_id,
            ]));

            if (! $validated['status']) {
                return $validated;
            }

            $application = Applications::create($validated['validated']);
            DB::commit();

            return [
                'status' => true,
                'response' => $application,
            ];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
        }
    }
}
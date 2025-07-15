<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Applications;
use App\Models\Business;
use App\Models\Complaint;
use App\Models\Payment;
use App\Models\Requirements;
use App\Models\User;
use App\Models\WaterAnalysis;
use Carbon\Carbon;

class BusinessController extends Controller
{
    public function applySanitaryPermit(Request $request) {
        DB::beginTransaction();
        try {
            $application_ref_no = globalHelper()->generateApplicationRefNo();
            $user_id = Auth::id();

            $validated = validatorHelper()->validate('business_save', $request->merge([
                'ApplicationRefNo' => $application_ref_no,
                'UserId' => $user_id,
                'ApplicationStatus' => config('system.application_status')['application_form'],
            ]));


            if (! $validated['status']) {
                return $validated;
            }

            $application = Business::create($validated['validated']);

            globalHelper()->logHistory(
                $application_ref_no, 
                'Application Form'
            );

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

    public function processApplication(Request $request, $application_ref_no) {
        
        DB::beginTransaction();
        try {

            $validated = validatorHelper()->validate('process_business', $request);

            if (! $validated['status']) {
                return $validated;
            }
            
            $business = Business::where('application_ref_no', $application_ref_no)->update($validated['validated']);
            
            if ($business) {
                DB::commit();
                return ['status' => true ];
            }
            
            DB::rollBack();
            Log::channel('info')->info("Invalid Reference No: " . $application_ref_no);
            return ['status' => false];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false, 'message' => $e->getMessage()];
            
        }
    }
    
    public function uploadRequirements(Request $request, $application_ref_no) {
        DB::beginTransaction();
        try {

            $image_files = [];
            
            $images = $request->file('Images');
            $requirements = $request->Requirements;
            $acquired_dates = $request->AcquiredDates;
            
            $n = 0;
            if ($images) {
                foreach($images as $image) {

                    $requirement = $requirements[$n];
                    $acquired_date = $acquired_dates[$n];
                    
                    $orig_file = str_replace("'", "", $image->getClientOriginalName());
                    $ext = $image->getClientOriginalExtension();
                    $filename = $application_ref_no."_".$requirement."_".str_replace(" ", "_", $orig_file);
                    $image->storeAs('', $filename, 'upload_document');

                    $requirement_data_keys = ['application_ref_no' => $application_ref_no, 'requirement' => $requirement];
                    $requirement_data_vals = [
                        'photo' => $filename, 
                        'status' => config('system.requirement_status')['new'],
                        'acquired_at' => Carbon::parse($acquired_date)->format("Y-m-d"),
                    ];
                    
                    Requirements::updateOrCreate($requirement_data_keys, $requirement_data_vals);

                    $n++;
                }
            }

            DB::commit();
            
            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function updateRequirements(Request $request) {
        return $request->all();
        DB::beginTransaction();
        try {
            $application_ref_no = $request->ApplicationRefNo;
            $requirements = $request->Requirements;

            foreach ($requirements as $requirement) {
                $requirement_id = $requirement['Requirement'];
            
                $requirement_data = [
                    'photo' => $requirement['Photo'],
                    'status' => config('system.requirement_status.new'),
                ];

                Requirements::where('application_ref_no', $application_ref_no)
                ->where('requirement', $requirement_id)
                ->update($requirement_data);
            }

            DB::commit();

            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];   
        }
    }

    public function updatePaymentOrder(Request $request, $ref_no) {
        
        DB::beginTransaction();
        try {
            $receipt = $request->file('RecieptPhoto'); 

            if ($receipt) {                
                $orig_file = str_replace("'", "", $receipt->getClientOriginalName());
                $filename = $ref_no."_".str_replace(" ", "_", $orig_file);
                $receipt->storeAs('', $filename, 'upload_payment');
            
                Payment::where('application_ref_no', $ref_no)->update([
                    'receipt_photo' => $filename,
                    'status' => config('system.payment_status')['for-review'],
                ]);
            }

            DB::commit();

            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function updateWaterAnalysis(Request $request, $ref_no) {
        
        DB::beginTransaction();
        try {
            $receipt = $request->file('WaterAnalysisResultPhoto'); 
            
            if ($receipt) {                
                $orig_file = str_replace("'", "", $receipt->getClientOriginalName());
                $filename = $ref_no."_".str_replace(" ", "_", $orig_file);
                $receipt->storeAs('', $filename, 'upload_water_analysis');
            
                WaterAnalysis::updateOrCreate(
                    ['application_ref_no' => $ref_no],
                    [
                        'water_analysis_result_photo' => $filename,
                        'status' => config('system.water_analysis_status')['for-review'],
                    ]
                );
            }

            DB::commit();

            return ['status' => true];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function submitComplaint(Request $request) {
        try {
            
            $complaint_photo = $request->file('ComplaintPhoto');

            if ($complaint_photo) {
                $orig_file = str_replace("'", "", $complaint_photo->getClientOriginalName());
                $filename = "complaint_photo_".str_replace(" ", "_", $orig_file);
                $complaint_photo->storeAs('', $filename, 'upload_complaint');
            }
            
            $user_id = Auth::id();

            $validated = validatorHelper()->validate('submit_complaint', $request->merge([
                'UserId' => $user_id,
            ]));

            if (! $validated['status']) {
                return $validated;
            }

            $validated['validated']['complaint_photo'] = $filename;
            
            $validated['validated']['sentiments'] = sentimentHelper()->getSentiment($validated['validated']['complaint_description']);

            $complaint = Complaint::create($validated['validated']);   


            return [
                'status' => true,
                'response' => $complaint,
            ];
            
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return ['status' => false];
        }
    }

}
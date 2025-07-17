<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ComplaintController extends Controller
{
    public function submitComplaint(Request $request) {
        try {
            
            $complaint_photo = $request->file('ComplaintPhoto');

            if ($complaint_photo) {
                $orig_file = str_replace("'", "", $complaint_photo->getClientOriginalName());
                $filename = "complaint_photo_".str_replace(" ", "_", $orig_file);
                $complaint_photo->storeAs('', $filename, 'upload_complaint');
            }
            $complaint_ref_no = globalHelper()->generateApplicationRefNo();
            $user_id = Auth::id();

            $validated = validatorHelper()->validate('submit_complaint', $request->merge([
                'UserId' => $user_id,
                'ComplaintRefNo' => $complaint_ref_no,
                'Status' => config('system.complaint_status.uploaded_requirements'),
            ]));

            if (! $validated['status']) {
                return $validated;
            }

            $validated['validated']['complaint_photo'] = $filename;
            $validated['validated']['sentiments'] = sentimentHelper()->getSentiment($validated['validated']['complaint_description']);

            $complaint = Complaint::create($validated['validated']);   

            globalHelper()->logComplaintHistory($complaint_ref_no, 'Application Form');
            globalHelper()->logComplaintHistory($complaint_ref_no, 'Upload Requirements');
            globalHelper()->logComplaintHistory($complaint_ref_no, 'Processing');


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
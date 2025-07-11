<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Complaint;
use App\Models\Payment;
use App\Models\Requirements;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicantsController extends Controller {
    public function registration(Request $request) {
        DB::beginTransaction();
        
        try {
            
            if($request->Password !== $request->ConfirmPassword) {
                return [
                    'status' => false,
                    'response' => 'Passwords did not match!'
                ];
            }

            $validated = validatorHelper()->validate('registration_new', $request);

            if (! $validated['status']) {
                return $validated;
            }
            
            $user = User::create($validated['validated']);
            
            DB::commit();
            
            return [
                'status' => true,
                'response' => $user,
            ];
            
        } catch(QueryException $qe) {
            
            Log::channel('info')->info("Exception : ".$qe->getMessage());
            $errorCode = $qe->errorInfo[1];
            if($errorCode == 1062){
                return [
                    'status' => false,
                    'response' => 'Email already in use!',
                ];
            }
            
            // throw new GlobalException();
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function login(Request $request) {

        try {

            $auth_data = $request->validate([
                'email' => 'required|string',
                'password' => 'required',
            ]);

            if (! Auth::attempt($auth_data)) {
                
                return [
                    'status' => false,
                    'response' => 'Invalid Username or Password',
                ];
                
            }
            $user = User::where('email', $auth_data['email'])->first();

            return response()->json([
                'status' => 'ok',
                'info' => [
                    'user_id' => Auth::id(),
                    'access_token' => $user->createToken('api_token')->plainTextToken,
                    'token_type' => 'Bearer'
                ],
            ]);
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function logout(Request $request) {

        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'response' => [],
            ]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));            
            return ['status' => false];
        }
    }

    public function applyHealthCertificate(Request $request) {
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
        
    public function updateHealthCertificateaApplication(Request $request, $application_ref_no) {
        DB::beginTransaction();
        try {
            $updated = [];
            $validated = validatorHelper()->validate('application_update', $request);

            if (! $validated['status']) {
                return $validated;
            }

            $application = Applications::where('application_ref_no', $application_ref_no)->first();
            if ($application) {
                $application->update($validated['validated']);
                $updated = $application->refresh();

                DB::commit();

                return [
                    'status' => true,
                    'response' => $updated,
                ];
            }
            
            Log::channel('info')->info("Invalid Reference No: " . $application_ref_no);
            return ['status' => false];
            
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function processApplication(Request $request, $application_ref_no) {
        DB::beginTransaction();
        try {

            $validated = validatorHelper()->validate('process_application', $request);

            if (! $validated['status']) {
                return $validated;
            }

            $user_id = Auth::id();
            
            $company_data = [
                'company_name' => $validated['validated']['company_name'],
                'company_address' => $validated['validated']['company_address']
            ];

            unset($validated['validated']['company_name']);
            unset($validated['validated']['company_address']);
            
            $application = Applications::where('application_ref_no', $application_ref_no)->first();
            
            if ($application) {
                $application->update($company_data);
                $user = User::where('id', $user_id)->update($validated['validated']);
                
                if ($user) {
                    DB::commit();
                    return ['status' => true ];
                }
            }
            
            DB::rollBack();
            
            Log::channel('info')->info("Invalid Reference No: " . $application_ref_no);
            return ['status' => false];
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }

    public function updateApplication(Request $request, $ref_no) {

        DB::beginTransaction();
        try {

            $updated = [];
            $validated = validatorHelper()->validate('application_update', $request);

            if (! $validated['status']) {
                return $validated;
            }

            $application = Applications::where('application_ref_no', $ref_no)->first();
            if ($application) {
                $application->update($validated['validated']);
                $updated = $application->refresh();

                DB::commit();

                return [
                    'status' => true,
                    'response' => $updated,
                ];
            }
            
            Log::channel('info')->info("Invalid Reference No: " . $ref_no);
            return ['status' => false];
            
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
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

    public function updatePaymentOrder($ref_no, Request $request) {
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
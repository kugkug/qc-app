<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Requirements;
use App\Models\User;
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

                    globalHelper()->logHistory($application['id'], 'Application Form');

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

    public function uploadRequirements(Request $request) {
        DB::beginTransaction();
        try {

            $application_ref_no = $request->ApplicationRefNo;
            $requirements = $request->Requirements;

            
            $requirement_data = array_map(function($requirement) use ($application_ref_no) {
                
                return [
                    'application_ref_no' => $application_ref_no,
                    'requirement' => $requirement['Requirement'],
                    'photo' => $requirement['Photo'],
                    'status' => config('system.requirement_status.new'),
                ];
            }, $requirements);

            if ($requirement_data) {
                $requirements_saved = Requirements::insert($requirement_data);
            }

            // globalHelper()->logHistory($application['id'], 'Upload Requirements');
            DB::commit();

            return [
                'status' => true,
                'response' => $requirements_saved,
            ];
            
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
                    'status' => config('system.requirement_status.updated'),
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
}
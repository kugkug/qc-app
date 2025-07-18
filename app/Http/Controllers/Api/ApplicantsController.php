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
use Illuminate\Support\Facades\Mail;

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
            $send_otp = globalHelper()->sendOtp($user->email);

            DB::commit();
            
            return [
                'status' => true,
                'response' => $user,
                'message' => 'Account registered successfully',
                'otp_details' => $send_otp,
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
            if($user->email_verified_at == null) {
                return [
                    'status' => false,
                    'response' => 'Account not verified',
                ];
            }

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

            globalHelper()->logHistory(
                $application_ref_no, 
                'Application Form'
            );

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


    public function send_otp_test(Request $request) {
        try {
            $response = globalHelper()->sendOtp($request->email);
            return $response;
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return ['status' => false];
        }
    }

    public function forgotPassword(Request $request) {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return [
                    'status' => false,
                    'response' => 'We can\'t find a user with that email address.',
                ];
            }

            $token = \Illuminate\Support\Str::random(64);
            
            \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => now(),
                ]
            );

            $resetUrl = config('app.url') . '/reset-password/' . $token;
            
            $emailDetails = globalHelper()->getEmailDetails('password_reset', [
                'firstname' => $user->firstname,
                'reset_url' => $resetUrl,
            ]);

            Mail::to($request->email)->send(new \App\Mail\QcHealthMailer($emailDetails));

            return [
                'status' => true,
                'response' => 'Password reset link sent to your email.',
            ];

        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'response' => 'Failed to send password reset email.',
            ];
        }
    }

    public function resetPassword(Request $request) {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            $passwordReset = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            if (!$passwordReset) {
                return [
                    'status' => false,
                    'response' => 'Invalid password reset token.',
                ];
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return [
                    'status' => false,
                    'response' => 'User not found.',
                ];
            }

            $user->update([
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            ]);

            \Illuminate\Support\Facades\DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            return [
                'status' => true,
                'response' => 'Password has been reset successfully.',
            ];

        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'response' => 'Failed to reset password.',
            ];
        }
    }
}
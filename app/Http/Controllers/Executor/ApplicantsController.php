<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Otp;
use App\Models\User;
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
            
            $html_response = "_systemAlert('info', 'Successfully registered', function() { ".$response['otp_details']['js']." });";

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


    public function cancel_application(Request $request) {
        try {
            Applications::where('application_ref_no', $request->application_ref_no)->delete();

            $html_response = "location ='/applicant/health_certificate';";

            return globalHelper()->ajaxSuccessResponse($html_response);
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }


    public function countdown(Request $request) {
        try {
            $token = request()->get('token');
            $otp = Otp::where('token', $token)->where('is_used', 0)->first();
            $expiry = date('Y-m-d H:i:s', strtotime($otp->expires_at)); 
            $now = date('Y-m-d H:i:s', strtotime(now()));
            $diff = strtotime($expiry) - strtotime($now);
            $minutes = floor($diff / 60);
            $seconds = $diff % 60;
            if ($minutes < 0 || $seconds < 0) {
                return response()->json(['status' => false, 'message' => '
                <a href="javascript:void(0)" class="text-primary" data-id="'.$otp->user_id.'" id="resend-otp">Resend OTP</a>']);
            }

            return response()->json(['status' => true, 'message' => $minutes . ':' . str_pad($seconds, 2, '0', STR_PAD_LEFT), 'expires_at' => $expiry]);
            
        } catch (\Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
    public function resendOtp(Request $request) {
        try { 
            
            $user = User::find($request->id)->toArray();
            $send_otp = globalHelper()->sendOtp($user['email']);
            

            return response()->json($send_otp);
        } catch (\Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse($e->getMessage(), '', 'System Error');
        }
    }

    public function validateOtp(Request $request) {
        try {
            $token = request()->get('token');
            $otp = Otp::where('token', $token)->where('is_used', 0)->first();

            if (!$otp) {
                return globalHelper()->ajaxErrorResponse('OTP expired', '', 'System Error');
            }

            Otp::where('token', $token)->update(['is_used' => 1]);
            User::where('id', $otp->user_id)->update(['email_verified_at' => now()]);

            return response()->json([
                'status' => true,
                'message' => 'OTP validated successfully',
                'token' => $token,
                'js' => 'window.location.href = "'.route('login').'";',
            ]);
            
        } catch (\Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return globalHelper()->ajaxErrorResponse($e->getMessage(), '', 'System Error');
        }
    }

    public function forgotPassword(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/applicant/forgot-password', 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "_systemAlert('success', 'Password reset link sent to your email', function() { location = '".route('login')."'; });";

            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function resetPassword(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/applicant/reset-password', 'POST');

            if ($response['status'] == false) {
                return isset($response['response']) ? 
                    globalHelper()->ajaxErrorResponse($response['response']) :
                    globalHelper()->ajaxErrorResponse('');
            }
            
            $html_response = "_systemAlert('success', 'Password has been reset successfully', function() { location = '".route('login')."'; });";

            return globalHelper()->ajaxSuccessResponse($html_response);

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            return globalHelper()->ajaxErrorResponse('');
        }
    }
}
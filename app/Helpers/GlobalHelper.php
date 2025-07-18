<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Mail\QcHealthMailer;
use App\Models\Applications;
use App\Models\Business;
use App\Models\BusinessRequirementLookUp;
use App\Models\BusinessTimelineLookUp;
use App\Models\Complaint;
use App\Models\ComplaintTimelineLookUp;
use App\Models\History;
use App\Models\Otp;
use App\Models\Payment;
use App\Models\PaymentLookUp;
use App\Models\RequirementLookUp;
use App\Models\TimelineLookUp;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GlobalHelper {

    public function getTimeLines(): array {
        try {
            return TimelineLookUp::orderBy('order', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getBusinessTimeLines(): array {
        try {
            return BusinessTimelineLookUp::orderBy('order', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getRequirementTypes(): array {
        try {
            return RequirementLookUp::orderBy('id', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getBusinessRequirementTypes(): array {
        try {
            return BusinessRequirementLookUp::orderBy('id', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }   

    public function getComplaintTimeLines(): array {
        try {
            return ComplaintTimelineLookUp::orderBy('order', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function ajaxErrorResponse(string $message='', string $url=''): JsonResponse {
        Log::channel('info')->info($message);
        $messages = self::getMessages();
        $msg = ( ! empty($message) ) ? $message : $messages['default'];
        $js = ['js' => "_confirm('alert', '".$msg."');"];
        return response()->json($js, 200);
    }

    public function ajaxSuccessResponse(string $scripts): JsonResponse {
        $scripts = preg_replace('/\r\n+/S', "", $scripts);
        return response()->json(['js' => $scripts], 200);
    }
    
    private static function getMessages() {
        return config('system.messages');
    }

    public function generateApplicationRefNo() {
        return date("Y").substr(str_shuffle('1234567890'), 0, 6);
    }

    public function generatePaymentRefNo() {
        return 'O'.date("y").substr(str_shuffle('1234567890'), 0, 7).'R';
    }

    public function updateApplicationStatusViaRefNo(string $ref_no, int $status): void {
        try {
            Applications::where('application_ref_no', $ref_no)->update(['application_status' => $status]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function updateBusinessStatusViaRefNo(string $ref_no, int $status): void {
        try {
            Business::where('application_ref_no', $ref_no)->update(['application_status' => $status]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function updateComplaintStatusViaRefNo(string $ref_no, int $status): void {
        try {
            Complaint::where('complaint_ref_no', $ref_no)->update(['status' => $status]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }
    
    public function getApplicationIdViaRefNo(string $ref_no): int {
        try {
            
            return Applications::where('application_ref_no', $ref_no)->pluck('id')[0];
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }
    public function getBusinessIdViaRefNo(string $ref_no): int {
        try {
            
            return Business::where('application_ref_no', $ref_no)->pluck('id')[0];
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }
    
    public function getApplicationViaRefNo(string $ref_no) {
        try {
            $application = Applications::where('application_ref_no', $ref_no)
            ->with('classification')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->with('business_line')
            ->with('requirements')
            ->get();

            if ($application) {
                return $application->toArray()[0];
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getBusinessViaRefNo(string $ref_no) {
        try {
            $business = Business::where('application_ref_no', $ref_no)
            ->with('histories')
            ->with('requirements')
            ->with('application_type')
            ->with('industry')
            ->with('sub_industry')
            ->get();

            if ($business) {
                return $business->toArray()[0];
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getComplaintViaRefNo(string $ref_no) {
        try {
            $complaint = Complaint::where('complaint_ref_no', $ref_no)->get();

            if ($complaint) {
                return $complaint->toArray()[0];
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getApplicationsViaUserId(int $user_id) {
        try {
            $applications = Applications::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->with('histories')
            // ->with('classification')
            // ->with('application_type')
            // ->with('industry')
            // ->with('sub_industry')
            // ->with('business_line')
            ->get();

                            
            if ($applications) {
                $applications =  array_map(function($application) {
                    $ordered_histories = [];
                    if ($application['histories']) {
                        foreach($application['histories'] as $history) { 
                            $ordered_histories[$history['timeline_look_up_id']] = $history;
                        }        
                        $application['histories'] = $ordered_histories;
                    }
                    return $application;
                },$applications->toArray());
                
                return $applications;
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getBusinessesViaUserId(int $user_id) {
        try {

            $businesses = Business::where('user_id', $user_id)
            ->with('histories')
            ->orderBy('created_at', 'desc')
            ->get();

            if ($businesses) {
                $businesses =  array_map(function($business) {
                    $ordered_histories = [];
                    if ($business['histories']) {
                        foreach($business['histories'] as $history) { 
                            $ordered_histories[$history['timeline_look_up_id']] = $history;
                        }        
                        $business['histories'] = $ordered_histories;
                    }
                    return $business;
                },$businesses->toArray());
                
                return $businesses;
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getComplaintsViaUserId(int $user_id) {
        try {
            $complaints = Complaint::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

            if ($complaints) {
                return $complaints->toArray();
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function logHistory(string $application_ref_no, string $timeline): void {
        try {
            if ($timeline == 'Water Analysis') {
                History::create([
                    'application_ref_no' => $application_ref_no,
                    'timeline_look_up_id' => $this->getBusinessTimelineIdViaName($timeline),
                ]);
            } else {
                History::create([
                    'application_ref_no' => $application_ref_no,
                    'timeline_look_up_id' => $this->getTimelineIdViaName($timeline),
                ]);
            }
            
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function logComplaintHistory(string $complaint_ref_no, string $timeline): void {
        try {
            History::create([
                'application_ref_no' => $complaint_ref_no,
                'timeline_look_up_id' => $this->getComplaintTimelineIdViaName($timeline),
            ]);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
        }
    }

    public function getHistory(string $application_ref_no): array {
        try {
            $app_histories = [];
            $histories = History::where('application_ref_no', $application_ref_no)
            ->orderBy('timeline_look_up_id', 'asc')
            ->get();
            
            if ($histories) {
                foreach($histories as $history) {
                    $app_histories[$history->timeline_look_up_id] = $history->toArray();
                }
            }
            
            return $app_histories;
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getTimelineIdViaName(string $timeline): int {
        try {
            return TimelineLookUp::where('timeline', $timeline)->pluck('id')[0];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }

    public function getBusinessTimelineIdViaName(string $timeline): int {
        try {
            return BusinessTimelineLookUp::where('timeline', $timeline)->pluck('id')[0];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }

    public function getComplaintTimelineIdViaName(string $timeline): int {
        try {
            return ComplaintTimelineLookUp::where('timeline', $timeline)->pluck('id')[0];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return 0;
        }
    }


    public function getApplicationData(
        string $ref_no,
        string $timeline,
        string $path,
    ) {
        return [
            'xrefno' => $ref_no,
            'xname' => $timeline,
            'xpath' => $path,
        ];
    }

    public function getPaymentTypes(): array {
        try {
            return PaymentLookUp::orderBy('id', 'asc')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getPaymentDetails(string $ref_no) {
        try {
            $total = 0;
            $payment_types = [];
            $payment_details = Payment::where('application_ref_no', $ref_no)->get()->toArray()[0];
            $payment_information = [];
       
            foreach($this->getPaymentTypes() as $payment_type) { $payment_types[$payment_type['id']] = $payment_type; }
            
            foreach(json_decode($payment_details['payment_information'], true) as $payment_detail) {
                $payment_information[] = [
                    'id' => $payment_detail['id'],
                    'description' => $payment_types[$payment_detail['id']]['description'],
                    'amount' => $payment_detail['amount'],
                ];

                $total += $payment_detail['amount'];
            }

            return ['details' => $payment_information, 'total' => $total, 'ref_no' => $payment_details['reference_no']];
            
        } catch (Exception $e) { 
            Log::channel('info')->info(json_encode($e->getMessage()));
            return []; 
        }
    }

    public function getUserViaAppRefno(string $ref_no) {
        try {
            $application = Applications::where('application_ref_no', $ref_no)
            ->with('user')
            ->with('requirements')
            ->get();

            if ($application) {
                return $application->toArray()[0];
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }
    public function getUserViaBusinessRefno(string $ref_no) {
        try {
            $application = Business::where('application_ref_no', $ref_no)
            ->with('user')
            ->with('requirements')
            ->get();

            if ($application) {
                return $application->toArray()[0];
            }
            return [];
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    // OTP
    public function getProfileViaEmail($email) {
        try {
            $user = User::where('email', $email)->first();
            
            return $user->toArray();
        } catch (\Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function getEmailDetails($type, $data=[]) {
        
        switch ($type) {
            case 'otp':
                $user_id = $data['id'];
                $otp_data = $this->generateOtp($user_id);
                $data['otp'] = $otp_data['otp'] ?? '';
                $data['verification_url'] = config('app.url') . '/verify-otp?token=' . $otp_data['token'];
                return [
                    'subject' => 'OTP Verification - QC Health Department',
                    'view' => 'mailer.otp',
                    'data' => $data,
                ];
            case 'password_reset':
                return [
                    'subject' => 'Password Reset Request - QC Health Department',
                    'view' => 'mailer.password_reset',
                    'data' => $data,
                ];
            default:
                return [
                    'subject' => 'OTP Verification - QC Health Department',
                    'view' => 'mailer.otp',
                ];
        }
    }

    public function generateOtp($user_id) {

        try {
        $otp = rand(100000, 999999);
        $token = md5(random_bytes(32).$otp);
        $otp_expiration = now()->addMinutes(5);

        $otp_data = [
            'user_id' => $user_id,
            'otp' => $otp,
            'expires_at' => $otp_expiration,
            'type' => 'otp',
            'token' => $token,
        ];

        $otp = Otp::create($otp_data);

        return $otp;
        } catch (\Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [];
        }
    }

    public function sendOtp($recipient) {
        try {
            $profile = $this->getProfileViaEmail($recipient);
            $emailDetails = $this->getEmailDetails('otp', $profile);
            
            Mail::to("$recipient")->send(new QcHealthMailer($emailDetails));

            return [
                'status' => true,
                'message' => 'OTP sent successfully',
                'js' => 'location = "'.$emailDetails['data']['verification_url'].'"',
            ];
            
        } catch (\Exception $e) {   
            Log::channel('info')->info(json_encode($e->getMessage()));
            return [
                'status' => false,
                'message' => 'Failed to send OTP',
            ];
        }
    }
}
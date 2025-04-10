<?php

declare(strict_types=1);
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HealthModulesController extends Controller {
    
    public $data;
    public function __construct() {
        $this->data = [ 'user_info' => [] ];
        $user_info = Auth::user();
        if ( $user_info) {
            $this->data['user_info'] = $user_info;
            $this->data['applications'] = globalHelper()->getApplicationsViaUserId(Auth::id());
        }
        
        $this->data['module_title'] = $this->data['xtitle'] = 'Health Certificate Application';
    }
    public function login() {
        return view("login")->with(['page_name' => "Log In"]);
    }

    public function register() {
        return view("registration")->with(['page_name' => "Registration"]);
    }

    public function home() {
        $this->data['page_name'] = 'Home';
        return view("modules.applicant.home", $this->data);
    }

    public function health_certificate() {

        $this->data['page_name'] = 'Health Certificate';
        return view("modules.applicant.health_certificate", $this->data);
        
    }

    public function sanitary_permit() {
        $this->data['page_name'] = 'Sanitary Permit';
        return view("modules.applicant.sanitary_permit", $this->data);
    }

    public function laboratory_followup() {
        $this->data['page_name'] = 'Follow-Up Laboratory';
        return view("modules.applicant.laboratory_followup", $this->data);
    }

    public function water_analysis_followup() {
        $this->data['page_name'] = 'Application Form';
        return view("modules.applicant.water_analysis_followup", $this->data);
    }

    public function processing_application($ref_no) {
        
        $application = globalHelper()->getApplicationViaRefNo($ref_no);

        if ($application) {
            $this->data['page_name'] = 'Application Form';
            $this->data['application'] = $application;
            $this->data['histories'] = globalHelper()->getHistory($application['id']);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/applicant'
                ),
            );

            return view("modules.applicant.processing_hc.application", $this->data);
        }
        
        return redirect("/applicant/home");
    }

    public function processing_upload_requirements($ref_no) {
        
        $application = globalHelper()->getApplicationViaRefNo($ref_no);
        
        if ($application) {
            $this->data['page_name'] = 'Upload Requirements';
            $this->data['application'] = $application;
            $this->data['histories'] = globalHelper()->getHistory($application['id']);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/applicant'
                ),
            );
            
            return view("modules.applicant.processing_hc.requirements", $this->data);
        }
        
        return redirect("/applicant/home");

        
    }

    public function processing_validate_requirements($ref_no) {
        
        $this->data['page_name'] = 'Requirements Validation';
        return view("modules.applicant.processing_hc.requirements_validation", $this->data);
    }

    public function processing_payment_order($ref_no) {
        
        $this->data['page_name'] = 'Payment Order';
        return view("modules.applicant.processing_hc.payment_order", $this->data);
    }

    public function processing_payment_validation($ref_no) {
        
        $this->data['page_name'] = 'Payment Validation';
        return view("modules.applicant.processing_hc.payment_validation", $this->data);
    }

    public function processing_seminar_laboratories($ref_no) {
        
        $this->data['page_name'] = 'HIV Seminar & Laboratories';
        return view("modules.applicant.processing_hc.seminar_laboratories", $this->data);
    }

    public function processing_head_approval($ref_no) {

        $this->data['page_name'] = 'Head Approval';
        return view("modules.applicant.processing_hc.approval", $this->data);
    }

    public function processing_certificate_issuing($ref_no) {

        $this->data['page_name'] = 'Certificate Issuing';
        return view("modules.applicant.processing_hc.certificate_issuing", $this->data);
    }
}
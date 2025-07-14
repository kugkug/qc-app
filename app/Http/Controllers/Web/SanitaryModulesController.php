<?php

declare(strict_types=1);
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanitaryModulesController extends Controller {
    
    public $data;
    public function __construct() {
        $this->data = [ 'user_info' => [] ];
        $user_info = Auth::user();
        if ( $user_info) {
            $this->data['user_info'] = $user_info;
            $this->data['businesses'] = globalHelper()->getBusinessesViaUserId(Auth::id());
        }
        
        $this->data['module_title'] = $this->data['xtitle'] = 'Sanitary Permit Application';
    }
    
    public function sanitary_permit() {
        $this->data['page_name'] = 'Sanitary Permit';
        return view("modules.applicant.sanitary_permit", $this->data);
    }

    public function processing_application($ref_no) {

        $business = globalHelper()->getBusinessViaRefNo($ref_no);

        if ($business) {    
            $this->data['page_name'] = 'Application Form';
            $this->data['business'] = $business;
            $this->data['histories'] = globalHelper()->getHistory($business['id']);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'
                ),
            );

            return view("modules.applicant.processing_sp.application", $this->data);
        }
        
        return redirect("/applicant/home");
    }

    public function processing_upload_requirements($ref_no) {
        
        $business = globalHelper()->getBusinessViaRefNo($ref_no);

        if ($business) {    
            $this->data['page_name'] = 'Upload Requirements';
            $this->data['business'] = $business;
            $this->data['histories'] = globalHelper()->getHistory($business['id']);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'
                ),
            );

            return view("modules.applicant.processing_sp.requirements", $this->data);   
        }
        return redirect("/applicant/home");
        
    }

    public function processing_validate_requirements($ref_no) {
        
        $business = globalHelper()->getBusinessViaRefNo($ref_no);
        
        if ($business) {
            $this->data['page_name'] = 'Requirements Validation';
            $this->data['business'] = $business;
            $this->data['histories'] = globalHelper()->getHistory($business['id']);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'
                ),
            );
            
            return view("modules.applicant.processing_sp.requirements_validation", $this->data);
        }
        
    }

    public function processing_payment_order($ref_no) {
        
        $business = globalHelper()->getBusinessViaRefNo($ref_no);
        
        if ($business) {

            $this->data['page_name'] = 'Order of Payment';
            $this->data['business'] = $business;
            $this->data['ref_no'] = $ref_no;
            $this->data['payment_details'] = globalHelper()->getPaymentDetails($ref_no);
            $this->data['histories'] = globalHelper()->getHistory($business['id']);

            $this->data['pdf_file'] = reportHelper()->generatePaymentOrderPdf($ref_no); 
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'
                ),
            );
            return view("modules.applicant.processing_sp.payment_order", $this->data);
        }
        return redirect("/applicant/home");
    }

    public function processing_payment_validation($ref_no) {
        
        $business = globalHelper()->getBusinessViaRefNo($ref_no);
        
        if ($business) {

            $this->data['page_name'] = 'Payment Validation';
            $this->data['business'] = $business;
            $this->data['ref_no'] = $ref_no;
            $this->data['payment_details'] = globalHelper()->getPaymentDetails($ref_no);
            $this->data['histories'] = globalHelper()->getHistory($business['id']);

            $this->data['pdf_file'] = reportHelper()->generatePaymentOrderPdf($ref_no);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'
                ),
            );
            return view("modules.applicant.processing_sp.payment_validation", $this->data);
        }
        
        return redirect("/applicant/home");
    }

    public function processing_water_analysis($ref_no) {

        $business = globalHelper()->getBusinessViaRefNo($ref_no);
        
        if ($business) {

            $this->data['page_name'] = 'Water Analysis';
            $this->data['business'] = $business;
            $this->data['ref_no'] = $ref_no;
            $this->data['payment_details'] = globalHelper()->getPaymentDetails($ref_no);
            $this->data['histories'] = globalHelper()->getHistory($business['id']);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'    
                ),
            );
            return view("modules.applicant.processing_sp.water_analysis", $this->data);
        }
    }

    public function processing_head_approval($ref_no) {
        $business = globalHelper()->getBusinessViaRefNo($ref_no);
        
        if ($business) {

            $this->data['page_name'] = 'Head Approval';
            $this->data['business'] = $business;
            $this->data['ref_no'] = $ref_no;
            $this->data['payment_details'] = globalHelper()->getPaymentDetails($ref_no);
            $this->data['histories'] = globalHelper()->getHistory($business['id']);

            $this->data['pdf_file'] = reportHelper()->generatePaymentOrderPdf($ref_no);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'
                ),
            );
            return view("modules.applicant.processing_sp.approval", $this->data);
        }
        
        return redirect("/applicant/home");

    }

    public function processing_certificate_issuing($ref_no) {

        $business = globalHelper()->getBusinessViaRefNo($ref_no);
        
        if ($business) {

            $this->data['page_name'] = 'Certificate Issuing';
            $this->data['business'] = $business;
            $this->data['ref_no'] = $ref_no;
            $this->data['payment_details'] = globalHelper()->getPaymentDetails($ref_no);
            $this->data['histories'] = globalHelper()->getHistory($business['id']);

            $this->data['pdf_file'] = reportHelper()->generateSanitaryPermit($ref_no);
            
            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $ref_no,
                    $this->data['page_name'],
                    '/business'    
                ),
            );
            return view("modules.applicant.processing_sp.certificate_issuing", $this->data);
        }

        return redirect("/business/home");
    }
}
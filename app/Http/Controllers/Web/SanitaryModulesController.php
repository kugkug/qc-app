<?php

declare(strict_types=1);
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SanitaryModulesController extends Controller {
    
    public $data;
    public function __construct() {
        $this->data = [];
        $this->data = [
            'module_title' => 'Sanitary Permit Application',
        ];
    }

    public function processing_application() {
        
        $this->data['page_name'] = 'Application Form';
        return view("modules.applicant.processing_sp.application", $this->data);
    }

    public function processing_upload_requirements() {
        
        $this->data['page_name'] = 'Upload Requirements';
        return view("modules.applicant.processing_sp.requirements", $this->data);
    }

    public function processing_validate_requirements() {
        
        $this->data['page_name'] = 'Requirements Validation';
        return view("modules.applicant.processing_sp.requirements_validation", $this->data);
    }

    public function processing_payment_order() {
        
        $this->data['page_name'] = 'Payment Order';
        return view("modules.applicant.processing_sp.payment_order", $this->data);
    }

    public function processing_payment_validation() {
        
        $this->data['page_name'] = 'Payment Validation';
        return view("modules.applicant.processing_sp.payment_validation", $this->data);
    }

    public function processing_seminar_laboratories() {
        
        $this->data['page_name'] = 'HIV Seminar & Laboratories';
        return view("modules.applicant.processing_sp.seminar_laboratories", $this->data);
    }

    public function processing_head_approval() {

        $this->data['page_name'] = 'Head Approval';
        return view("modules.applicant.processing_sp.approval", $this->data);
    }

    public function processing_certificate_issuing() {

        $this->data['page_name'] = 'Certificate Issuing';
        return view("modules.applicant.processing_sp.certificate_issuing", $this->data);
    }
}
<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicantModulesController extends Controller
{
    public $data;
    public function __construct() {
        $this->data = [];
    }
    public function login() {
        return view("login")->with(['page_name' => "Log In"]);
    }

    public function register() {
        return view("registration")->with(['page_name' => "Registration"]);
    }

    public function home() {
        $this->data = [
            'page_name' => 'Home',
        ];
        return view("modules.applicant.home", $this->data);
    }

    public function health_certificate() {
        $this->data = [
            'page_name' => 'Health Certificate',
        ];
        return view("modules.applicant.health_certificate", $this->data);
    }

    public function sanitary_permit() {
        $this->data = [
            'page_name' => 'Sanitary Permit',
        ];
        return view("modules.applicant.sanitary_permit", $this->data);
    }

    public function laboratory_followup() {
        $this->data = [
            'page_name' => 'Follow-Up Laboratory',
        ];
        return view("modules.applicant.laboratory_followup", $this->data);
    }

    public function water_analysis_followup() {
        $this->data = [
            'page_name' => 'Follow-up Analysis',
        ];
        return view("modules.applicant.water_analysis_followup", $this->data);
    }
}
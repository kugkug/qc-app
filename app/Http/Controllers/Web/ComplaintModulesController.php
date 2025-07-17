<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintModulesController extends Controller
{
    public $data;
    
    public function __construct() {
        $this->data = [ 'user_info' => [] ];
        $user_info = Auth::user();
        if ( $user_info) {
            $this->data['user_info'] = $user_info;
            $this->data['complaints'] = globalHelper()->getComplaintsViaUserId(Auth::id());
        }
        
        $this->data['module_title'] = $this->data['xtitle'] = 'Complaint';
    }
    
    public function index() {
        
        $this->data['page_name'] = 'Complaint';
        return view('modules.applicant.complaint', $this->data);
    }

    public function processing_complaint($complaint_ref_no) {
        $complaint = globalHelper()->getComplaintViaRefNo($complaint_ref_no);

        if ($complaint) {
            $this->data['page_name'] = 'Processing';
            $this->data['complaint'] = $complaint;
            $this->data['histories'] = globalHelper()->getHistory($complaint['complaint_ref_no']);

            $this->data = array_merge(
                $this->data, 
                globalHelper()->getApplicationData(
                    $complaint_ref_no,
                    $this->data['page_name'],
                    '/complaint'
                ),
            );

            return view("modules.applicant.complaint.processing", $this->data);
        }
        
        return redirect("/applicant/home");
    }

    public function processing_recommendation_first($complaint_ref_no) {
        $this->data['page_name'] = 'Complaint';
        return view('modules.applicant.complaint.processing_recommendation_first', $this->data);
    }

    public function processing_recommendation_second($complaint_ref_no) {
        $this->data['page_name'] = 'Complaint';
        return view('modules.applicant.complaint.processing_recommendation_second', $this->data);
    }

    public function processing_recommendation_third($complaint_ref_no) {
        $this->data['page_name'] = 'Complaint';
        return view('modules.applicant.complaint.processing_recommendation_third', $this->data);
    }

    public function processing_head_approval($complaint_ref_no) {
        $this->data['page_name'] = 'Complaint';
        return view('modules.applicant.complaint.processing_head_approval', $this->data);
    }

    public function processing_resolved($complaint_ref_no) {
        $this->data['page_name'] = 'Complaint';
        return view('modules.applicant.complaint.processing_resolved', $this->data);
    }
}
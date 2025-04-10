@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Application Form" xpath='/applicant'/> --}}

    @include('components.timeline')
    <form>
        <div class="row">
            <div class="col-md-12">            
                <div class="card rounded-0 shadow-lg">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title">
                            Application Details
                        </h3>
                        <div class="card-tools ml-auto">
                            <button class="btn btn-outline-danger btn-flat">
                                Cancel Application
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <x-details /> --}}
                        @include('components.details')
                        <h3 class="lead font-weight-class mb-3 mt-3">
                            Individual Health Certificate Application Form
                        </h3>

                        <div class="row">
                            
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Firstname <i class="text-red">*</i></label>
                                <input type="text" class="form-control rounded-0" placeholder="Enter Firstname" data="req" data-key="FirstName" value="{{ $user_info['firstname'] }}">
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Middlename</label>
                                <input type="text" class="form-control rounded-0" placeholder="Enter Middlename" data="" data-key="MiddleName" value="{{ $user_info['middlename'] }}">
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Lastname <i class="text-red">*</i></label>
                                <input type="text" class="form-control rounded-0" placeholder="Enter Lastname" data="req" data-key="LastName" value="{{ $user_info['lastname'] }}">
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Suffix</label>
                                <input type="text" class="form-control rounded-0" placeholder="Jr. / Sr. / I / II / III" data="req" data-key="SuffixName" value="{{ $user_info['suffixname'] }}">
                            </div>
                                
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Birthdate <i class="text-red">*</i></label>
                                <input type="date" class="form-control rounded-0" data="req" data-key="BirthDate" value="{{ $user_info['birthdate'] }}">
                            </div>
            
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Sex <i class="text-red">*</i></label>

                                <x-dropdowns xtype='genders' xselected="{{ $user_info['sex'] }}"/>
                            </div>
            
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Contact <i class="text-red">*</i></label>
                                <input type="text" class="form-control rounded-0" placeholder="09XXXXXXXXX" data="req" data-key="Contact" value="{{ $user_info['contact'] }}">
                            </div>
            
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Email Address <i class="text-red">*</i></label>
                                <input type="text" class="form-control rounded-0" placeholder="Email Address" data="req" data-key="Email" value="{{ $user_info['email'] }}">
                            </div>
            
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Civil Status <i class="text-red">*</i></label>
                                <x-dropdowns xtype='civil_statuses' xselected="{{ $user_info['civil_status_id'] }}" />
                            </div>
                            <div class="col-lg-3"> 
                                <label for="fname" class="">Occupation <i class="text-red">*</i> </label>
                                <input type="text" class="form-control rounded-0" placeholder="Enter Occupation" value="{{ $user_info['occupation'] }}">
                            </div>
            
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Barangay <i class="text-red">*</i></label>
                                <x-dropdowns xtype='barangays' xselected="{{ $user_info['barangay_id'] }}"/>
                            </div>
            
                            <div class="form-group col-lg-3">
                                <label for="fname" class="">Street <i class="text-red">*</i></label>
                                <input type="text" class="form-control rounded-0" placeholder="Enter Street" data-key="Street" required="" value="{{ $user_info['street'] }}">
            
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Additional Information:</label>
                                <input type="text" class="form-control rounded-0" placeholder="House # / Landmark" value="{{ $user_info['address'] }}">
                            </div>
                        </div>

                        <hr />
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Company Name <i class="text-red">*</i></label>
                                <input type="text" class="form-control rounded-0" placeholder="Company Name" value="{{ $application['company_name'] }}" data="req" data-key="CompanyName">
                            </div>

                        
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Company Address <i class="text-red">*</i></label>
                                <textarea rows="5" class="form-control rounded-0" placeholder="Company Address" data-key="CompanyAddress">{{trim($application['company_address'])}}</textarea>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox form-group form-check text-left">
                            <input type="checkbox" class="custom-control-input chk-req" id="customCheck2" name="example2" style="margin-left: 0rem !important;" required="">
                            <label class="custom-control-label" for="customCheck2" required="">
                                Accept
                                <a data-toggle="modal" data-target="#dop_modal" class="text-primary font-weight-bold">
                                    Data Privacy Policy
                                </a>
                                to proceed.
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{-- <a class="btn btn-outline-success btn-flat btn-block" href="/applicant/processing/upload-requirements">
                                    NEXT
                                </a> --}}
                                <button type="button" 
                                    class="btn btn-outline-success btn-flat btn-block btn-disabled" 
                                    data-trigger="process-application" 
                                    disabled=""
                                    data-refno={{ $application['application_ref_no']}}
                                >
                                    NEXT
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-outline-danger btn-flat btn-block" href="/applicant/health_certificate">
                                    CANCEL
                                </a>
                                {{-- <button class="btn btn-outline-danger btn-flat btn-block">
                                    CANCEL
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@include('components.data_privacy_policy')
@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/health/application.js') }}"></script>
@include('partials.applicant.processing-header')

<div class="container">
    
    <x-timeline xtitle={{$module_title}}/>

    <div class="card rounded-0">
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
            <x-details />
            <hr />

            <h3 class="lead font-weight-class mb-3">
                Individual Health Certificate Application Form
            </h3>

            <p>Personal Info</p>
            <div class="row">
                
                <div class="form-group col-lg-3">
                    <label for="fname" class="">Firstname <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Firstname" data="req" data-key="FirstName">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Middlename</label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Middlename" data="" data-key="MiddleName">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Lastname <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Lastname" data="req" data-key="LastName">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Suffix</label>
                    <input type="text" class="form-control rounded-0" placeholder="Jr. / Sr. / I / II / III" data="req" data-key="LastName">
                </div>
                    
            </div>

            <div class="row">

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Email Address. <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Email Address" data="req" data-key="Email">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Birthdate <i class="text-red">*</i></label>
                    <input type="date" class="form-control rounded-0" data="req" data-key="BirthDate">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Gender <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Lastname" data="req" data-key="LastName">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Civil Status <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Civil Status" data="req" data-key="ContactNo">
                </div>

            </div>

            <div class="row">

                <div class="form-group col-lg-3">
                    <label for="fname" class="">City <i class="text-red">*</i></label>
                    <select class="form-control rounded-0" data="req">
                        <option value="" selected="selected">- Select City -</option>
                        <option value="qc">Quezon City</option>
                        <option value="others">Others</option>
                    </select>                            
                </div>

                <div class="form-group col-lg-3">
                    <div class="form-group">
                        <label for="fname" class="">Specify your City <i class="text-red">*</i></label>
                        <input type="text" class="form-control rounded-0" autocomplete="new-password" placeholder="Specify here" disabled="" />
                        
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label for="fname" class="">Contact No. <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="09XXXXXXXXX" data="req" data-key="ContactNo">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Barangay <i class="text-red">*</i></label>
                    <x-dropdowns xtype='baranggays' />
                </div>

                

            </div>

            <div class="row">
                <div class="form-group col-lg-3">
                    <label for="fname" class="">Street <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Street" id="street_name" name="street_name" required="">

                </div>

                <div class="form-group col-lg-9">
                    <label for="fname" class="">Additional Information:</label>
                    <input type="text" class="form-control rounded-0" placeholder="House # / Landmark">
                </div>
            </div>

            <p>Company Info</p>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label for="fname" class="">Occupation <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Occupation" id="street_name" name="street_name" required="">
                </div>

                <div class="form-group col-lg-4">
                    <label for="fname" class="">Company Name</label>
                    <input type="text" class="form-control rounded-0" placeholder="Company Name">
                </div>

                <div class="form-group col-lg-4">
                    <label for="fname" class="">Occupational Permit</label>
                    <div class="input-group">
                        <input type="text" class="form-control rounded-0" placeholder="Validate Occupational Permit">
                        <span class="input-group-append">
                          <button type="button" class="btn btn-danger btn-flat">Validate</button>
                        </span>
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="fname" class="">Company Address <i class="text-red">*</i></label>
                    <textarea rows="5" class="form-control rounded-0" placeholder="Company Address"></textarea>
                </div>
            </div>

            <div class="custom-control custom-checkbox form-group form-check text-left">
                <input type="checkbox" class="custom-control-input" id="customCheck2" name="example2" style="margin-left: 0rem !important;" required="">
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
                    <a class="btn btn-outline-success btn-flat btn-block" href="/applicant/processing/upload-requirements">
                        NEXT
                    </a>
                    {{-- <button class="btn btn-outline-success btn-flat btn-block">
                        NEXT
                    </button> --}}
                </div>
                <div class="col-md-6">
                    <a class="btn btn-outline-success btn-flat btn-block" href="/applicant/health_certificate">
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
@include('components.data_privacy_policy')
@include('partials.applicant.footer')
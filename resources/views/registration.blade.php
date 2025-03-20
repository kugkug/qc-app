@include('partials.unauth.header')

<div class="container">
    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <div class="text-center">
                <img src="{{ asset('assets/images/system/qclogo_main.png') }}" class="img-fluid mx-auto d-block">
                <p class="text-danger font-weight-bold mt-2">
                    CREATE NEW QC HEALTH SERVICES ACCOUNT
                </p>
            </div>
        </div>
        <div class="card-body">
            
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
            <hr />
            <div class="row">
                <div class="form-group col-lg-3">
                    <label for="fname" class="">Birthdate <i class="text-red">*</i></label>
                    <input type="date" class="form-control rounded-0" data="req" data-key="BirthDate">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Sex <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Lastname" data="req" data-key="LastName">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Contact No. <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="09XXXXXXXXX" data="req" data-key="ContactNo">
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Email Address. <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Email Address" data="req" data-key="Email">
                </div>

            </div>
            <hr />
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
                    <label for="fname" class="">Barangay <i class="text-red">*</i></label>
                    <x-dropdowns xtype='barangays' />
                </div>

                <div class="form-group col-lg-3">
                    <label for="fname" class="">Street <i class="text-red">*</i></label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Street" id="street_name" name="street_name" required="">

                </div>
                
            </div>

            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="fname" class="">Additional Information:</label>
                    <input type="text" class="form-control rounded-0" placeholder="House # / Landmark">
                </div>
            </div>

            <hr />

            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="fname" class="">Are you working in Quezon City?</label>
                    <div class="form-group">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input rounded-0" name="workinqc" value="yes">Yes												</label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input rounded-0" name="workinqc" value="no" checked="">No												</label>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6"> 
                    <label for="fname" class="">Occupation</label>
                    <input type="text" class="form-control rounded-0" placeholder="Enter Occupation" disabled="">
                </div>
            </div>

        </div>
    </div>

    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h5 class="card-title text-red font-weight-bold">Login Credentials</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="fname" class="">Password <i class="text-red">*</i></label>
                    <input type="password" class="form-control rounded-0" placeholder="Password" data="req" data-key="FirstName">
                </div>

                <div class="form-group col-lg-6">
                    <label for="fname" class="">Confirm Password <i class="text-red">*</i></label>
                    <input type="password" class="form-control rounded-0" placeholder="Confirm Password" data="" data-key="MiddleName">
                </div>
            </div>
        </div> 
    </div>

    <div class="card rounded-0 shadow-lg">
        
        <div class="card-body">
            <div class="custom-control custom-checkbox form-group form-check text-left">
                <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" style="margin-left: 0rem !important;" required="">
                <label class="custom-control-label" for="customCheck" required="">
                    I have read and understood the
                </label>
                <a data-toggle="modal" data-target="#toc_modal" class="text-primary font-weight-bold">
                    Terms of Use.
                </a>
            </div>
            <hr />
            <div class="custom-control custom-checkbox form-group form-check text-left">
                <input type="checkbox" class="custom-control-input" id="customCheck2" name="example2" style="margin-left: 0rem !important;" required="">
                <label class="custom-control-label" for="customCheck2" required="">
                    I have read and understood the
                </label>
                <a data-toggle="modal" data-target="#dop_modal" class="text-primary font-weight-bold">
                    Data Privacy Policy.
                </a>
            </div>
            
        </div>

        <div class="card-footer">
            <p class="small">
                <i>By clicking on the register button below, I hereby agree to both the Terms of Use and Data Privacy Policy.</i>
            </p>

            <button type="button" class="btn btn-outline-success btn-flat" disabled="">
                <i class="fas fa-check"></i> REGISTER
            </button>

            <a href="/" type="button" class="btn btn-outline-danger btn-flat">
                <i class="fas fa-times"></i> &nbsp; CANCEL</button>
            </a>
        </div>
    </div>

</div>

@include('components.terms_of_use')
@include('components.data_privacy_policy')
@include('partials.unauth.footer')
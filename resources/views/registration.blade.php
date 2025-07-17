@include('partials.unauth.header')

<section class="container">
    <form action="">
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
                        <input type="text" class="form-control rounded-0" placeholder="Jr. / Sr. / I / II / III"data-key="SuffixName">
                    </div>
                    
                </div>
                <hr />
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="fname" class="">Birthdate <i class="text-red">*</i></label>
                        <input type="date" class="form-control rounded-0" data="req" data-key="BirthDate">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="fname" class="">Gender <i class="text-red">*</i></label>
                        <x-dropdowns xtype='genders' xselected=""/>
                    </div>

                    <div class="form-group col-lg-3">
                        <label for="fname" class="">Contact <i class="text-red">*</i></label>
                        <input type="text" class="form-control rounded-0" placeholder="09XXXXXXXXX" data="req" data-key="Contact" maxlength="12">
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="fname" class="">Email Address <i class="text-red">*</i></label>
                        <input type="text" class="form-control rounded-0" placeholder="Email Address" data="req" data-key="Email">
                    </div>

                </div>
                <hr />
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="fname" class="">Civil Status <i class="text-red">*</i></label>
                        <x-dropdowns xtype='civil_statuses' xselected=""/>
                    </div>
                    <div class="col-lg-3"> 
                        <label for="fname" class="">Occupation </label>
                        <input type="text" class="form-control rounded-0" placeholder="Enter Occupation" data-key="Occupation">
                    </div>

                    <div class="form-group col-lg-3">
                        <label for="fname" class="">Barangay <i class="text-red">*</i></label>
                        <x-dropdowns xtype='barangays' xselected=""/>
                    </div>

                    <div class="form-group col-lg-3">
                        <label for="fname" class="">Street <i class="text-red">*</i></label>
                        <input type="text" class="form-control rounded-0" placeholder="Enter Street" data="req" data-key="Street">

                    </div>
                    
                </div>

                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="fname" class="">Additional Information:</label>
                        <input type="text" class="form-control rounded-0" placeholder="House # / Landmark" data-key="Address">
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
                        <input type="password" class="form-control rounded-0" placeholder="Password" data="req" data-key="Password">
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="fname" class="">Confirm Password <i class="text-red">*</i></label>
                        <input type="password" class="form-control rounded-0" placeholder="Confirm Password" data="req" data-key="ConfirmPassword">
                    </div>
                </div>
            </div> 
        </div>

        <div class="card rounded-0 shadow-lg">
            
            <div class="card-body">
                <div class="custom-control custom-checkbox form-group form-check text-left">
                    <input type="checkbox" class="custom-control-input chk-req" id="chk-tou" style="margin-left: 0rem !important;" required="">
                    <label class="custom-control-label" for="chk-tou" required="">
                        I have read and understood the
                    </label>
                    <a data-toggle="modal" data-target="#toc_modal" class="text-primary font-weight-bold">
                        Terms of Use.
                    </a>
                </div>
                <hr />
                <div class="custom-control custom-checkbox form-group form-check text-left">
                    <input type="checkbox" class="custom-control-input chk-req" id="chk-dpp" style="margin-left: 0rem !important;" required="">
                    <label class="custom-control-label" for="chk-dpp" required="">
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

                <button type="button" class="btn btn-outline-success btn-disabled btn-flat" disabled="" data-trigger="register">
                    <i class="fas fa-check"></i> REGISTER
                </button>

                <a href="/" type="button" class="btn btn-outline-danger btn-flat">
                    <i class="fas fa-times"></i> &nbsp; CANCEL</button>
                </a>
            </div>
        </div>
    </form>

</section>

@include('components.terms_of_use')
@include('components.data_privacy_policy')
@include('partials.unauth.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/components/dropdown.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/registration.js') }}"></script>
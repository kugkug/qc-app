
@if($application['application_status'] < config('system.application_status')['uploaded_requirements'])
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

    <div class="row">
        <div class="col-md-6">
            <button type="button" 
                class="btn btn-outline-success btn-flat btn-block" 
                data-trigger="process-application" 
                data-refno={{ $application['application_ref_no']}}
            >
                NEXT
            </button>
        </div>
        <div class="col-md-6">
            <a class="btn btn-outline-primary btn-flat btn-block" href="/applicant/health_certificate">
                BACK TO LIST
            </a>
        </div>
    </div>

    @else
        <div class="row">
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Firstname</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['firstname'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Middlename</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['middlename'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Lastname</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['lastname'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Suffix</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['suffixname'] )) }}
                    </dd>
                </dl>
            </div>
        </div>


        <div class="row">
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Birthdate</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['birthdate'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Gender</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['sex'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Contact</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['contact'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Email Address</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['email'] )) }}
                    </dd>
                </dl>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Civil Status</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        @php
                        
                            $civil_status = array_filter($global_dropdowns['civil_statuses'], function($status) use($user_info) { 
                                return $status['id'] == $user_info['civil_status_id'];
                            });
                        @endphp
                        {{ ucwords(strtolower( array_values($civil_status)[0]['civil_status'] )) }}
                        
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Occupation</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['occupation'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">

                <dl>
                    <dt class="font-weight-normal text-muted">Baranggay</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        @php
                            $brgy = array_filter($global_dropdowns['barangays'], function($brgy) use($user_info) { 
                                return $brgy['id'] == $user_info['barangay_id'];
                            });
                        @endphp
                        {{ ucwords(strtolower( array_values($brgy)[0]['baranggay'] )) }}
                    </dd>
                </dl>
            </div>
            <div class="form-group col-lg-3">
                <dl>
                    <dt class="font-weight-normal text-muted">Street</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $user_info['street'] )) }}
                    </dd>
                </dl>
            </div>


                <div class="form-group col-lg-12">
                    
                    <dl>
                        <dt class="font-weight-normal text-muted">Additional Information</dt>
                        <dd class="font-weight-bold border-bottom border-dark text-truncate">
                            {{ ucwords(strtolower( $user_info['address'] )) }}
                        </dd>
                    </dl>
                </div>
            <div class="form-group col-lg-12">

                <dl>
                    <dt class="font-weight-normal text-muted">Company Name</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $application['company_name'] )) }}
                    </dd>
                </dl>

            </div>

            <div class="form-group col-lg-12">

                <dl>
                    <dt class="font-weight-normal text-muted">Company Address</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $application['company_address'] )) }}
                    </dd>
                </dl>
            </div>

           

        </div>
        
         <div class="row">
                <div class="col-md-6">
                    <a type="button" 
                        class="btn btn-outline-success btn-flat btn-block" 
                        href="/applicant/processing/upload-requirements/{{ $application['application_ref_no']}}"
                    >
                        NEXT
                </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-outline-primary btn-flat btn-block" href="/applicant/health_certificate">
                        BACK TO LIST
                    </a>
                </div>
            </div>


        
    @endif

    
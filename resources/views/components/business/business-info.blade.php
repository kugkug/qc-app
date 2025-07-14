@if($business['application_status'] < config('system.application_status')['uploaded_requirements'])
    <div class="row">
                                
        <div class="form-group col-lg-12">
            <label for="fname" class="">Establishment Name <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="Enter Establishment Name" data="req" data-key="CompanyName" value="{{ $business['company_name'] }}">
        </div>            
    </div>

    <div class="row">
        <div class="form-group col-lg-12">
            <label for="fname" class="">Business Address <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="Business Address" data="req" data-key="CompanyAddress" value="{{trim($business['company_address'])}}">
        </div>

    </div>

    <div class="row">
        <div class="form-group col-lg-12">
            <label for="fname" class="">Name of Owner/Manager <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="Name of Owner/Manager" data="req" data-key="CompanyOwner" value="{{ $business['company_owner'] }}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12">
            <label for="fname" class="">Mayor's Permit No. <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="Mayor's Permit No." data="req" data-key="MayorPermitNo" value="{{ $business['mayor_permit_no'] }}">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-3">
            <label for="fname" class="">Total Number of Employees <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="Total Number of Employees" data="req" data-key="TotalEmployees" value="{{ $business['total_employees'] ?? 0 }}">
        </div>
        <div class="form-group col-lg-3">
            <label for="fname" class="">Employees w/ Health Certificate <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="Employees w/ Health Certificate" data="req" data-key="TotalEmployeesWithCertificates" value="{{ $business['total_employees_with_certificates'] ?? 0 }}">
        </div>
        <div class="form-group col-lg-3">
            <label for="fname" class="">Employees w/o Health Certificate <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="Employees w/o Health Certificate" data="req" data-key="TotalEmployeesWithoutCertificates" value="{{ $business['total_employees_without_certificates'] ?? 0 }}">
        </div>

        <div class="form-group col-lg-3">
            <label for="fname" class="">No. of Personnel using PPEs <i class="text-red">*</i></label>
            <input type="text" class="form-control rounded-0" placeholder="No. of Personnel using PPE" data="req" data-key="TotalEmployeesWithPPE" value="{{ $business['total_employees_with_ppe'] ?? 0 }}">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <button type="button" 
                class="btn btn-outline-success btn-flat btn-block" 
                data-trigger="process-application" 
                data-refno={{ $business['application_ref_no']}}
            >
                NEXT
            </button>
        </div>
        <div class="col-md-6">
            <a class="btn btn-outline-primary btn-flat btn-block" href="/applicant/sanitary_permit">
                BACK TO LIST
            </a>
        </div>
    </div>

    @else
        
        <div class="row">
            <div class="form-group col-lg-12">

                <dl>
                    <dt class="font-weight-normal text-muted">Company Name</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $business['company_name'] )) }}
                    </dd>
                </dl>

            </div>

            <div class="form-group col-lg-12">

                <dl>
                    <dt class="font-weight-normal text-muted">Company Address</dt>
                    <dd class="font-weight-bold border-bottom border-dark text-truncate">
                        {{ ucwords(strtolower( $business['company_address'] )) }}
                    </dd>
                </dl>
            </div>

        </div>
        
         <div class="row">
                <div class="col-md-6">
                    <a type="button" 
                        class="btn btn-outline-success btn-flat btn-block" 
                        href="/business/processing/upload-requirements/{{ $business['application_ref_no']}}"
                    >
                        NEXT
                </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-outline-primary btn-flat btn-block" href="/applicant/sanitary_permit">
                        BACK TO LISTs
                    </a>
                </div>
            </div>


        
    @endif

    
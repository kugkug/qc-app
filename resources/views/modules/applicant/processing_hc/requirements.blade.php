@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Upload Requirements"  xpath='/applicant'/> --}}

    @include('components.timeline')
    <div class="row pt-5">
        <div class="col-md-12">            
            <div class="card rounded-0 shadow-lg" >
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Application Details
                    </h3>
                    <div class="card-tools  ml-auto">
                        <button class="btn btn-outline-danger btn-flat">
                            Cancel Application
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <x-details /> --}}
                    @include('components.details')
                    <hr />

                    <h3 class="lead font-weight-bold">
                        Requirements Upload
                    </h3>
                    <h3 class="lead">
                        Upload Source: <span class="font-weight-bold">External Laboratory Only</span>
                    </h3>
                    {{-- <small>We </small> --}}

                    <hr />
                    {{-- <div class="row mb-3">
                        <div class="col-md-6">
                            <button class="btn btn-outline-danger btn-flat btn-block">
                                EXTERNAL LABORATORY
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-danger btn-flat btn-block">
                                QC IN-HOUSE LABORATORY
                            </button>
                        </div>
                    </div> --}}
            
                    <p>Requirements</p>
                    {{-- <div class="card rounded-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="lead">
                                        Business Permit of nano-enterprise
                                    </h3>
                                    <span class="badge bg-info">Optional</span><br />
                                    <small>Business permit of nano-enterprise</small>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button class="btn btn-info btn-flat btn-block">PREVIEW</button>
                                </div>

                                <div class="col-md-3 d-flex align-items-center border-right">
                                    
                                    <div class="input-group border-2">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Requirement File</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-1 d-flex align-items-center justify-content-center border-right">
                                    Status
                                </div>
                                <div class="col-md-2 d-flex align-items-center ">

                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </div> --}}

                    
                    
                    @foreach ($global_requirement_types as $requirement_type)
                        <div class="card rounded-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="lead">
                                            {{ $requirement_type['title'] }}
                                        </h3>
                                        @if ($requirement_type['restriction'] === "optional")
                                            <span class="badge bg-info">Optional</span><br />    
                                        @else
                                            <span class="badge bg-danger">Required</span><br />
                                        @endif
                                        <small>{{ $requirement_type['description'] }}</small>
                                        
                                    </div> 
                                    <div class="col-md-1 d-flex align-items-center">
                                        <button 
                                            class="btn btn-info btn-flat btn-block btn-preview"
                                            disabled=""
                                        >PREVIEW</button>
                                    </div>
    
                                    <div class="col-md-3 d-flex align-items-center border-right">
                                        
                                        <div class="input-group border-2">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input">
                                                <label class="custom-file-label"></label>
                                            </div>
                                        </div>
    
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center justify-content-center border-right">
                                        Status
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <input type="date" class="form-control">
                                    </div>
                                </div>  
                            </div>
                        </div>
                    @endforeach


                    <div class="custom-control custom-checkbox form-group form-check text-left">
                        <input type="checkbox" class="custom-control-input chk-req" id="customCheck2" name="example2" style="margin-left: 0rem !important;" required="">
                        <label class="custom-control-label" for="customCheck2" required="">
                            I certify that provided requirements are valid and true
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {{-- <a class="btn btn-outline-success btn-flat btn-block" href="/applicant/processing/validate-requirements">
                                NEXT
                            </a> --}}
                            <button type="button" 
                                    class="btn btn-outline-success btn-flat btn-block btn-disabled" 
                                    data-trigger="upload-requirements" 
                                    disabled=""
                                    data-refno={{ $application['application_ref_no']}}
                                >
                                NEXT
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-outline-danger btn-flat btn-block" href="/applicant/processing/application/{{$application['application_ref_no']}}">
                                BACK TO APPLICATION FORM
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
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-modal="true" id="modal-preview">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Image Preview</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body d-flex justify-content-center align-items-center">

            </div>
        </div>
    </div>
</div>

@include('partials.applicant.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/health/upload-requirements.js') }}"></script>
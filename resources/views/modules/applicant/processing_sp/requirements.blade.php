@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Upload Requirements"  xpath='/applicant'/> --}}

    @include('components.timeline_business')
    <form action="">
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
                        @include('components.details_business')
                        <hr />

                        <h3 class="lead font-weight-bold">
                            Requirements Upload
                        </h3>
                        <h3 class="lead">
                            Upload Source: <span class="font-weight-bold">External Laboratory Only</span>
                        </h3>
                        <hr />
                        <p>Requirements</p>
                    
                        @php
                            $photo = "";
                            $approve_key = array_keys(config('system.requirement_status_text'), 'Completed')[0];
                            $reject_key = array_keys(config('system.requirement_status_text'), 'Requires Update')[0];
                    
                            $requirements = [];
                            foreach ($business['requirements'] as $requirement) {
                                $requirements[$requirement['requirement']] = $requirement;
                            }
                        @endphp

                        @if($requirements)
                            @foreach ($global_business_requirement_types as $requirement_type)

                            @php
                                $requirement_data = $requirements[$requirement_type['id']];
                                $status_text = config('system.requirement_status_text')[$requirement_data['status']];
                                $status_class = config('system.requirement_status_class')[$status_text];
                                $status = $requirement_data['photo'] ? $status_text : 'No Upload';
                            
                                $photo = "requirements/".$requirement_data['photo'];
                            @endphp
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
                                                @if($requirement_data['status'] == config('system.requirement_status')['rejected'])
                                                    <br />
                                                    <small class="text-red text-bold">{{ $requirements[$requirement_type['id']]['notes'] }}</small>
                                                @endif
                                                
                                            </div> 
                                            <div class="col-md-1 d-flex align-items-center">
                                                <button 
                                                    class="btn btn-info btn-flat btn-block btn-preview"
                                                    data-image="{{ asset($photo) }}"
                                                >PREVIEW</button>
                                            </div>
            
                                            <div class="col-md-3 d-flex align-items-center border-right">
                                                @if($requirement_data['status'] == config('system.requirement_status')['completed'])
                                                    <div class="input-group border-2">
                                                        <div class="custom-file">
                                                            <input 
                                                                type="text" 
                                                                value="{{ asset($photo) }}"
                                                            >
                                                            <label class="custom-file-label">
                                                                {{ $requirement_data['photo'] }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="input-group border-2">
                                                        <div class="custom-file">
                                                            <input 
                                                                type="file" 
                                                                class="custom-file-input" 
                                                                data-key="ImageFile_{{$requirement_type['id']}}"
                                                                value="{{ asset($photo) }}"
                                                            >
                                                            <label class="custom-file-label">
                                                                {{ $requirement_data['photo'] }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
            
                                            </div>
                                            <div 
                                                class="col-md-2 d-flex align-items-center justify-content-center border-right {{ $status_class }}">
                                                {{ $status }}
                                            </div>
                                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                                <input 
                                                    type="date" 
                                                    class="form-control" 
                                                    data-key="DateUploaded_{{$requirement_type['id']}}" 
                                                    value="{{ date("Y-m-d", strtotime($requirement_data['created_at'])) }}">
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach ($global_business_requirement_types as $requirement_type)
                                
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
                                                        <input 
                                                            type="file" 
                                                            class="custom-file-input" 
                                                            data="req"
                                                            data-key="ImageFile_{{$requirement_type['id']}}"
                                                        >
                                                        <label class="custom-file-label"></label>
                                                    </div>
                                                </div>
            
                                            </div>
                                            <div 
                                                class="col-md-2 d-flex align-items-center justify-content-center border-right">
                                                No Upload
                                            </div>
                                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                                <input 
                                                    type="date" 
                                                    class="form-control" 
                                                    data="req" 
                                                    data-key="DateUploaded_{{$requirement_type['id']}}"
                                                >
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            @endforeach
                        @endif


                        <div class="custom-control custom-checkbox form-group form-check text-left">
                            <input type="checkbox" class="custom-control-input chk-req" id="chk-certify" name="chk-certify" style="margin-left: 0rem !important;" required="">
                            <label class="custom-control-label" for="chk-certify" required="">
                                I certify that provided requirements are valid and true
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox form-group form-check text-left">
                            <input type="checkbox" class="custom-control-input chk-req" id="chk-privacy" name="chk-privacy" style="margin-left: 0rem !important;" required="">
                            <label class="custom-control-label" for="chk-privacy" required="">
                                Accept
                                <a data-toggle="modal" data-target="#dop_modal" class="text-primary font-weight-bold">
                                    Data Privacy Policy
                                </a>
                                to proceed.
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" 
                                        class="btn btn-outline-success btn-flat btn-block btn-disabled" 
                                        data-trigger="upload-requirements" 
                                        disabled=""
                                        data-refno={{ $business['application_ref_no']}}
                                    >
                                    NEXT
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-outline-danger btn-flat btn-block" href="/business/processing/application/{{$business['application_ref_no']}}">
                                    BACK TO APPLICATION FORM
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
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
			<div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 60vh !important;">
            </div>
        </div>
    </div>
</div>
@include('components.data_privacy_policy')
@include('partials.applicant.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/sanitary/upload-requirements.js') }}"></script>
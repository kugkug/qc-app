@include('partials.applicant.processing-header')

<div class="container">
    @include('components.timeline_business')

    @php
        $qcid_icon = base64_encode(file_get_contents(public_path('assets/images/system/qcid_icon.png')));
        $qc_health_log = base64_encode(file_get_contents(public_path('assets/images/system/qc_health_logo.png')));
    @endphp

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card rounded-0 shadow-lg">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Water Analysis Result
                    </h3>
                    <div class="card-tools ml-auto">
                        {{-- <a href="{{ asset("$pdf_file") }}" class="btn btn-outline-primary btn-flat" download="">
                            Download Order of Payment
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Please upload your water analysis result here.</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-primary btn-flat btn-upload">Upload Water Analysis Result</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-modal="true" id="modal-upload">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Upload Water Analysis Result</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="file-drop-area text-center">
                            <div>
                                <span class="choose-file-button">Choose files</span>
                                <span class="file-message">or drag and drop files here</span>
                                <input class="file-input" type="file" id="txtFiles" multiple>
                                <br />                        
                            </div>
                        </div>
    
                        <div class="row div-main-uploads d-none">
                            <div class="col-md-12" id="div-uploads">
                                
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-primary btn-flat btn-save" data-ref-no="{{ $ref_no }}" disabled>Upload File</button>
                <button type="button" class="btn btn-outline-danger btn-flat btn-reset"  disabled>Clear</button>
            </div>

        </div>
    </div>
</div>

@include('partials.applicant.footer')
<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/sanitary/water-analysis.js') }}"></script>
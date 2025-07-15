@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Certificate Issuing" xpath='/applicant'/> --}}
    @include('components.timeline_business')

    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h3 class="card-title">
                Sanitray Permit
            </h3>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Staus</th>
                        <th class="w-25">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mon, 21 Oct 2024</td>
                        <td>Sanitray Permit Approved</td>
                        <td>
                            <button class="btn btn-outline-info btn-flat btn-block btn-preview btn-preview-hid" >VIEW DIGITAL SANITARY PERMIT</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>

    @php
        
        $requirements = [];
        foreach ($business['requirements'] as $requirement) {
            $requirements[$requirement['requirement']] = $requirement;
        }
    @endphp

    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h3 class="card-title">
                Laboratory Results
            </h3>
        </div>
        <div class="card-body">

            <table class="table">

                <tbody>
                    @if($requirements)
                    
                        @foreach ($global_business_requirement_types as $requirement_type)                            
                            @if ($requirement_type['restriction'] == "required")
                            @php
                                $requirement_data = $requirements[$requirement_type['id']];
                                $status_text = config('system.requirement_status_text')[$requirement_data['status']];
                                $status_class = config('system.requirement_status_class')[$status_text];
                                $status = $requirement_data['photo'] ? $status_text : 'No Upload';
                            
                                $photo = "requirements/".$requirement_data['photo'];
                            @endphp

                            <tr>
                                <td>{{$requirement_type['description']}}</td>
                                <td class="w-25">
                                    <button 
                                        class="btn btn-outline-info btn-flat btn-block btn-preview"
                                        data-image="{{ asset($photo) }}"
                                    >PREVIEW</button>
                                </td>
                            </tr>
                            
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
            
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
			<div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 60vh !important;">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-modal="true" id="modal-health-card">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Sanitray Permit Preview</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-md-12"> 
                        <iframe src="{{ asset("$pdf_file") }}" frameborder="0" style="width: 100%; height: 560px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/sanitary/issuing.js') }}"></script>
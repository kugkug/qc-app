@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Certificate Issuing" xpath='/applicant'/> --}}
    @include('components.timeline')

    <div class="card rounded-0 shadow-lg">
        <div class="card-header">
            <h3 class="card-title">
                Health Card Identification
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
                        <td>Health Card Approved</td>
                        <td>
                            <button class="btn btn-outline-info btn-flat btn-block btn-preview btn-preview-hid" >VIEW DIGITAL HEALTH CARD</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>

    @php
        
        $requirements = [];
        foreach ($application['requirements'] as $requirement) {
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
                    
                        @foreach ($global_requirement_types as $requirement_type)                            
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
				<h5 class="modal-title">Digital Health Card Preview</h5>
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
                {{-- <div class="row">
                    <div class="col-md-6" id="div-front-id">
                        <img src="{{asset('assets/images/system/people_corner_icon.jpg')}}" alt="" >
                        <div class="" id="div-id-data">
                            <div class="row mt-1">
                                <div class="col-md-2">NAME: </div>
                                <div class="col-md-10 text-center border-bottom">{{ ucwords(strtolower($application['user']['lastname'].", ".$application['user']['firstname'])) }}</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-1">AGE: </div>
                                <div class="col-md-2 text-center border-bottom">{{ $application['user']['suffixname'] }}</div>
                                <div class="col-md-1">SEX: </div>
                                <div class="col-md-2 text-center border-bottom">{{ $application['user']['sex'] }}</div>
                                <div class="col-md-3">NATIONALITY: </div>
                                <div class="col-md-3 text-center border-bottom">{{ $application['user']['nationality'] }}</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-4">HOME ADDRESS: </div>
                                <div class="col-md-8 text-center border-bottom">
                                    {{ ucwords(strtolower($application['user']['street'] ." ".$application['user']['barangay_id']." ".$application['user']['address'])) }}
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3">OCCUPATION: </div>
                                <div class="col-md-3 text-center border-bottom">{{ $application['user']['occupation'] }}</div>
                                <div class="col-md-2">INDUSTRY: </div>
                                <div class="col-md-4 text-center border-bottom">{{ $application['industry_id'] }}</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-2">SPUTUM/CXR: </div>
                                <div class="col-md-4 text-center border-bottom">NEGATIVE</div>
                                <div class="col-md-2">STOOL: </div>
                                <div class="col-md-4 text-center border-bottom">NEGATIVE</div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-4">REGISTRATION NO.: </div>
                                <div class="col-md-8 text-center border-bottom">{{ $application['application_ref_no'] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" id="div-back-id"></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/health/issuing.js') }}"></script>
@include('partials.applicant.header')

<div class="container">
    
    @include('components.applicant.details')
    <div class="row">
        <div class="col-md-6">

            <section class="card rounded-0 shadow-lg p-1">
                <div class="card-body text-center">
                    <p class="m-0">
                        <span class=" font-weight-bold lead">Health Certificate Application History</span><br />
                        <small>Tap or Click an entry below to revisit the application</small>
                    </p>
                </div>
            </section>
            <section class="card rounded-0 shadow-lg">
                <div class="card-header">
                    <h3 class="card-title">
                        Individual History
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
        
                <div class="card-body">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>Application ID</th>
                                <th>Application Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($applications as $application)
                            
                                @if ($application['application_type'] === config('system.application_types')['Health-Certificate'])
                                    @php

                                        if ($application['histories']) {
                                            $last_timeline = $application['histories'][ array_key_last($application['histories']) ];
                                        } else {
                                            $last_timeline = [];
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="/applicant/processing/application/{{ $application['application_ref_no']}}">
                                                {{ $application['application_ref_no']}}
                                            </a> 
                                        </td>
                                        <td>
                                            <a href="/applicant/processing/application/{{ $application['application_ref_no']}}">
                                                {{ date("m/d/Y", strtotime($application['created_at'])) }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/applicant/processing/application/{{ $application['application_ref_no']}}">
                                                @php
                                                    echo ($application['application_status']) ? 
                                                        config('system.application_progress_status')[$application['application_status']] :
                                                        "New";
                                                @endphp
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- <section class="card rounded-0 shadow-lg">
                <div class="card-header">
                    <h3 class="card-title">
                        Bulk History
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
        
                <div class="card-body">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>Application ID</th>
                                <th>Application Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                                        
                            @foreach ($applications as $application)
                                @if ($application['classification_id'] === config('system.classification')['bulk'])
                                    @php
                                        if ($application['histories']) {
                                             $last_timeline = $application['histories'][ sizeOf($application['histories']) ];
                                        } else {
                                            $last_timeline = [];
                                        }

                                        foreach ($global_timelines as $timeline) {

                                            if ($last_timeline) {
                                                $latest_timeline_id = $last_timeline['timeline_look_up_id'];
                                                $next_timeline_id = $latest_timeline_id + 1;
                                                if ($timeline['id'] === $next_timeline_id) {
                                                    $link = "/applicant".$timeline['link']."/".$application['application_ref_no'];
                                                    break;
                                                }
                                            } else {
                                                $link = "/applicant".$timeline['link']."/".$application['application_ref_no'];
                                                break;
                                            }
                                        }

                                    @endphp

                                    <tr>
                                        <td>
                                            <a href="{{ $link }}">
                                                {{ $application['application_ref_no']}}
                                            </a> 
                                        </td>
                                        <td>
                                            <a href="{{ $link }}">
                                                {{ date("m/d/Y", strtotime($application['created_at'])) }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $link }}">
                                                {{ $application['application_status']}} 
                                            </a>
                                        </td>
                                    </tr>

                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section> --}}
            
        </div>

        <section class="col-md-6">
            <form action="">
                <div class="card rounded-0 shadow-lg p-1">
                    <div class="card-body">
                        <div class="text-center mb-2">
                            <span class=" lead font-weight-bold">
                                Health Certificate Application
                            </span><br />
                            <small class="text-center">Apply for Health certificate, online HIV seminar, get digital copy of your health card</small>
                        </div>
                    

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Classification <i class="text-red">*</i></label>
                                <x-dropdowns xtype='classifications' />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Application Type <i class="text-red">*</i></label>
                                <x-dropdowns xtype='application_types' />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Industry <i class="text-red">*</i></label>
                                <x-dropdowns xtype='industries' />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Sub-Industry <i class="text-red">*</i></label>
                                <x-dropdowns xtype='sub_industries' />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Business Line <i class="text-red">*</i></label>
                                <x-dropdowns xtype='business_lines' />
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="form-group col-lg-12">
                                
                                <div class="custom-control custom-checkbox form-group form-check text-left">
                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" style="margin-left: 0rem !important;" required="">
                                    <label class="custom-control-label" for="customCheck" required="">
                                        Public Employment Service Office (PESO) beneficiary
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <button type="button" class="btn btn-outline-primary btn-flat btn-block" data-trigger="apply-health-certificate" data-type="{{ config('system.application_types')['Health-Certificate']}}">
                            APPLY FOR HEALTH CERTIFICATE
                        </button>

                        {{-- <a class="btn btn-outline-primary btn-flat btn-block" href="/applicant/processing/application">
                            APPLY FOR HEALTH CERTIFICATE
                        </a> --}}
                    </div>
                </div>
            </form>
        </section>
    </div>

</div>

@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/components/dropdown.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/health/application.js') }}"></script>


@include('partials.applicant.header')

    <div class="container">
        @include('components.applicant.details')

        <div class="row">
            <div class="col-md-6">
    
                <section class="card rounded-0 shadow-lg p-1">
                    <div class="card-body text-center">
                        <p class="m-0">
                            <span class=" font-weight-bold lead">Sanitary Permit Application History</span><br />
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Application ID</th>
                                    <th>Application Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                
                                    @if ($application['application_type'] === config('system.application_types')['Sanitary-Permit'])
                                        @php
                                            if ($application['histories']) {
                                                $last_timeline = $application['histories'][ array_key_last($application['histories']) ];
                                            } else {
                                                $last_timeline = [];
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href="/business/processing/application/{{ $application['application_ref_no']}}">
                                                    {{ $application['application_ref_no']}}
                                                </a> 
                                            </td>
                                            <td>
                                                <a href="/business/processing/application/{{ $application['application_ref_no']}}">
                                                    {{ date("m/d/Y", strtotime($application['created_at'])) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/business/processing/application/{{ $application['application_ref_no']}}">
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
                
            </div>
    
            <section class="col-md-6">
                <form action="">
                    <div class="card rounded-0 shadow-lg p-1">
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <span class=" lead font-weight-bold">
                                    Sanitary Permit Application
                                </span><br />
                                <small class="text-center">Apply for Sanitary Permit, upload requirements online, get digital copy of your Provisional SP (for new business)</small>
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

                            {{-- <button class="btn btn-outline-primary btn-flat btn-block">
                                APPLY FOR SANITARY PERMIT
                            </button> --}}

                            <button 
                                type="button" 
                                class="btn btn-outline-primary btn-flat btn-block" 
                                data-trigger="apply-sanitary-permit" 
                                data-type="{{ config('system.application_types')['Sanitary-Permit']}}"
                            >
                                APPLY FOR SANITARY PERMIT
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>

    </div>
@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/components/dropdown.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/sanitary/application.js') }}"></script>
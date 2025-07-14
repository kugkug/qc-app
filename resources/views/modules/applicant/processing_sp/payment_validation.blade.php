@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Payment Validation" xpath='/applicant'/> --}}
    @include('components.timeline_business')

    <div class="row pt-5">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6">
            <div class="card rounded-0 shadow-lg">
                <div class="card-body text-center">
                    <i class="far fa-check-circle text-success" style="font-size: 15em"></i>
                    <h3 class="font-weight-bold pt-3">Successfully Submitted</h3>
                    <p>
                        The validation of your payment is in progress. Please wait until 3-5 working days.
                    </p>
                    @if($business['application_status'] >= config('system.application_status')['validated_payment'])
                        <a 
                            class="btn btn-outline-primary btn-flat" 
                            href="/business/processing/water-analysis/{{$business['application_ref_no']}}"
                        >
                            UPLOAD WATER ANALYSIS
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">&nbsp;</div>
    </div>
</div>

@include('partials.applicant.footer')
@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Requirements Validation" xpath='/applicant'/> --}}
    @include('components.timeline_business')

    <div class="row pt-5">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6">
            <div class="card rounded-0 shadow-lg">
                <div class="card-body text-center">
                    <i class="far fa-check-circle text-success" style="font-size: 15em"></i>
                    <h3 class="font-weight-bold pt-3">Successfully Submitted</h3>
                    <p>
                        The validation of your application is in progress. Upon issue of an 'Order of Payment'
                        please proceed to the 'City Treasurers Office (CTO)' for the payment
                    </p>

                    @if($business['application_status'] >= config('system.application_status')['created_payment'])
                        <a 
                            class="btn btn-outline-primary btn-flat" 
                            href="/business/processing/payment-order/{{$business['application_ref_no']}}"
                        >
                            VIEW ORDER OF PAYMENT
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">&nbsp;</div>
    </div>

    
</div>

@include('partials.applicant.footer')
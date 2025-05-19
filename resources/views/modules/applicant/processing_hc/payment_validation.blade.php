@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Payment Validation" xpath='/applicant'/> --}}
    @include('components.timeline')

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
                    {{-- <a class="btn btn-outline-primary btn-flat" href="/applicant/processing/payment-order">VIEW ORDER OF PAYMENT</a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">&nbsp;</div>
    </div>
</div>

@include('partials.applicant.footer')
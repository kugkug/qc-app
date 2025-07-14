@include('partials.applicant.processing-header')

<div class="container">
    {{-- <x-timeline xtitle="{{$module_title}}" xrefno="{{$application['application_ref_no']}}" xname="Head Approval" xpath='/applicant'/> --}}
    @include('components.timeline_business')
    <div class="row pt-5">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6">
            <div class="card rounded-0 shadow-lg">
                <div class="card-body text-center">
                    <i class="far fa-check-circle text-success" style="font-size: 15em"></i>
                    <h3 class="font-weight-bold pt-3">Water Analysis Completed</h3>
                    <p>
                        Please wait for approval.
                    </p>
                    {{-- <a class="btn btn-outline-primary btn-flat" href="/applicant/processing/certificate-issuing/{{$ref_no}}">GO TO CERTIFICATE ISSUING</a> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">&nbsp;</div>
    </div>
</div>

@include('partials.applicant.footer')
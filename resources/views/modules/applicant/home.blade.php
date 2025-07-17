@include('partials.applicant.header')
<div class="container">

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card rounded-0 card-button" data-path='health_certificate'>
                    <div class="card-body text-center rounded-0 shadow-lg" style="height: 280px">
                        <img src="{{ asset('assets/images/system/certificate.png') }}" class="img-fluid" style="height: 100%">
                    </div>
                    <div class="card-footer bg-primary">
                        <h4>Health Certificate</h4>
                        <small>Apply for Health certificate, online HIV seminar, get digital copy of your health card</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 card-button" data-path='sanitary_permit'>
                <div class="card rounded-0 shadow-lg">
                    <div class="card-body text-center" style="height: 280px">
                        <img src="{{ asset('assets/images/system/permit.png') }}" class="img-fluid" style="height: 100%">
                    </div>
                    <div class="card-footer bg-primary">
                        <h4>Sanitary Permit</h4>
                        <small>Apply for Sanitary Permit, upload requirements online, get digital copy of your Provisional SP (for new business)</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 card-button" data-path='/complaint'>
                <div class="card rounded-0 shadow-lg">
                    <div class="card-body text-center rounded-0" style="height: 280px">
                        <img src="{{ asset('assets/images/system/complain_icon.png') }}" class="img-fluid" style="height: 100%">
                    </div>
                    <div class="card-footer bg-primary">
                        <h4>File a Complain</h4>
                        <small>File a complain to make our services better</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
</div>
@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/home.js') }}"></script>

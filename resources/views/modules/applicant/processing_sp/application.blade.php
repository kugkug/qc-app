@include('partials.applicant.processing-header')

<div class="container">
    
    @include('components.timeline_business')
    <form>
        <div class="row">
            <div class="col-md-12">            
                <div class="card rounded-0 shadow-lg">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title">
                            Application Details
                        </h3>
                        <div class="card-tools ml-auto">
                            <button class="btn btn-outline-danger btn-flat">
                                Cancel Application
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('components.details_business')
                        <hr />

                        <h3 class="lead font-weight-class mb-3">
                            Sanitary Permit Application Form
                        </h3>

                        @include('components.business.business-info')

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@include('partials.applicant.footer')

<script src="{{ asset('assets/scripts/modules/scripts.js') }}"></script>
<script src="{{ asset('assets/scripts/modules/sanitary/application.js') }}"></script>
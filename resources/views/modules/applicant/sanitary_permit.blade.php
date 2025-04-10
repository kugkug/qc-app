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
                                <tr>
                                    <td>
                                        <a href="#">123456</a>
                                    </td>
                                    <td>
                                        <a href="#">3/9/2025</a>
                                    </td>
                                    <td>
                                        <a href="#">3/9/Draft</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">123456</a>
                                    </td>
                                    <td>
                                        <a href="#">3/9/2025</a>
                                    </td>
                                    <td>
                                        <a href="#">3/9/Draft</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                
            </div>
    
            <section class="col-md-6">
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
                                <select class="form-control rounded-0" style="" required="">
                                    <option value="" selected="selected"></option>
                                </select>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Industry <i class="text-red">*</i></label>
                                <select class="form-control rounded-0" style="" required="">
                                    <option value="" selected="selected"></option>
                                </select>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Sub-Industry <i class="text-red">*</i></label>
                                <select class="form-control rounded-0" style="" required="">
                                    <option value="" selected="selected"></option>
                                </select>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="fname" class="">Business Line <i class="text-red">*</i></label>
                                <select class="form-control rounded-0" style="" required="">
                                    <option value="" selected="selected"></option>
                                </select>
                            </div>
                        </div>

                        {{-- <button class="btn btn-outline-primary btn-flat btn-block">
                            APPLY FOR SANITARY PERMIT
                        </button> --}}

                        <a class="btn btn-outline-primary btn-flat btn-block" href="/business/processing/application">
                            APPLY FOR SANITARY PERMIT
                        </a>
                    </div>
                </div>
            </section>
        </div>

    </div>
@include('partials.applicant.footer')
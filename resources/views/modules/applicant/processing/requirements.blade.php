@include('partials.applicant.processing-header')

<div class="container">
    
    <x-timeline xtitle={{$module_title}}/>

    <div class="card rounded-0">
        <div class="card-header border-0">
            <h3 class="card-title">
                Application Details
            </h3>
            <div class="card-tools">
                <button class="btn btn-outline-danger btn-flat">
                    Cancel Application
                </button>
            </div>
        </div>
        <div class="card-body">
            <x-details />
            <hr />

            <h3 class="lead font-weight-bold">
                Requirements Upload
            </h3>
            <h3 class="lead">
                Upload Source: <span class="font-weight-bold">External Laboratory</span>
            </h3>
            <small>You need to select a source in order to proceed</small>

            <hr />
            <div class="row mb-3">
                <div class="col-md-6">
                    <button class="btn btn-outline-danger btn-flat btn-block">
                        EXTERNAL LABORATORY
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-outline-danger btn-flat btn-block">
                        QC IN-HOUSE LABORATORY
                    </button>
                </div>
            </div>
    
            <p>Requirements</p>
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="lead">
                                Business Permit of nano-enterprise
                            </h3>
                            <span class="badge bg-info">Optional</span><br />
                            <small>Business permit of nano-enterprise</small>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button class="btn btn-info btn-flat btn-block">PREVIEW</button>
                        </div>

                        <div class="col-md-3 d-flex align-items-center border-right">
                            
                            <div class="input-group border-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Requirement File</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center border-right">
                            Status
                        </div>
                        <div class="col-md-2 d-flex align-items-center ">

                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="lead">
                                Fecalysis/Stool Exam Result
                            </h3>
                            <span class="badge bg-danger">Required</span><br />
                            <small>Fecalysis/Stool Exam Result</small>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button class="btn btn-info btn-flat btn-block">PREVIEW</button>
                        </div>

                        <div class="col-md-3 d-flex align-items-center border-right">
                            
                            <div class="input-group border-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Requirement File</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center border-right">
                            Status
                        </div>
                        <div class="col-md-2 d-flex align-items-center ">

                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="lead">
                                HIV Seminar / Health Card 1 (front)
                            </h3>
                            <span class="badge bg-info">Optional</span><br />
                            <small>HIV Seminar / Health Card 1 (front)</small>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button class="btn btn-info btn-flat btn-block">PREVIEW</button>
                        </div>

                        <div class="col-md-3 d-flex align-items-center border-right">
                            
                            <div class="input-group border-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Requirement File</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center border-right">
                            Status
                        </div>
                        <div class="col-md-2 d-flex align-items-center ">

                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="lead">
                                HIV Seminar / Health Card 2 (back)
                            </h3>
                            <span class="badge bg-info">Optional</span><br />
                            <small>HIV Seminar / Health Card 2 (back)</small>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button class="btn btn-info btn-flat btn-block">PREVIEW</button>
                        </div>

                        <div class="col-md-3 d-flex align-items-center border-right">
                            
                            <div class="input-group border-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Requirement File</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center border-right">
                            Status
                        </div>
                        <div class="col-md-2 d-flex align-items-center ">

                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="lead">
                                ID Photo
                            </h3>
                            <span class="badge bg-danger">Required</span><br />
                            <small>ID Photo</small>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button class="btn btn-info btn-flat btn-block">PREVIEW</button>
                        </div>

                        <div class="col-md-3 d-flex align-items-center border-right">
                            
                            <div class="input-group border-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Requirement File</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center border-right">
                            Status
                        </div>
                        <div class="col-md-2 d-flex align-items-center ">

                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="lead">
                                Sputum/Chest X-ray Exam Result
                            </h3>
                            <span class="badge bg-danger">Required</span><br />
                            <small>Sputum/Chest X-ray Exam Result</small>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <button class="btn btn-info btn-flat btn-block">PREVIEW</button>
                        </div>

                        <div class="col-md-3 d-flex align-items-center border-right">
                            
                            <div class="input-group border-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Requirement File</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center border-right">
                            Status
                        </div>
                        <div class="col-md-2 d-flex align-items-center ">

                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate">
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="custom-control custom-checkbox form-group form-check text-left">
                <input type="checkbox" class="custom-control-input" id="customCheck2" name="example2" style="margin-left: 0rem !important;" required="">
                <label class="custom-control-label" for="customCheck2" required="">
                    I certify that provided requirements are valid and true
                </label>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-outline-success btn-flat btn-block" href="/applicant/processing/requirements-validation">
                        NEXT
                    </a>
                    {{-- <button class="btn btn-outline-success btn-flat btn-block">
                        NEXT
                    </button> --}}
                </div>
                <div class="col-md-6">
                    <a class="btn btn-outline-danger btn-flat btn-block" href="/applicant/processing/application">
                        BACK TO APPLICATION FORM
                    </a>
                    {{-- <button class="btn btn-outline-danger btn-flat btn-block">
                        CANCEL
                    </button> --}}
                </div>
            </div>

        </div>
    </div>
</div>

@include('partials.applicant.footer')